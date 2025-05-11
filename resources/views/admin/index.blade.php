@extends('admin.layouts.main')

@section('title')
    структура
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Структура</h1>
                    </div>

                </div>
            </div>
        </div>

        @if(session('success'))
            <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
        @endif

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
{{--                            <div class="card-header">--}}
{{--                                <a href="{{ route('page_create') }}" class="btn btn-success btn-flat"><i class="fas fa-plus"></i> Добавить раздел</a>--}}
{{--                            </div>--}}
                            <div class="card-header">
                                <h3 class="card-title">Разделы</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Заголовок</th>
                                        <th>Путь</th>
                                        <th>Действие</th></tr>
                                    </thead>
                                    <tbody class="selectable-demo-list sections_list" id="section_list">
                                    @if ($pages)
                                        @foreach($pages as $page)
                                            <tr data-id="">

                                                <td style="width: 0">#</td>

                                                <td>{{ $page->name_ru }}</td>
                                                <td><a href="{{ url($page->link) }}" target="_blank">{{ Str::limit($page->slug, 15) }}</a></td>

                                                <td style="width: 5%;">
                                                    <a href="{{ route('page_edit', $page->id) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
{{--                                                    @if($page->id !== 1)--}}
{{--                                                        <a href="{{ route('page_delete', $page->id) }}" onclick="return confirm('Вы уверены, что хотите удалить раздел {{ $page->name_ru }}?');"><i class="fa fa-trash"></i></a>--}}
{{--                                                    @endif--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer clearfix d-flex justify-content-end">
                                {{ $pages->appends(request()->input())->links() }}
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
