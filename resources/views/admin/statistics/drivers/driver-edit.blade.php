@extends('admin.layouts.main')

@section('title')
    редактирование водителя
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование водителя</h1>
                    </div>

                </div>
            </div>
        </div>

        @if($errors->has('error'))
            <span id="events" data-message="{{ $errors->first('error') }}" data-action="error"></span>
        @endif

        @if(session('success'))
            <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
        @endif

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Основное</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('driver_admin_update', [$driver->id]) }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Имя</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="first_name" class="form-control" id="name" value="{{ $driver->first_name }}">
                                                    @if($errors->has('first_name'))<span class="text-danger"> {{ $errors->first('first_name') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Фамилия</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="middle_name" class="form-control" id="name" value="{{ $driver->middle_name }}">
                                                    @if($errors->has('middle_name'))<span class="text-danger"> {{ $errors->first('middle_name') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Отчество</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="last_name" class="form-control" id="name" value="{{ $driver->last_name }}">
                                                    @if($errors->has('last_name'))<span class="text-danger"> {{ $errors->first('last_name') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Телефон</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="phone" class="form-control" id="name" value="{{ $driver->phone }}">
                                                    @if($errors->has('phone'))<span class="text-danger"> {{ $errors->first('phone') }}</span>@endif
                                                </div>
                                            </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('statistic_drivers') }}" type="submit" class="btn btn-primary">Отменить</a>
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

    <script>
        document.querySelector('[name="apply"]')?.addEventListener('click', function(e) {
            e.target.value = 1;
        });
    </script>

@endsection
