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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Номер</th>
                                    <th>Действие</th></tr>
                                </thead>
                                <tbody>

                                @if(isset($drivers))
                                    @foreach($drivers as $driver)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $driver->first_name }}</td>
                                            <td style="vertical-align: middle;">{{ $driver->middle_name }}</td>
                                            <td style="vertical-align: middle;">{{ $driver->phone }}</td>
                                            <td style="width: 5%; vertical-align: middle;">
                                                <a href="{{ route('driver_admin_edit', [$driver->id]) }}" style="padding: 0 15px;"><i class="fas fa-pen"></i></a>
                                                <a href="{{ route('driver_admin_delete', [$driver->id]) }}" onclick="return confirm('Вы уверены, что хотите удалить водителя #{{ $driver->id }} - {{ $driver->first_name }}?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection