@extends('admin.layouts.main')

@section('title')
    Партнёры
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Партнёры</h1>
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
                                <h3 class="card-title">Партнёры</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Изображение</th>
                                        <th>Компания</th>
                                        <th>Статус</th>
                                        <th>Партнерство</th>
                                        <th>Путь</th>
                                        <th>Действие</th></tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $catalog = \App\Models\Page::find(2);
                                    @endphp

                                    @if(isset($partners))
                                        @foreach($partners as $partner)
                                            <tr>
                                                <td class="text-center" style="width: 0;">
                                                    @if($partner->avatar)
                                                        <img src="{{ asset($partner->avatar) }}" style="height: 60px;" alt="">
                                                    @else
                                                        <img src="{{ asset('cms/dist/img/no_image.png') }}" style="height: 60px;" alt="">
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;">{{ $partner->name }}</td>
                                                <td style="vertical-align: middle;">{{ $partner->status->name }}</td>
                                                <td style="vertical-align: middle;">{{ $partner->is_partner ? '✅' : '❌' }}</td>
                                                <td style="vertical-align: middle;"><a href="{{ url(app()->getLocale().'/'.$catalog->slug.'/company/'.$partner->id) }}" target="_blank">{{ substr($catalog->slug.'/company/'.$partner->id, 0, 30) }}</a></td>
                                                <td style="width: 5%; vertical-align: middle;">
                                                    <a href="{{ route('partner_edit', [$partner->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer clearfix d-flex justify-content-end">
                                {{ $partners->appends(request()->input())->links() }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection