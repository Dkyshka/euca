<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Chat;
use App\Models\Direction;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class UserController extends Controller
{
    public Model $page;
    public Setting $setting;
    public Collection $footer;
    public Collection $menu;

    public function __construct()
    {
        $this->menu = Page::whereStatus(1)->where('parent_id', null)->whereHeader(1)->orderBy('sort_order')->get();
        $this->setting = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));
        $this->footer = Cache::remember('footer_menu', now()->addHour(), function () {
            return Page::whereStatus(1)
                ->whereNull('parent_id')
                ->whereFooter(1)
                ->orderBy('id')
                ->get();
        });
    }

    public function messages($locale, ?Chat $chat = null): View
    {
        $this->page = Page::findOrFail(6);
        $user = auth()->user();

        // Все чаты, где текущий пользователь — либо отправитель, либо получатель
        $chats = Chat::where(function ($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->orWhere('recipient_id', $user->id);
        })
            ->withCount([
                'messages as unread_count' => fn($q) => $q
                    ->where('is_read', false)
                    ->where('sender_id', '!=', $user->id)
            ])
            ->with([
                'sender',
                'recipient',
                'latestMessage'
            ])
            ->latest()
            ->get();

        $activeChat = null;

        if ($chat) {
            // Проверка принадлежности пользователя к чату
            if ($chat->sender_id != $user->id && $chat->recipient_id != $user->id) {
                abort(403, 'Вы не имеете доступа к этому чату');
            }


            // Загрузка сообщений и вложений
            $activeChat = Chat::with([
                'sender',
                'recipient',
                'messages.sender',
                'messages.attachments'
            ])->findOrFail($chat->id);

            // Отметить входящие сообщения как прочитанные
            $activeChat->messages()
                ->where('sender_id', '!=', $user->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return view('users.messages', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'chats' => $chats,
            'activeChat' => $activeChat,
        ]);
    }

    public function tariffs(): View
    {
        $this->page = Page::findOrFail(7);

        return view('users.tariffs', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu
        ]);
    }

    public function settings(): View
    {
        $this->page = Page::findOrFail(8);

        return view('users.settings', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu
        ]);
    }

    public function companies(): View
    {
        $this->page = Page::findOrFail(9);
        $directions = Direction::all();

        return view('users.company', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'directions' => $directions
        ]);
    }

    public function subscribes(): View
    {
        $this->page = Page::findOrFail(10);

        return view('users.subscribes', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu
        ]);
    }

    public function update(UserUpdateRequest $userUpdateRequest): \Illuminate\Http\RedirectResponse
    {
        $data = $userUpdateRequest->validated();

        if (isset($data['tel'])) {
            $data['phone'] = $data['tel'];
            unset($data['tel']);
        }

        if ($userUpdateRequest->hasFile('file')) {
            $file = $userUpdateRequest->file('file');

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $directory = now()->format('Y-m-d');

            $file->storeAs("public/avatars/{$directory}", $fileName);

            $data['avatar'] = asset('storage/avatars/' . "{$directory}/" . $fileName);
        }

        auth()->user()->update($data);

        return redirect()->back()->with('success', __('lang.Успешно обновлено'));
    }

    public function updateCompany(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'country' => ['required', 'string', 'min:3', 'max:255'],
            'city' => ['required', 'string', 'min:3', 'max:255'],
            'website' => ['nullable', 'url'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'work_start_date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'employees_count' => ['required', 'string', 'min:1'],
            'emails' => ['required', 'array', 'min:1'],
            'emails.*' => ['email'],
            'phones' => ['required', 'array', 'min:1'],
            'phones.*' => ['string'],
            'certificates' => ['nullable', 'array'],
            'certificates.*' => ['image', 'mimes:jpeg,jpg,png,avif', 'max:2048'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif', 'max:2048'],
            'directions' => ['nullable', 'array'],
            'directions.*' => ['numeric', 'exists:directions,id'],
        ]);

        $user = auth()->user();
        $company = $user->company()->first();

        if (!$company) {
            $company = $user->company()->create([
                'name' => $request->input('name'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'work_start_date' => $request->date('work_start_date'),
                'website' => $request->input('website'),
                'description' => $request->input('description'),
                'employees_count' => $request->input('employees_count'),
            ]);
        } else {
            $company->update([
                'name' => $request->input('name'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'work_start_date' => $request->date('work_start_date'),
                'website' => $request->input('website'),
                'description' => $request->input('description'),
                'employees_count' => $request->input('employees_count'),
            ]);
        }

        if ($request->has('directions')) {
            $company->directions()->sync($request->input('directions'));
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $directory = now()->format('Y-m-d');

            $file->storeAs("public/avatars/{$directory}", $fileName);

            $company->update([
                'avatar' => 'storage/avatars/' . "{$directory}/" . $fileName,
            ]);
        }

        if ($request->has('emails')) {
            $currentEmails = $request->input('emails');
            $company->emails()->whereNotIn('email', $currentEmails)->delete();

            foreach ($request->input('emails') as $email) {
                $company->emails()->updateOrCreate(
                    ['email' => $email],
                    ['email' => $email]
                );
            }
        }

        if ($request->has('phones')) {
            $currentPhones = $request->input('phones');
            $company->phones()->whereNotIn('phone', $currentPhones)->delete();

            foreach ($request->input('phones') as $phone) {
                $company->phones()->updateOrCreate(
                    ['phone' => $phone],
                    ['phone' => $phone]
                );
            }
        }

        if ($request->hasFile('certificates')) {
            foreach ($request->file('certificates') as $file) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $directory = now()->format('Y-m-d');

                $file->storeAs("public/certificates/{$directory}", $fileName);

                $company->certificates()->create([
                    'image_path' => 'storage/certificates/' . "{$directory}/" . $fileName,
                ]);
            }
        }

        return redirect()->back()->with('success', __('lang.Успешно обновлено'));
    }
}
