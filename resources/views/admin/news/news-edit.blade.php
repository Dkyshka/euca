@extends('admin.layouts.main')

@section('title')
    редактирование новости
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование новости</h1>
                    </div>

                </div>
            </div>
        </div>

        @if($errors->has('error'))
            <span id="events" data-message="{{ $errors->first('error') }}" data-action="error"></span>
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
                                    <li class="nav-item">
                                        <a class="nav-link" id="ru_tab" data-toggle="pill" href="#ru" role="tab" aria-controls="ru" aria-selected="true">RU</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="uz_tab" data-toggle="pill" href="#uz" role="tab" aria-controls="uz" aria-selected="false">UZ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tr_tab" data-toggle="pill" href="#tr" role="tab" aria-controls="tr" aria-selected="false">TR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en_tab" data-toggle="pill" href="#en" role="tab" aria-controls="en" aria-selected="false">EN</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('news_update', [$news->id]) }}" method="post">
                                            @csrf

                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <div class="col-sm-12">
                                                        <label for="page_id"><u>Родительский раздел</u></label>
                                                        <select class="custom-select rounded-0 js-select" name="page_id" id="page_id">
                                                            <option value="">Нечего не выбрано</option>
                                                            @foreach($pages as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $news->page_id ? 'selected' : ''}}>{{ $item->name_ru }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('page_id'))<span class="text-danger"> {{ $errors->first('page_id') }}</span>@endif
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="col-sm-12">
                                                        <label for="status"><u>Статус</u></label>
                                                        <select class="custom-select rounded-0 js-select" name="status" id="status">
                                                            <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Включен</option>
                                                            <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>Скрыт</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок ru</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_ru" class="form-control" id="name" value="{{ $news->name_ru }}">
                                                    @if($errors->has('name_ru'))<span class="text-danger"> {{ $errors->first('name_ru') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок uz</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_uz" class="form-control" id="name" value="{{ $news->name_uz }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок tr</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_tr" class="form-control" id="name" value="{{ $news->name_tr }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок en</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_en" class="form-control" id="name" value="{{ $news->name_en }}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>URL</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $news->slug }}">
                                                    @if($errors->has('slug'))<span class="text-danger"> {{ $errors->first('slug') }}</span>@endif
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="card card-outline card-success">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Изображения</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <button class="btn btn-success mb-2" id="lfm-gallery" data-input="thumbnail" data-preview="gallery-img-output">Загрузить</button>
                                                            @php
                                                                if(isset($news->pictures)):
                                                                    $filepath = [];
                                                                    foreach($news->pictures as $file):
                                                                        $filepath[] = $file->orig;
                                                                    endforeach;
                                                                    $filepath = implode(',', $filepath);
                                                                endif;
                                                            @endphp

                                                            <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ $filepath ?? '' }}">
                                                            <div id="gallery-img-output" class="upload-images gallery-image">
                                                                @if(isset($news->pictures))
                                                                    @foreach($news->pictures as $key => $picture)
                                                                        <div class="product-img-upload col-md-3" data-id="{{ $key }}" data-orig="{{ $picture->orig }}" data-delete="{{ route('pictures_delete', $picture->id ?? 0) }}">
                                                                            <img src="{{ asset($picture->orig) }}" style="height: auto">
                                                                            <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    {{-- RU --}}
                                    <div class="tab-pane" id="ru" role="tabpanel" aria-labelledby="ru_tab">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[ru][one]">{{ $event->markup->ru->one ?? ''}}</textarea>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="price_description" class="col-sm-12 col-form-label"><u>Описание</u></label>
                                            <div class="col-sm-12">
                                                <textarea id="description" class="form-control summernote" name="markup[ru][two]">{{ $event->markup->ru->two ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- UZ --}}
                                    <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz_tab">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[uz][one]">{{ $event->markup->uz->one ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="price_description" class="col-sm-12 col-form-label"><u>Описание</u></label>
                                            <div class="col-sm-12">
                                                <textarea id="description" class="form-control summernote" name="markup[uz][two]">{{ $event->markup->uz->two ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- TR --}}
                                    <div class="tab-pane fade" id="tr" role="tabpanel" aria-labelledby="tr_tab">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[tr][one]">{{ $event->markup->tr->one ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="price_description" class="col-sm-12 col-form-label"><u>Описание</u></label>
                                            <div class="col-sm-12">
                                                <textarea id="description" class="form-control summernote" name="markup[tr][two]">{{ $event->markup->tr->two ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- EN --}}
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en_tab">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[en][one]">{{ $event->markup->en->one ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="price_description" class="col-sm-12 col-form-label"><u>Описание</u></label>
                                            <div class="col-sm-12">
                                                <textarea id="description" class="form-control summernote" name="markup[en][two]">{{ $event->markup->en->two ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('news_admin') }}" type="submit" class="btn btn-primary">Отменить</a>
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
