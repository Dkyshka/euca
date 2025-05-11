@extends('admin.layouts.main')

@section('title')
    редактирование раздела
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Раздел</h1>
                    </div>

                </div>
            </div>
        </div>

        @if(session('success'))
            <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
        @endif

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        @if(isset($page->sections) && request('section'))
                            <form action="{{ route('section_update', [request('section'), $page->id]) }}" method="post">
                                @csrf

                                @foreach($page->sections as $section)
                                    @if($section->id == request('section'))
                                        {{ view('admin.sections.'.$section->type, compact('section')) }}
                                    @endif
                                @endforeach

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary" onclick="updateAdvatages()">Сохранить</button>
                                        <button type="submit" name="section_apply" class="btn btn-primary" onclick="updateAdvatages()">Применить</button>
                                        <a href="{{ url()->current().'?show_section=true' }}" type="submit" class="btn btn-primary">Отменить</a>
                                    </div>
                                </div>

                                @else

                                    <div class="card">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link {{ !request('show_section') ? 'active' : '' }}" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Основное</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link {{ request('show_section') ? 'active' : '' }}" id="custom-tabs-three-blocks-tab" data-toggle="pill" href="#custom-tabs-three-blocks" role="tab" aria-controls="custom-tabs-three-blocks" aria-selected="false">Блоки</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-seo-blocks-tab" data-toggle="pill" href="#custom-tabs-seo-blocks" role="tab" aria-controls="custom-tabs-seo-blocks" aria-selected="false">Seo</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">

                                            <div class="tab-content" id="custom-tabs-three-tabContent">

                                                <div class="tab-pane fade {{ !request('show_section') ? 'active show' : '' }}" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                                    @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                                    <form class="form-horizontal" action="{{ route('page_update', $page->id) }}" method="post">
                                                        @csrf

{{--                                                        @if($page->id !== 1)--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <div class="col-sm-12">--}}
{{--                                                                <label for="parent_id"><u>Родительский раздел</u></label>--}}
{{--                                                                <select class="custom-select rounded-0 js-select" name="parent_id" id="parent_id">--}}
{{--                                                                    <option value="">Нечего не выбрано</option>--}}
{{--                                                                    @foreach($pages as $item)--}}
{{--                                                                        <option value="{{ $item->id }}" {{ $item->id == $page->parent_id ? 'selected' : ''}}>{{ $item->name_ru }}</option>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        @endif--}}

                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <label for="status">Статус</label>
                                                                <select class="custom-select rounded-0 js-select" name="status" id="status">
                                                                    <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Включен</option>
                                                                    <option value="0" {{ $page->status == 0 ? 'selected' : '' }}>Скрыт</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row col-md">
                                                            <div class="form-group d-flex ml-2" style="gap: 0 20px">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="header" name="header" role="button" {{ $page->header ? 'checked' : '' }} value="1">
                                                                    <label class="custom-control-label" for="header" role="button">Меню</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group d-flex ml-2" style="gap: 0 20px">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="footer" name="footer" role="button" {{ $page->footer ? 'checked' : '' }} value="1">
                                                                    <label class="custom-control-label" for="footer" role="button">Footer</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name" class="col-sm-2 col-form-label">Имя ru</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="name_ru" class="form-control" id="name" value="{{ $page->name_ru }}">
                                                                @if($errors->has('name_ru'))<span class="text-danger"> {{ $errors->first('name_ru') }}</span>@endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name" class="col-sm-2 col-form-label">Имя uz</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="name_uz" class="form-control" id="name" value="{{ $page->name_uz }}">
                                                                @if($errors->has('name_uz'))<span class="text-danger"> {{ $errors->first('name_uz') }}</span>@endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name_en" class="col-sm-2 col-form-label">Имя en</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="name_en" class="form-control" id="name_en" value="{{ $page->name_en }}">
                                                                @if($errors->has('name_en'))<span class="text-danger"> {{ $errors->first('name_en') }}</span>@endif
                                                            </div>
                                                        </div>


                                                        <div class="form-group @if($page->id == 1) d-none @endif">
                                                            <label for="name" class="col-sm-2 col-form-label">URL</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" @if($page->id !== 1)id="slug" @endif name="slug" class="form-control" value="{{ $page->slug }}">
                                                                @if($errors->has('slug'))<span class="text-danger"> {{ $errors->first('slug') }}</span>@endif
                                                            </div>
                                                        </div>

                                                </div>

                                                <div class="tab-pane fade {{ isset($_GET['show_section']) ? 'active show' : '' }}" id="custom-tabs-three-blocks" role="tabpanel" aria-labelledby="custom-tabs-three-blocks-tab">

{{--                                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">--}}
{{--                                                        Выбрать блок--}}
{{--                                                    </button>--}}

                                                    <div class="card-body table-responsive p-0 pt-4 pb-4">
                                                        <table class="table table-hover text-nowrap">
                                                            <tbody class="selectable-demo-list sections_list" id="section_list">
                                                            @if(isset($page->sections))
                                                                @foreach($page->sections as $section)
                                                                    <tr data-id="{{ $section->id }}">
                                                                        <td class="text-right move_zone" nowrap="nowrap" style="width: 0">
                                                                            <i class="fas fa-exchange-alt" style="font-size: 16px;transform: rotate(90deg);opacity: .7;cursor: grab;" data-toggle="tooltip"></i>
                                                                        </td>
                                                                        <td>{{ $section->section_name }}</td>
                                                                        <td style="width: 1%;">
                                                                            <a class="btn status_selection" id="{{ $section->id }}" value="{{ $section->status }}" style="padding: 0;" onclick="changeStatus({{ $section->id }}, '{{ route('section_changeStatus', $section->id) }}')">
                                                                                <span class="fa fa-eye{{ $section->status == 1 ? '' : '-slash'}}"></span>
                                                                            </a>
                                                                            <a href="?section={{ $section->id }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
{{--                                                                            <a href="javascript:;" onclick="deleteSection({{ $section->id }}, '{{ $section->section_name }}')"><i class="fa fa-trash"></i></a>--}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="custom-tabs-seo-blocks" role="tabpanel" aria-labelledby="custom-tabs-seo-blocks-tab">

                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="name" class="col-sm col-form-label">Meta title ru</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="meta_title_ru" class="form-control" id="name" value="{{ $page->meta_title_ru }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="name" class="col-sm col-form-label">Meta title uz</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="meta_title_uz" class="form-control" id="name" value="{{ $page->meta_title_uz }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="name" class="col-sm col-form-label">Meta title en</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="meta_title_en" class="form-control" id="name" value="{{ $page->meta_title_en }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-form-label">Description ru</label>
                                                        <div class="col-sm-12">
                                                            <textarea type="text" name="description_ru" class="form-control" id="name" value="{{ $page->description_ru }}"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-form-label">Description uz</label>
                                                        <div class="col-sm-12">
                                                            <textarea type="text" name="description_uz" class="form-control" value="{{ $page->description_uz }}"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-form-label">Description en</label>
                                                        <div class="col-sm-12">
                                                            <textarea type="text" name="description_en" class="form-control" value="{{ $page->description_en }}"></textarea>
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

                        @endif

            </div>

    </div>
    </section>
    </div>

    <!-- create blocks modal-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="height: 90vh;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Выберете блок</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items- justify-content-center">
                        <div title="Навигационный блок" class="m-2 card-2" data-type="main" data-name="Навигационный блок" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/main-block-1.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Рекламный баннер" class="m-2 card-2" data-type="ads-banner" data-name="Рекламный баннер" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/ads-banner.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Заказы - История" class="m-2 card-2" data-type="orders-history" data-name="Заказы - История" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/orders-history.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Информационный блок" class="m-2 card-2" data-type="about" data-name="Информационный блок" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/about.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Партнёры" class="m-2 card-2" data-type="partners" data-name="Партнёры" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/partners.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Аккордион" class="m-2 card-2" data-type="service" data-name="Аккордион" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/service.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Тарифы" class="m-2 card-2" data-type="tariffs" data-name="Тарифы" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/tariffs.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Информационный блок красный" class="m-2 card-2" data-type="danger" data-name="Информационный блок красный" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/danger.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Бренды" class="m-2 card-2" data-type="brands" data-name="Бренды" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/brands.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                        <div title="Сотрудники" class="m-2 card-2" data-type="employee" data-name="Сотрудники" onclick="addSection(this)" style="background: url({{ asset('cms/dist/img/components/employee.jpg') }}); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: #fff;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTypeBlock">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Adding a section -->
    <script>
        async function addSection(elem) {
            document.getElementById("closeTypeBlock").click();

            let section_name = elem.dataset.name;
            let type = elem.dataset.type;
            let csrf = document.querySelector('[name="_token"]').value;

            const data = {
                _token: csrf,
                section_name: section_name,
                type: type,
            };

            const config = {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }

            return new Promise((resolve, reject) => {
                fetch('{{ route('section_store', $page->id) }}', config)
                    .then((response) => response.json())
                    .then((result) => {
                        if (result.status === '200') {
                            $('#section_list').append(`
                            <tr data-id="${result.data.id}">
                                <td class="text-right move_zone" nowrap="nowrap" style="width: 0;">
                                    <i class="fas fa-exchange-alt" style="font-size: 16px;transform: rotate(90deg);opacity: .7;cursor: grab;" data-toggle="tooltip" data-placement="top"></i>
                                </td>
                                <td>${result.data.section_name}</td>
                                <td style="width: 5%;">
                                    <a class="btn status_selection p-0" id="${result.data.id}" value="1" onclick="changeStatus(${result.data.id}, '{{ route('section_changeStatus') }}/${result.data.id}')">
                                        <span class="fa fa-eye"></span>
                                    </a>
                                    <a href="?section=${result.data.id}" data-edit="${data.id}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:;" data-delete="${result.data.id}" onclick="deleteSection(${result.data.id}, '${result.data.section_name}')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        `);
                        } else {
                            console.log('Произошла ошибка')
                        }
                    })
                    .catch((errors) => {
                        console.log('false')
                        reject(errors)
                    })
            })
        }

        async function deleteSection(id, name) {
            let result = confirm('Вы уверены, что хотите удалить блок '+name+'?');
            const csrf = document.querySelector('[name="_token"]').value;

            const data = {
                _token: csrf,
            };

            console.log('{{ route('section_delete') }}/' + id)

            const config = {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }

            if (result) {
                return new Promise((resolve, reject) => {
                    fetch('{{ route('section_delete') }}/'+ id, config)
                        .then((response) => response.json())
                        .then((result) => {
                            if (result.status === '200') {
                                document.querySelector('[data-id = "'+id+'"]').remove();
                            }
                        })
                        .catch((errors) => {
                            reject(errors)
                        })
                })
            }

        }
    </script>

    <script>
        document.querySelector('[name="apply"]')?.addEventListener('click', function(e) {
            e.target.value = 1;
        });

        document.querySelector('[name="section_apply"]')?.addEventListener('click', function(e) {
            e.target.value = 1;
        });
    </script>
@endsection
