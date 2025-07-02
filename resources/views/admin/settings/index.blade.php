@extends('admin.layouts.main')

@section('title')
    настройки
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Настройки</h1>
                    </div>

                </div>
            </div>
        </div>

        @if(session('success'))
            <span id="events" data-message="{{ session('success') }}" data-action="success"></span>
        @endif

        @if(session('error'))
            <span id="events" data-message="{{ session('error') }}" data-action="error"></span>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Основное</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p class="text-danger">{{ $error }}</p>
                                    @endforeach
                                @endif

                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        @if($errors->has('error'))<div class="alert alert-danger"> {{ $errors->first('error') }}</div>@endif
                                        <form class="form-horizontal" action="{{ route('setting_update', [$setting?->id]) }}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            {{-- Address --}}
                                            <div class="row">

                                                <div class="form-group col-md">
                                                    <label for="markup[address][ru]"><u>Адрес [ru]</u></label>
                                                    <input type="text" name="markup[address][ru]" class="form-control" id="markup[address][ru]" value="{{ $setting->markup['address']['ru'] ?? ''}}">
                                                </div>

                                                <div class="form-group col-md">
                                                    <label for="markup[address][uz]"><u>Адрес [uz]</u></label>
                                                    <input type="text" name="markup[address][uz]" class="form-control" id="markup[address][uz]" value="{{ $setting->markup['address']['uz'] ?? ''}}">
                                                </div>

                                                <div class="form-group col-md">
                                                    <label for="markup[address][en]"><u>Адрес [en]</u></label>
                                                    <input type="text" name="markup[address][en]" class="form-control" id="markup[address][en]" value="{{ $setting->markup['address']['en'] ?? ''}}">
                                                </div>

                                            </div>

                                            {{-- Socials --}}
                                            <div class="row">

                                                <div class="form-group col-md">
                                                    <label for="markup[socials][youtube]"><u>Youtube</u></label>
                                                    <input type="text" name="markup[socials][youtube]" class="form-control" id="markup[socials][youtube]" value="{{ $setting->markup['socials']['youtube'] ?? ''}}">
                                                </div>

                                                <div class="form-group col-md">
                                                    <label for="markup[socials][instagram]"><u>Instagram</u></label>
                                                    <input type="text" name="markup[socials][instagram]" class="form-control" id="markup[socials][instagram]" value="{{ $setting->markup['socials']['instagram'] ?? ''}}">
                                                </div>

                                                <div class="form-group col-md">
                                                    <label for="markup[socials][facebook]"><u>Faceebok</u></label>
                                                    <input type="text" name="markup[socials][facebook]" class="form-control" id="markup[socials][facebook]" value="{{ $setting->markup['socials']['facebook'] ?? ''}}">
                                                </div>

                                            </div>

                                            {{-- Emails --}}
                                            <div class="row">
                                                <div class="form-group col-md">
                                                    <label for="markup[emails][0]"><u>Emails</u></label>
                                                    <input type="text" name="markup[emails][0]" class="form-control" id="markup[emails][0]" value="{{ $setting->markup['emails'][0] ?? ''}}">
                                                </div>
                                            </div>

                                            {{-- Phones --}}
                                            <div class="row">
                                                <div class="form-group col-md">
                                                    <label for="markup[phones][0]"><u>Phones</u></label>
                                                    <input type="text" name="markup[phones][0]" class="form-control" id="markup[phones][0]" value="{{ $setting->markup['phones'][0] ?? ''}}">
                                                </div>
                                            </div>

                                            {{-- Coordinates --}}
                                            <div class="row">
                                                <div class="form-group col-md">
                                                    <label for="markup[coordinates][lat]"><u>Долгота</u></label>
                                                    <input type="text" name="markup[coordinates][lat]" class="form-control" id="markup[coordinates][lat]" value="{{ $setting->markup['coordinates']['lat'] ?? ''}}">
                                                </div>

                                                <div class="form-group col-md">
                                                    <label for="markup[coordinates][long]"><u>Широта</u></label>
                                                    <input type="text" name="markup[coordinates][long]" class="form-control" id="markup[coordinates][long]" value="{{ $setting->markup['coordinates']['long'] ?? ''}}">
                                                </div>
                                            </div>


                                            {{-- Публичная оферта --}}
                                            <div class="form-group">
                                                <label for="public_offer"><u>Публичная оферта (PDF)</u></label>

                                                @if(!empty($setting->markup['public_offer']))
                                                    <p>
                                                        <a href="{{ asset($setting->markup['public_offer']) }}" target="_blank">Скачать текущую оферту</a>
                                                    </p>
                                                @endif

                                                <input type="file" name="public_offer" class="form-control" accept=".pdf">
                                            </div>

                                            {{-- Правила регистрации --}}
                                            <div class="form-group">
                                                <label for="terms"><u>Правила регистрации (PDF)</u></label>

                                                @if(!empty($setting->markup['terms']))
                                                    <p>
                                                        <a href="{{ asset($setting->markup['terms']) }}" target="_blank">Скачать текущие правила</a>
                                                    </p>
                                                @endif

                                                <input type="file" name="terms" class="form-control" accept=".pdf">
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </div>
                                            </div>

                                        </form>

                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection