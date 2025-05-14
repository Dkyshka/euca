@extends('admin.layouts.main')

@section('title')
    пользователи
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Пользователи</h1>
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
                                <h3 class="card-title">Пользователи</h3>
                            </div>

                            <div class="card-body">
                                <p class="text-right">
                                    <a class="btn btn-warning" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Фильтр</a>
                                </p>
                                <div class="row">
                                    <div class="col">
                                        <div class="collapse multi-collapse {{ request()->input() ? 'show' : '' }}" id="multiCollapseExample1">
                                            <div class="card-body">

                                                <form class="form-row">

                                                    <div class="form-group col-md-12">
                                                        <label for="search">Поиск</label>
                                                        <input type="text" class="form-control" name="search" placeholder="ЛОГИН/ПОЧТА/ТЕЛЕФОН" value="{{ request()?->search ?? '' }}" id="search">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <button type="submit" class="btn btn-outline-info btn-flat">Поиск</button>
                                                        <a href="{{ route('telegram_users_admin') }}" class="btn btn-outline-info btn-flat">Сброс фильтров</a>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th style="text-align: right">Действие</th></tr>
                                    </thead>
                                    <tbody>
                                    @if($users)
                                        @foreach($users as $user)
                                            <tr>
                                                <td style="vertical-align: middle;">{{ $user->login }}</td>
                                                <td style="width: 5%; vertical-align: middle;">
                                                    <a href="{{ route('telegram_users_edit', [$user->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                </td>
                                            </tr>
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
