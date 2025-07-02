@extends('admin.layouts.main')

@section('title')
    настройки
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- /.container-fluid -->
        </section>

        @if(session('success'))
            <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- AREA CHART -->
                        <div class="card card-primary" style="display: none">
                            <div class="card-header">
                                <h3 class="card-title">Area Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Статистика</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                            <div class="card-body">
                                <p class="text-right">
                                    <a class="btn btn-warning" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Фильтр</a>
                                </p>
                                <div class="row">
                                    <div class="col">
                                        <div class="collapse multi-collapse {{ request()->input() ? 'show' : '' }}" id="multiCollapseExample1">
                                            <div class="card-body">

                                                <form method="GET" action="{{ route('statistic_cargo') }}" class="p-3 row">
                                                    <div class="form-group col-md-3">
                                                        <label for="from">Откуда</label>
                                                        <input type="text" name="from" id="from" class="form-control" value="{{ request('from') }}">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="to">Куда</label>
                                                        <input type="text" name="to" id="to" class="form-control" value="{{ request('to') }}">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="status_id">Статус</label>
                                                        <select name="status_id" id="status_id" class="form-control">
                                                            <option value="">Все</option>
                                                            @foreach(\App\Models\CargoLoading::STATUSES as $key => $label)
                                                                <option value="{{ $key }}" {{ request('status_id') == $key ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Дата создания (от)</label>
                                                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>Дата создания (до)</label>
                                                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                                                    </div>

                                                    <div class="form-group col-md-12 mt-3">
                                                        <button type="submit" class="btn btn-outline-info btn-flat">Фильтровать</button>
                                                        <a href="{{ route('statistic_cargo') }}" class="btn btn-outline-secondary btn-flat">Сбросить</a>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>


                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Откуда</th>
                                    <th>Куда</th>
                                    <th>Создано</th>
                                    <th>Путь</th>
                                    <th>Статус</th>
                                    <th>Действие</th></tr>
                                </thead>
                                <tbody>
                                @php
                                $cargoSearchPage = \App\Models\Page::find(3);
                                @endphp

                                @if(isset($cargoLoadings))
                                    @foreach($cargoLoadings as $cargoLoading)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ Str::limit($cargoLoading->country, 50) }}</td>
                                            <td style="vertical-align: middle;">{{ Str::limit($cargoLoading->final_unload_city, 50) }}</td>
                                            <td style="vertical-align: middle;">{{ $cargoLoading->created_at?->format('d.m.Y') }}</td>
                                            <td style="vertical-align: middle;"><a href="{{ url(app()->getLocale().'/'. $cargoSearchPage->slug. '/cargo-inner/' . $cargoLoading->id) }}" target="_blank">{{ substr($cargoSearchPage->slug, 0, 30) }}</a></td>
                                            <td style="vertical-align: middle;">
                                                {{ \App\Models\CargoLoading::STATUSES[$cargoLoading->status] }}
                                            </td>
                                            <td style="width: 5%; vertical-align: middle;">
                                                <a href="{{ route('cargo_admin_edit', [$cargoLoading->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                <a href="{{ route('cargo_admin_delete', [$cargoLoading->id]) }}" onclick="return confirm('Вы уверены, что хотите удалить груз #{{ $cargoLoading->id }} - {{ $cargoLoading->country }}?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix d-flex justify-content-end">
                            {{ $cargoLoadings->appends(request()->input())->links() }}
                        </div>
                        <!-- /.card -->

                        <!-- PIE CHART -->
                        <div class="card card-danger" style="display: none">
                            <div class="card-header">
                                <h3 class="card-title">Pie Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                        <!-- LINE CHART -->
                        <div class="card card-info" style="display: none">
                            <div class="card-header">
                                <h3 class="card-title">Line Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- BAR CHART -->
                        <div class="card card-success" style="display: none">
                            <div class="card-header">
                                <h3 class="card-title">Bar Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- STACKED BAR CHART -->
                        <div class="card card-success" style="display: none">
                            <div class="card-header">
                                <h3 class="card-title">Stacked Bar Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection