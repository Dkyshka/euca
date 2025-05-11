@extends('admin.layouts.main')

@section('title')
    Лог действий
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Лог действий</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Лог действий</h3>
                        </div>

                        <div class="card-body table-responsive p-0">

                            <table class="table table-striped table-actions table-hover">
                                <thead class="bg-light">
                                <tr class="active">
                                    <th width="11%">Дата</th>
                                    <th width="10%" class="text-center">Пользователь</th>
                                    <th width="72%">Запись</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td class="small align-middle" nowrap="nowrap">
                                        <div class="small text-info">{{ $log?->created_at?->format('d.m.Y H:i') }}</div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-light">{{ $log->user->name }}</span>
                                    </td>
                                    <td class="align-middle" nowrap="nowrap">
                                        <mark>{{ $log?->message }}</mark>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix d-flex justify-content-end">
                            {{ $logs->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection