<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAdminRequest;
use App\Models\User;
use App\Services\LogHistoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserAdminController extends Controller
{
    public function index(): View
    {
        $users = User::onlyAdmin()->paginate(15);

        return view('admin.users.users', compact('users'));
    }

    public function auth(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required'],
        ], [
            'email.required' => __('lang.Введите email'),
            'email.exists' => __('lang.Такого пользователя не существует'),
            'password.required' => __('lang.Введите пароль')
        ]);

        if(auth()->guard('admin')->attempt($data)) {
            return redirect(route('admin_index'));
        }

        return back()->withInput()->withErrors(['error' => 'Неверный email или пароль']);
    }

    public function create(): View
    {
        return view('admin.users.users-create');
    }

    public function store(UserAdminRequest $userAdminRequest): RedirectResponse
    {
        User::create($userAdminRequest->validated());

        LogHistoryService::setLog($userAdminRequest->ip(), 'Пользователь «'.$userAdminRequest->name.'» создан');

        return redirect(route('users_admin'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.users-edit', compact('user'));
    }

    public function update(User $user, UserAdminRequest $userAdminRequest): RedirectResponse
    {
        $user->update($userAdminRequest->validated());
        LogHistoryService::setLog($userAdminRequest->ip(), 'Пользователь «'.$userAdminRequest->name.'» отредактирован');

        return redirect(route('users_admin'));
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id == 1) {
            return redirect(route('users_admin'));
        }

        $user->delete();
        LogHistoryService::setLog(request()->ip(), 'Пользователь «'.$user->name.'» удален');

        return redirect(route('users_admin'));
    }

    public function logout(): RedirectResponse
    {
        auth()->guard('admin')->logout();

        return redirect(route('admin_login'));
    }

}
