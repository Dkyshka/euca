@extends('admin.layouts.main')

@section('title')
    редактирование транспорта
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование транспорта</h1>
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
                                        <form class="form-horizontal" action="{{ route('transport_admin_update', [$transport->id]) }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Откуда</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="country" class="form-control" id="name" value="{{ $transport->country }}">
                                                    @if($errors->has('country'))<span class="text-danger"> {{ $errors->first('country') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Куда</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="final_country" class="form-control" id="name" value="{{ $transport->final_country }}">
                                                    @if($errors->has('final_country'))<span class="text-danger"> {{ $errors->first('final_country') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <div class="col-sm-12">
                                                    <label for="status"><u>Тип транспорта</u></label>
                                                    <select class="custom-select rounded-0 js-select" name="body_type" id="status">
                                                        <option value="Тент" {{ $transport->body_type == 'Тент' ? 'selected' : '' }}>Тент</option>
                                                        <option value="Рефрижератор" {{ $transport->body_type == 'Рефрижератор' ? 'selected' : '' }}>Рефрижератор</option>
                                                        <option value="Открытый" {{ $transport->body_type == 'Открытый' ? 'selected' : '' }}>Открытый</option>
                                                        <option value="Контейнер" {{ $transport->body_type == 'Контейнер' ? 'selected' : '' }}>Контейнер</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row col-md-12">

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Грузоподъемность</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="capacity" class="form-control" id="name" value="{{ $transport->capacity }}">
                                                    @if($errors->has('capacity'))<span class="text-danger"> {{ $errors->first('capacity') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Объем</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="volume" class="form-control" id="name" value="{{ $transport->volume }}">
                                                    @if($errors->has('volume'))<span class="text-danger"> {{ $errors->first('volume') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Длина</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="length" class="form-control" id="name" value="{{ $transport->length }}">
                                                    @if($errors->has('length'))<span class="text-danger"> {{ $errors->first('length') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Ширина</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="width" class="form-control" id="name" value="{{ $transport->width }}">
                                                    @if($errors->has('width'))<span class="text-danger"> {{ $errors->first('width') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Высота</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="height" class="form-control" id="name" value="{{ $transport->height }}">
                                                    @if($errors->has('height'))<span class="text-danger"> {{ $errors->first('height') }}</span>@endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 col-form-label"><u>Водитель</u></label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" value="{{ $transport->driver?->first_name .' '. $transport->driver?->middle_name .' '. $transport->driver?->last_name }}" disabled>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" value="{{ $transport->driver?->phone }}" disabled>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('statistic_transport') }}" type="submit" class="btn btn-primary">Отменить</a>
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
