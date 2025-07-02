@extends('admin.layouts.main')

@section('title')
    редактирование профиля
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование профиля</h1>
                    </div>

                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Основное</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('telegram_users_update', [$user->id]) }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label for="login" class="col-sm-2 col-form-label">ФИО</label>
                                                <div class="col-sm-12">
                                                    <input type="text" disabled name="login" class="form-control" value="{{ $user->full_name }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="login" class="col-sm-2 col-form-label">Логин</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="login" class="form-control" id="login" value="{{ $user->login }}">
                                                    @if($errors->has('login'))<span class="text-danger"> {{ $errors->first('login') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
                                                    @if($errors->has('login'))<span class="text-danger"> {{ $errors->first('email') }}</span>@endif
                                                </div>
                                            </div>

{{--                                            <div class="form-group">--}}
{{--                                                <label for="name" class="col-sm-2 col-form-label">Имя Telegram</label>--}}
{{--                                                <div class="col-sm-12">--}}
{{--                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">--}}
{{--                                                    @if($errors->has('name'))<span class="text-danger"> {{ $errors->first('name') }}</span>@endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group">--}}
{{--                                                <label for="pinfl" class="col-sm-2 col-form-label">ПИНФЛ</label>--}}
{{--                                                <div class="col-sm-12">--}}
{{--                                                    <input type="text" name="pinfl" class="form-control" id="pinfl" value="{{ $user->pinfl }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group">--}}
{{--                                                <label for="passport_number" class="col-sm-2 col-form-label">Номер паспорта</label>--}}
{{--                                                <div class="col-sm-12">--}}
{{--                                                    <input type="text" name="passport_number" class="form-control" id="passport_number" value="{{ $user->passport_number }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                            <div class="form-group">
                                                <label for="phone" class="col-sm-2 col-form-label">Телефон</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="phone" class="form-control"  value="{{ $user->phone }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="password" class="col-sm-2 col-form-label">Новый пароль</label>
                                                <div class="col-sm-12">
                                                    <input type="password" name="password" class="form-control" id="password" value="">
                                                    @if($errors->has('password'))<span class="text-danger"> {{ $errors->first('password') }}</span>@endif
                                                </div>
                                            </div>

{{--                                            <div class="row">--}}
{{--                                                <div class="form-group col-md-6">--}}
{{--                                                    <label for="bonus_balance" class="col-sm-12 col-form-label">Бонус за заказы</label>--}}
{{--                                                    <div class="col-sm-12">--}}
{{--                                                        <input type="text" name="bonus_balance" class="form-control" id="bonus_balance" value="{{ $user->bonus_balance }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group col-md-6">--}}
{{--                                                    <label for="bonus_invites" class="col-sm-12 col-form-label">Бонус за приглашение</label>--}}
{{--                                                    <div class="col-sm-12">--}}
{{--                                                        <input type="text" name="bonus_invites" class="form-control" id="bonus_invites" value="{{ $user->bonus_invites }}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <a href="{{ route('telegram_users_admin') }}" type="submit" class="btn btn-primary">Отменить</a>
                                        </div>
                                    </div>

                                    </form>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>


        </section>

    </div>
@endsection
