@extends('admin.layouts.main')

@section('title')
    администраторы
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Администраторы</h1>
                    </div>

                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if(auth()->user()->role->isAdmin() || auth()->user()->role->isDeveloper())
                                <a href="{{ route('users_create') }}" class="btn btn-success btn-flat"><i class="fas fa-plus"></i> Добавить администратора</a>
                                @endif
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Администраторы</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th style="text-align: right">Действие</th></tr>
                                    </thead>
                                    <tbody>
                                    @if($users)
                                        @foreach($users as $user)
                                            @if((auth()->user()->role->isAdmin() && $user->role_id !== \App\Models\Role::DEVELOPER) || auth()->user()->role->isDeveloper()
                                            || (auth()->user()->role->isModerator() && $user->role_id !== \App\Models\Role::DEVELOPER && $user->role_id !== \App\Models\Role::ADMIN))
                                            <tr>
                                                <td style="vertical-align: middle;">{{ $user->name }}</td>
                                                <td style="vertical-align: middle;">{{ $user->email }}</td>
                                                <td style="width: 5%; vertical-align: middle;">
                                                    <a href="{{ route('users_edit', [$user->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                    @if(auth()->user()->role->isAdmin())
                                                    <a href="{{ route('users_delete', [$user->id]) }}" onclick="return confirm('Вы уверены, что хотите удалить пользователя {{ $user->name }}?');"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer clearfix d-flex justify-content-end">
                                {{ $users->appends(request()->input())->links() }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
