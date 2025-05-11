@extends('admin.layouts.main')

@section('title')
    Языки
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content">

            @if(session('success'))
                <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
            @endif

            @if(session('error'))
                <span id="events" data-message="{{ session('error') }}" data-action="error"></span>
            @endif

            <div class="container-fluid">

                <form action="{{ route('lang_import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row pt-3">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Файл xlsx</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="file" onchange="getFileData(this)" accept=".xlsx" required>
                                        <label class="custom-file-label" for="file"></label>

                                    </div>
                                    <div class="input-group-append">
                                        <button class="input-group-text">Загрузить</button>
                                    </div>

                                </div>
                            </div>
                            @if(session('error'))
                                <p class="text-danger">{{ session('error') }}</p>
                            @endif
                        </div>


                        <script>
                            function getFileData(myFile){
                                let file = myFile.files[0];
                                document.querySelector('.custom-file-label').innerText = file.name;
                            }
                        </script>

                    </div>

                </form>
                <div class="col-md-3">
                    <a href="{{ route('lang_export') }}" class="btn btn-block btn-success btn-flat">Скачать шаблон перевода</a>
                </div>
            </div>

        </div>
    </div>
@endsection
