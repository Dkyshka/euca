<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAdminRequest;
use App\Http\Requests\UserAuthRequest;
use App\Models\User;
use App\Services\LogHistoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TelegramUserAdminController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('login', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->notRoleAdmin()->orderBy('id', 'desc')->paginate(15);

        return view('admin.default_users.users', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('admin.default_users.users-edit', compact('user'));
    }

    public function update(User $user, \Illuminate\Http\Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'                      => ['required', 'string'],
            'login' => ['required', 'string', 'exists:users,login'],
            'phone'                     => ['required'],
        ]);

        $user->update($data);
        LogHistoryService::setLog($request->ip(), 'Пользователь «'.$request->name.'» отредактирован');

        return redirect(route('telegram_users_admin'));
    }
}
