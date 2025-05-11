@extends('admin.layouts.main')

@section('title')
    Отзывы
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Отзывы</h1>
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
                            <div class="card-header">
                                <a href="{{ route('review_create') }}" class="btn btn-success btn-flat"><i class="fas fa-plus"></i> Добавить отзыв</a>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Отзывы</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Изображение</th>
                                        <th>Заголовок</th>
                                        <th>Действие</th></tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($reviews))
                                        @foreach($reviews as $event)
                                            <tr>
                                                <td class="text-center" style="width: 0;">
                                                    @if($event->picture())
                                                        <img src="{{ asset($event->picture()->orig) }}" style="height: 60px;" alt="">
                                                    @else
                                                        <img src="{{ asset('cms/dist/img/no_image.png') }}" style="height: 60px;" alt="">
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;">{{ $event->name_ru }}</td>
                                                <td style="width: 5%; vertical-align: middle;">
                                                    <a class="btn status_selection" id="{{ $event->id }}" value="{{ $event->status }}" style="padding: 0;" onclick="changeStatus({{ $event->id }}, '{{ route('review_changeStatus', $event->id) }}')">
                                                        <span class="fa fa-eye{{ $event->status == 1 ? '' : '-slash'}}"></span>
                                                    </a>
                                                    <a href="{{ route('review_edit', [$event->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                    <a href="{{ route('review_delete', [$event->id]) }}" onclick="return confirm('Вы уверены, что хотите удалить приложение {{ $event->name_ru }}?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer clearfix d-flex justify-content-end">
                                {{ $reviews->appends(request()->input())->links() }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection