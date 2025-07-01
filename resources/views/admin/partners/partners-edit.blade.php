@extends('admin.layouts.main')

@section('title')
    редактирование партнёра
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование партнёра</h1>
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
                                        <form class="form-horizontal" action="{{ route('partner_update', [$company->id]) }}" method="post">
                                            @csrf

                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <div class="col-sm-12">
                                                        <label for="status_id"><u>Статус</u></label>
                                                        <select class="custom-select rounded-0 js-select" name="status_id" id="status_id">
                                                            <option value="1" {{ $company->status_id == 1 ? 'selected' : '' }}>Free</option>
                                                            <option value="2" {{ $company->status_id == 2 ? 'selected' : '' }}>Pro</option>
                                                            <option value="3" {{ $company->status_id == 3 ? 'selected' : '' }}>Vip</option>
                                                            <option value="4" {{ $company->status_id == 4 ? 'selected' : '' }}>Start</option>
                                                        </select>
                                                    </div>
                                                    @if($errors->has('status_id'))<span class="text-danger"> {{ $errors->first('status_id') }}</span>@endif
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="col-sm-12">
                                                        <label for="is_partner"><u>Партнёр</u></label>
                                                        <select class="custom-select rounded-0 js-select" name="is_partner" id="is_partner">
                                                            <option value="0" {{ $company->is_partner == 0 ? 'selected' : '' }}>Нет</option>
                                                            <option value="1" {{ $company->is_partner == 1 ? 'selected' : '' }}>Да</option>
                                                        </select>
                                                    </div>
                                                    @if($errors->has('is_partner'))<span class="text-danger"> {{ $errors->first('is_partner') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Компания</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $company?->name }}">
                                                    @if($errors->has('name'))<span class="text-danger"> {{ $errors->first('name') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Страна</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="country" class="form-control" id="name" value="{{ $company?->country }}">
                                                    @if($errors->has('country '))<span class="text-danger"> {{ $errors->first('country ') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Город</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="city" class="form-control" id="name" value="{{ $company?->city }}">
                                                    @if($errors->has('city '))<span class="text-danger"> {{ $errors->first('city ') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Адрес</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="address" class="form-control" id="name" value="{{ $company?->address }}">
                                                    @if($errors->has('address '))<span class="text-danger"> {{ $errors->first('address ') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Сотрудников</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="employees_count" class="form-control" id="name" value="{{ $company?->employees_count }}">
                                                    @if($errors->has('employees_count '))<span class="text-danger"> {{ $errors->first('employees_count ') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Ссылка на website</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="website" class="form-control" id="name" value="{{ $company?->website }}">
                                                    @if($errors->has('website '))<span class="text-danger"> {{ $errors->first('website ') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 col-form-label"><u>Пользователь</u></label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name" value="{{ $company?->user?->user ?? $company?->user?->full_name }}" disabled>
                                                    </div>
                                                </div>
                                            </div>



                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('partner_admin') }}" type="submit" class="btn btn-primary">Отменить</a>
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

    <script>
        $('#daterange').daterangepicker({
            "timePicker": true,
            "timePicker24Hour": true,
            locale: {
                "format": "DD.MM.YYYY HH:mm",
                "separator": " - ",
                "applyLabel": "Применить",
                "cancelLabel": "Отмена",
                "fromLabel": "От",
                "toLabel": "До",
                "customRangeLabel": "Выбрать период",
                "weekLabel": "Неделя",
                "daysOfWeek": [
                    "Вс",
                    "Пн",
                    "Вт",
                    "Ср",
                    "Чт",
                    "Пт",
                    "Сб"
                ],
                "monthNames": [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
                "firstDay": 1
            }
        }, function(start, end, label) {
            let event_at = document.querySelector('[name="event_at"]');
            let event_to = document.querySelector('[name="event_to"]');

            event_at.value = start.format('YYYY-MM-DD HH:mm');
            event_to.value = end.format('YYYY-MM-DD HH:mm');
        });
    </script>
@endsection
