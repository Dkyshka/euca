@extends('admin.layouts.main')

@section('title')
    редактирование отзыва
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование отзыва</h1>
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
                                        <a class="nav-link" id="en_tab" data-toggle="pill" href="#en" role="tab" aria-controls="en" aria-selected="false">EN</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('review_update', [$review->id]) }}" method="post">
                                            @csrf

                                            <div class="row">

                                                <div class="form-group col-md-12">
                                                    <div class="col-sm-12">
                                                        <label for="status"><u>Статус</u></label>
                                                        <select class="custom-select rounded-0 js-select" name="status" id="status">
                                                            <option value="1" {{ $review->status == 1 ? 'selected' : '' }}>Включен</option>
                                                            <option value="0" {{ $review->status == 0 ? 'selected' : '' }}>Скрыт</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок ru</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_ru" class="form-control" id="name" value="{{ $review->name_ru }}">
                                                    @if($errors->has('name_ru'))<span class="text-danger"> {{ $errors->first('name_ru') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок uz</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_uz" class="form-control" id="name" value="{{ $review->name_uz }}">
                                                    @if($errors->has('name_uz'))<span class="text-danger"> {{ $errors->first('name_uz') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Заголовок en</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_en" class="form-control" id="name" value="{{ $review->name_en }}">
                                                    @if($errors->has('name_en'))<span class="text-danger"> {{ $errors->first('name_en') }}</span>@endif
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
                                                                if(isset($review->pictures)):
                                                                    $filepath = [];
                                                                    foreach($review->pictures as $file):
                                                                        $filepath[] = $file->orig;
                                                                    endforeach;
                                                                    $filepath = implode(',', $filepath);
                                                                endif;
                                                            @endphp

                                                            <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ $filepath ?? '' }}">
                                                            <div id="gallery-img-output" class="upload-images gallery-image">
                                                                @if(isset($review->pictures))
                                                                    @foreach($review->pictures as $key => $picture)
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
                                            <label for="markup[ru][two]" class="col-sm-12 col-form-label"><u>Страна</u></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="markup[ru][two]" class="form-control" id="markup[ru][two]" value="{{ $review->markup->ru->two ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[ru][one]">{{ $review->markup->ru->one ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- UZ --}}
                                    <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz_tab">

                                        <div class="form-group">
                                            <label for="markup[uz][two]" class="col-sm-12 col-form-label"><u>Страна</u></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="markup[uz][two]" class="form-control" id="markup[uz][two]" value="{{ $review->markup->uz->two ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[uz][one]">{{ $review->markup->uz->one ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- EN --}}
                                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en_tab">

                                        <div class="form-group">
                                            <label for="markup[en][two]" class="col-sm-12 col-form-label"><u>Страна</u></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="markup[en][two]" class="form-control" id="markup[en][two]" value="{{ $review->markup->en->two ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="description"><u>Краткое описание</u></label>
                                                <textarea id="description" class="form-control summernote" name="markup[en][one]">{{ $review->markup->en->one ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('review_admin') }}" type="submit" class="btn btn-primary">Отменить</a>
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
