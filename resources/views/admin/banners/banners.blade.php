@extends('admin.layouts.main')

@section('title')
    Баннеры
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Баннеры</h1>
                    </div>

                </div>
            </div>
        </div>

        @if(session('success'))
            <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
        @endif

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{--                            <div class="card-header">--}}
                            {{--                                <a href="{{ route('media_create') }}" class="btn btn-success btn-flat"><i class="fas fa-plus"></i> Добавить медиа</a>--}}
                            {{--                            </div>--}}
                            <div class="card-header">
                                <h3 class="card-title">Баннеры</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Изображение</th>
                                        <th>Блок</th>
                                        <th>Действие</th></tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($banners))
                                        @foreach($banners as $item)
                                            <tr>
                                                <td class="text-center" style="">
                                                    @if($item->picture())
                                                        <img src="{{ asset($item->picture()->orig) }}" style="height: 150px; margin-left: 10px; display: block;" alt="">
                                                    @else
                                                        <img src="{{ asset('cms/dist/img/no_image.png') }}" style="height: 60px; margin-left: 10px; display: block;" alt="">
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <p class="text-info">{{ $item->type_banner == 'header' ? 'Side bar' : ($item->type_banner == 'section' ? 'Секция' : 'Side bar') }}</p>
                                                </td>
                                                <td style="width: 5%; vertical-align: middle;">
                                                    <a class="btn status_selection" id="{{ $item->id }}" value="{{ $item->status }}" style="padding: 0;" onclick="changeStatus({{ $item->id }}, '{{ route('banner_changeStatus', $item->id) }}')">
                                                        <span class="fa fa-eye{{ $item->status == 1 ? '' : '-slash'}}"></span>
                                                    </a>
                                                    <a href="{{ route('banner_edit', [$item->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                    {{--                                                    <a href="{{ route('media_delete', [$item->id]) }}" onclick="return confirm('Вы уверены, что хотите удалить рецензию {{ $item->name_ru }}?');"><i class="fa fa-trash"></i></a>--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            {{--                            <div class="card-footer clearfix d-flex justify-content-end">--}}
                            {{--                                {{ $banners->appends(request()->input())->links() }}--}}
                            {{--                            </div>--}}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection