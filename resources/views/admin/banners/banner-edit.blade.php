@extends('admin.layouts.main')

@section('title')
    редактирование баннера
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование баннера</h1>
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
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('banner_update', [$banner->id]) }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="status"><u>Статус</u></label>
                                                    <select class="custom-select rounded-0 js-select" name="status" id="status">
                                                        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Включен</option>
                                                        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Скрыт</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 col-form-label"><u>Ссылка</u></label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="link" class="form-control" id="link" value="{{ $banner->link }}">
                                                </div>
                                            </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Изображения</h3>
                                                </div>
                                                <div class="card-body">
                                                    <button class="btn btn-success mb-2" id="lfm" data-input="thumbnail" data-preview="gallery-img-output">Загрузить</button>

                                                    <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ $banner->picture()?->orig ?? '' }}">
                                                    <div id="gallery-img-output" class="upload-images gallery-image">
                                                        @if($banner->picture())
                                                            <div class="product-img-upload col-md-3" data-id="0" data-orig="{{ $banner->picture()?->orig }}" data-delete="{{ route('pictures_delete', $banner->picture()?->id ?? 0) }}">
                                                                <img src="{{ asset($banner->picture()?->orig) }}" style="height: auto">
                                                                <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('banner_admin') }}" type="submit" class="btn btn-primary">Отменить</a>
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