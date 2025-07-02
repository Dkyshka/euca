@extends('admin.layouts.main')

@section('title')
    редактирование груза
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование груза</h1>
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
                                        <form class="form-horizontal" action="{{ route('cargo_admin_update', [$cargoLoading->id]) }}" method="post">
                                            @csrf

                                            <div class="row">

{{--                                                <div class="form-group col-md-6">--}}
{{--                                                    <div class="col-sm-12">--}}
{{--                                                        <label for="page_id"><u>Родительский раздел</u></label>--}}
{{--                                                        <select class="custom-select rounded-0 js-select" name="page_id" id="page_id">--}}
{{--                                                            <option value="">Нечего не выбрано</option>--}}
{{--                                                            @foreach($pages as $item)--}}
{{--                                                                <option value="{{ $item->id }}" {{ $item->id == $news->page_id ? 'selected' : ''}}>{{ $item->name_ru }}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                        @if($errors->has('page_id'))<span class="text-danger"> {{ $errors->first('page_id') }}</span>@endif--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}

                                                <div class="form-group col-md-12">
                                                    <div class="col-sm-12">
                                                        <label for="status"><u>Статус</u></label>
                                                        <select class="custom-select rounded-0 js-select" name="status" id="status">
                                                            <option value="1" {{ $cargoLoading->status == 1 ? 'selected' : '' }}>В работе</option>
                                                            <option value="2" {{ $cargoLoading->status == 2 ? 'selected' : '' }}>Согласование</option>
                                                            <option value="3" {{ $cargoLoading->status == 3 ? 'selected' : '' }}>В исполнении</option>
                                                            <option value="4" {{ $cargoLoading->status == 4 ? 'selected' : '' }}>Архив</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Откуда</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="country" class="form-control" id="name" value="{{ $cargoLoading->country }}">
                                                    @if($errors->has('country'))<span class="text-danger"> {{ $errors->first('country') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Куда</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="final_unload_city" class="form-control" id="name" value="{{ $cargoLoading->final_unload_city }}">
                                                    @if($errors->has('final_unload_city'))<span class="text-danger"> {{ $errors->first('final_unload_city') }}</span>@endif
                                                </div>
                                            </div>


{{--                                            <div class="form-group">--}}
{{--                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок en</u></label>--}}
{{--                                                <div class="col-sm-12">--}}
{{--                                                    <input type="text" name="name_en" class="form-control" id="name" value="{{ $news->name_en }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                            <div class="goods-map__wrapper">
                                                <p><strong>{{ __('Расчет расстояния') }}</strong></p>
                                                <div class="goods-map__cards">
                                                    <div class="goods-map__card">
                                                        <p id="distance"></p>
                                                    </div>
                                                </div>
                                                <div class="goods-map" id="goods-map">
                                                    <div class="map" id="myMap"></div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('statistic_cargo') }}" type="submit" class="btn btn-primary">Отменить</a>
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

    <script src="https://api-maps.yandex.ru/2.1/?apikey=49817d12-35af-402e-82b9-91b83b18ac74&lang={{ app()->getLocale() }}"></script>

    <style>
        #myMap {
            width: 100%;
            height: 600px;
        }
    </style>

    @php
    $settings = \App\Models\Setting::find(1);
    @endphp

    <script>
        let urlPin = "{{ asset('assets/images/svg/map-pin.svg') }}";
        const COORDINATES = [{{ $settings->markup['coordinates']['lat'] ?? '' }}, {{ $settings->markup['coordinates']['long'] ?? '' }}];

        ymaps.ready(init);

        function init() {
            const pointALat = {{ $cargoLoading->place_lat ?? 'null' }};
            const pointALng = {{ $cargoLoading->place_lng ?? 'null' }};
            const pointBLat = {{ $cargoLoading->final_unload_city_lat ?? 'null' }};
            const pointBLng = {{ $cargoLoading->final_unload_city_lng ?? 'null' }};

            let referencePoints = [];

            if (pointALat !== null && pointALng !== null) {
                referencePoints.push([pointALat, pointALng]);
            } else {
                {{--referencePoints.push("{{ $article->country }} {{ $article->address }}");--}}
                referencePoints.push("{{ $cargoLoading->country }}");
            }

            if (pointBLat !== null && pointBLng !== null) {
                referencePoints.push([pointBLat, pointBLng]);
            } else {
                {{--referencePoints.push("{{ $article->final_unload_city }} {{ $article->final_unload_address }}");--}}
                referencePoints.push("{{ $cargoLoading->final_unload_city }}");
            }

            {{--const pointA = "{{ $article->country }} {{ $article->address }}";--}}
            {{--const pointB = "{{ $article->final_unload_city }} {{ $article->final_unload_address }}";--}}

            // const multiRoute = new ymaps.multiRouter.MultiRoute({
            //     referencePoints: [pointA, pointB],
            //     params: { results: 1 }
            // }, {
            //     boundsAutoApply: true
            // });

            const multiRoute = new ymaps.multiRouter.MultiRoute({
                referencePoints: referencePoints,
                params: { results: 1 }
            }, {
                boundsAutoApply: true
            });

            const myMap = new ymaps.Map('myMap', {
                center: [55.751244, 37.618423],
                zoom: 10,
                controls: ['zoomControl', 'trafficControl', 'typeSelector', 'rulerControl']
            });


            myMap.geoObjects.add(multiRoute);

            // Когда маршрут построен — получаем расстояние
            multiRoute.model.events.add('requestsuccess', function () {
                const activeRoute = multiRoute.getActiveRoute();
                if (activeRoute) {
                    const distance = activeRoute.properties.get("distance").text;
                    const duration = activeRoute.properties.get("duration").text;
                    document.getElementById("distance").innerText =
                        `{{ __('Расстояние:') }} ${distance}, {{ __('Время в пути:') }} ${duration}`;
                }
            });
        }
    </script>

@endsection
