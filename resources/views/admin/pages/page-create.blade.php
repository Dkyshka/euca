@extends('admin.layouts.main')

@section('title')
    создание раздела
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Добавление раздела</h1>
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
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Основное</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-blocks-tab" data-toggle="pill" href="#custom-tabs-three-blocks" role="tab" aria-controls="custom-tabs-three-blocks" aria-selected="false">Блоки</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-seo-blocks-tab" data-toggle="pill" href="#custom-tabs-seo-blocks" role="tab" aria-controls="custom-tabs-seo-blocks" aria-selected="false">Блоки</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('page_store') }}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="parent_id"><u>Родительский раздел</u></label>
                                                    <select class="custom-select rounded-0 js-select" name="parent_id" id="parent_id">
                                                        <option value="">Нечего не выбрано</option>
                                                        @foreach($pages as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name_ru }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="status">Статус</label>
                                                    <select class="custom-select rounded-0 js-select" name="status" id="status">
                                                        <option value="1">Включен</option>
                                                        <option value="0">Скрыт</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row col-md">
                                                <div class="form-group d-flex ml-2" style="gap: 0 20px">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="header" name="header" role="button" value="1">
                                                        <label class="custom-control-label" for="header" role="button">Header</label>
                                                    </div>
                                                </div>

                                                <div class="form-group d-flex ml-2" style="gap: 0 20px">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="footer" name="footer" role="button" value="1">
                                                        <label class="custom-control-label" for="footer" role="button">Footer</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-form-label">Имя ru</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_ru" class="form-control" id="name" value="{{ old('name_ru') }}">
                                                    @if($errors->has('name_ru'))<span class="text-danger"> {{ $errors->first('name_ru') }}</span>@endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name_uz" class="col-sm-2 col-form-label">Имя uz</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_uz" class="form-control" id="name_uz" value="{{ old('name_uz') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name_tr" class="col-sm-2 col-form-label">Имя tr</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_tr" class="form-control" id="name_tr" value="{{ old('name_tr') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name_en" class="col-sm-2 col-form-label">Имя en</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="name_en" class="form-control" id="name_en" value="{{ old('name_en') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-form-label">URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}">
                                                    @if($errors->has('slug'))<span class="text-danger"> {{ $errors->first('slug') }}</span>@endif
                                                </div>
                                            </div>

                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-three-blocks" role="tabpanel" aria-labelledby="custom-tabs-three-blocks-tab">
                                        <div class="callout callout-info">
                                            <h4>Добавление блоков доступно после сохранения раздела</h4>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-seo-blocks" role="tabpanel" aria-labelledby="custom-tabs-seo-blocks-tab">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="meta_title_ru" class="col-sm col-form-label">Meta title ru</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="meta_title_ru" class="form-control" id="meta_title_ru" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="meta_title_uz" class="col-sm col-form-label">Meta title uz</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="meta_title_uz" class="form-control" id="meta_title_uz" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="meta_title_en" class="col-sm col-form-label">Meta title en</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="meta_title_en" class="form-control" id="meta_title_en" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-form-label">Description ru</label>
                                                <div class="col-sm-12">
                                                    <textarea type="text" name="description_ru" class="form-control" id="name" value=""></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-form-label">Description uz</label>
                                                <div class="col-sm-12">
                                                    <textarea type="text" name="description_uz" class="form-control" value=""></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-form-label">Description en</label>
                                                <div class="col-sm-12">
                                                    <textarea type="text" name="description_en" class="form-control" value=""></textarea>
                                                </div>
                                            </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button type="submit" name="apply" class="btn btn-primary">Применить</button>
                                            <a href="{{ route('admin_index') }}" type="submit" class="btn btn-primary">Отменить</a>
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

        <style>
            .custom-control-input:checked~.custom-control-label::before {
                border-color: #18a92e;
                background-color: #18a92e;
            }
        </style>

    </div>
    <script>
        document.querySelector('[name="apply"]')?.addEventListener('click', function(e) {
            e.target.value = 1;
        });
    </script>
@endsection
