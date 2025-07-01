<x-main.assets-header-profile :page="$page"/>

<main class="main-wrapper">
    <div class="profile-page">

        <x-main.assets-sidebar/>

        <x-main.assets-mobile-nav :menu="$menu" :page="$page"/>

        <div class="profile-settings">
            <header class="profile-header">

            <button class="nav__btn-header" aria-label="навигационное меню">
			<span>
				<span></span>
			</span>
                </button>

                <button class="go-back">
                    <svg width="20" height="20">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                </button>

                <h1>{{ __('lang.Ваш автопарк') }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">


                <div class="drivers__list">
                    <div class="drivers-content">
                        <h5>{{ __('lang.Автопарк') }}</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('transports.update', [app()->getLocale(), $transport->id]) }}" method="POST">
                            @csrf

                            <div class="choise-cash">

                                <input type="radio" name="payment_type" id="notr" value="no_haggling" {{ $transport->payment_type == 'no_haggling' ? 'checked' : '' }}>
                                <label for="notr">{{ __('lang.Есть ставка') }}</label>

                                <input type="radio" name="payment_type" id="tr" value="payment_request" {{ $transport->payment_type == 'payment_request' ? 'checked' : '' }}>
                                <label for="tr">{{ __('lang.Запросить ставку') }}</label>
                            </div>

                            <div class="add-goods__bid">
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.С НДС, безнал') }}</p>
                                    <label for="with_vat_cashless">
                                        <input type="number" name="with_vat_cashless" id="with_vat_cashless" value="{{ $transport?->with_vat_cashless ?? '' }}">
                                        @if ($errors->has('with_vat_cashless'))<br><p style="color:red;">{{ $errors->first('with_vat_cashless') }}</p>@endif
                                    </label>
                                    <label>
                                        <select name="currency" id="currency" class="input-select">
                                            <option value="{{ __('lang.узб.сум') }}" {{ old('currency', $transport->currency) === __('lang.узб.сум') ? 'selected' : '' }}>{{ __('lang.узб.сум') }}</option>
                                            <option value="{{ __('lang.узб.сум/км') }}" {{ old('currency', $transport->currency) === __('lang.узб.сум/км') ? 'selected' : '' }}>{{ __('lang.узб.сум/км') }}</option>
                                            <option value="{{ __('lang.узб.сум/т') }}" {{ old('currency', $transport->currency) === __('lang.узб.сум/т') ? 'selected' : '' }}>{{ __('lang.узб.сум/т') }}</option>
                                            <option value="{{ __('lang.доллар') }}" {{ old('currency', $transport->currency) === __('lang.доллар') ? 'selected' : '' }}>{{ __('lang.доллар') }}</option>
                                            <option value="{{ __('lang.доллар/км') }}" {{ old('currency', $transport->currency) === __('lang.доллар/км') ? 'selected' : '' }}>{{ __('lang.доллар/км') }}</option>
                                            <option value="{{ __('lang.доллар/т') }}" {{ old('currency', $transport->currency) === __('lang.доллар/т') ? 'selected' : '' }}>{{ __('lang.доллар/т') }}</option>
                                            <option value="{{ __('lang.евро') }}" {{ old('currency', $transport->currency) === __('lang.евро') ? 'selected' : '' }}>{{ __('lang.евро') }}</option>
                                            <option value="{{ __('lang.евро/км') }}" {{ old('currency', $transport->currency) === __('lang.евро/км') ? 'selected' : '' }}>{{ __('lang.евро/км') }}</option>
                                            <option value="{{ __('lang.евро/т') }}" {{ old('currency', $transport->currency) === __('lang.евро/т') ? 'selected' : '' }}>{{ __('lang.евро/т') }}</option>
                                            <option value="{{ __('lang.руб') }}" {{ old('currency', $transport->currency) === __('lang.руб') ? 'selected' : '' }}>{{ __('lang.руб') }}</option>
                                            <option value="{{ __('lang.руб/км') }}" {{ old('currency', $transport->currency) === __('lang.руб/км') ? 'selected' : '' }}>{{ __('lang.руб/км') }}</option>
                                            <option value="{{ __('lang.руб/т') }}" {{ old('currency', $transport->currency) === __('lang.руб/т') ? 'selected' : '' }}>{{ __('lang.руб/т') }}</option>
                                        </select>
                                        @if ($errors->has('currency'))<br><p style="color:red;">{{ $errors->first('currency') }}</p>@endif
                                    </label>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.Без НДС, безнал') }}</p>
                                    <label for="without_vat_cashless">
                                        <input type="number" name="without_vat_cashless" value="{{ old('without_vat_cashless', $transport->without_vat_cashless) }}" id="without_vat_cashless">
                                        @if ($errors->has('without_vat_cashless'))<br><p style="color:red;">{{ $errors->first('without_vat_cashless') }}</p>@endif
                                    </label>
                                    <p>{{ $transport->currency }}</p>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.Наличными') }}</p>
                                    <label for="cash">
                                        <input type="number" name="cash" id="cash" value="{{ old('cash', $transport->cash) }}">
                                        @if ($errors->has('cash'))<br><p style="color:red;">{{ $errors->first('cash') }}</p>@endif
                                    </label>
                                    <p>{{ $transport->currency }}</p>
                                </div>
                            </div>

                            <div class="descriptions-ts">
                                <b>{{ __('lang.Характеристики') }}</b>
                                <span>{{ __('lang.Тип кузова') }}</span>
                                <label for="body_type">
                                    <select name="body_type" id="body_type" required>
                                        <option value="" hidden>{{ __('lang.Выберите тип кузова') }}</option>
                                        <option value="{{ __('lang.Тент') }}" {{ $transport->body_type == __('lang.Тент') ? 'selected' : '' }}>{{ __('lang.Тент') }}</option>
                                        <option value="{{ __('lang.Рефрижератор') }}" {{ $transport->body_type == __('lang.Рефрижератор') ? 'selected' : '' }}>{{ __('lang.Рефрижератор') }}</option>
                                        <option value="{{ __('lang.Открытый') }}" {{ $transport->body_type == __('lang.Открытый') ? 'selected' : '' }}>{{ __('lang.Открытый') }}</option>
                                        <option value="{{ __('lang.Контейнер') }}" {{ $transport->body_type == __('lang.Контейнер') ? 'selected' : '' }}>{{ __('lang.Контейнер') }}</option>
                                        <option value="{{ __('lang.Другое') }}" {{ $transport->body_type == __('lang.Другое') ? 'selected' : '' }}>{{ __('lang.Другое') }}</option>
                                    </select>
                                    @if ($errors->has('body_type'))<br><p style="color:red;">{{ $errors->first('body_type') }}</p>@endif
                                </label>
                            </div>

                            <div class="ts-inputs-cards" style="flex-wrap: wrap">
                                <label for="capacity">
                                    {{ __('lang.Грузоподъемность,т') }}
                                    <input type="text" id="capacity" name="capacity" required value="{{ $transport->capacity }}">
                                    @if ($errors->has('capacity'))<br><p style="color:red;">{{ $errors->first('capacity') }}</p>@endif
                                </label>
                                <label for="volume">
                                    {{ __('lang.Объем, м3') }}
                                    <input type="text" id="volume" name="volume" required value="{{ $transport->volume }}">
                                    @if ($errors->has('volume'))<br><p style="color:red;">{{ $errors->first('volume') }}</p>@endif
                                </label>
                                <label for="length">
                                    {{ __('lang.Длина,м') }}
                                    <input type="text" id="length" name="length" required value="{{ $transport->length }}">
                                    @if ($errors->has('length'))<br><p style="color:red;">{{ $errors->first('length') }}</p>@endif
                                </label>
                                <label for="width">
                                    {{ __('lang.Ширина, м') }}
                                    <input type="text" id="width" name="width" required value="{{ $transport->width }}">
                                    @if ($errors->has('width'))<br><p style="color:red;">{{ $errors->first('width') }}</p>@endif
                                </label>
                                <label for="height">
                                    {{ __('lang.Высота,м') }}
                                    <input type="text" id="height" name="height" required value="{{ $transport->height }}">
                                    @if ($errors->has('height'))<br><p style="color:red;">{{ $errors->first('height') }}</p>@endif
                                </label>
                            </div>

                            <div class="add-goods__inputs__row" style="margin-bottom: 20px;">
                                <label for="when_type">
                                    <select id="when_type" class="add-input input-select label-big" name="when_type" required>
                                        <option value="1">{{ __('lang.Готов к загрузке') }}</option>
                                        <option value="2" {{ $transport->availability_mode == 'daily' || $transport->availability_mode == 'workdays'  ? 'selected' : '' }}>{{ __('lang.Постоянно') }}</option>
                                    </select>
                                    @if ($errors->has('when_type'))<br><p style="color:red;">{{ $errors->first('when_type') }}</p>@endif
                                </label>

                                <!-- Дата и кол-во дней -->
                                <div id="ready_block" style="display: flex; gap: 10px;">
                                    <label for="ready_date" class="date-driver">
                                        <input id="ready_date" name="ready_date" type="date" class="add-input" value="{{ $transport?->ready_date?->format('Y-m-d') }}">
                                        @if ($errors->has('ready_date'))<br><p style="color:red;">{{ $errors->first('ready_date') }}</p>@endif
                                    </label>
                                </div>


                                <!-- Блок "Постоянно" -->
                                <div id="constant_block">
                                    <label>
                                        <select name="availability_mode" class="add-input input-select">
                                            <option value="" {{ old('availability_mode', $transport->availability_mode) === null ? 'selected' : '' }}>{{ __('lang.Выберите частоту') }}</option>
                                            <option value="daily" {{ old('availability_mode', $transport->availability_mode) == 'daily' ? 'selected' : '' }}>{{ __('lang.Ежедневно') }}</option>
                                            <option value="workdays" {{ old('availability_mode', $transport->availability_mode) == 'workdays' ? 'selected' : '' }}>{{ __('lang.По рабочим дням') }}</option>
                                        </select>
                                        @if ($errors->has('availability_mode'))<br><p style="color:red;">{{ $errors->first('availability_mode') }}</p>@endif
                                    </label>
                                </div>
                            </div>

                            <div class="descriptions-ts">
                                <span>Водитель</span>
                                <label for="driver_id">
                                    <select name="driver_id" id="driver_id">
                                        <option value="" hidden>{{ __('lang.Выберите водителя') }}</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $transport->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->first_name }} {{ $driver->middle_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('driver_id'))<br><p style="color:red;">{{ $errors->first('driver_id') }}</p>@endif
                                </label>
                            </div>

                            <div class="add-goods__inputs no-border">
                                <b>*{{ __('lang.Загрузка') }}</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="country">
                                            <input type="text" name="country" required id="country" class="add-input input-search" placeholder="{{ __('lang.Населенный пункт') }}" value="{{ $transport->country }}">
                                            @if ($errors->has('country'))<br><p style="color:red;">{{ $errors->first('country') }}</p>@endif
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="add-goods__inputs">
                                <b>*{{ __('lang.Возможная разгрузка') }}</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="final_country">
                                            <input type="text" name="final_country" required id="final_country" class="add-input input-search" placeholder="{{ __('lang.Населенный пункт') }}" value="{{ $transport->final_country }}">
                                            @if ($errors->has('final_country'))<br><p style="color:red;">{{ $errors->first('final_country') }}</p>@endif
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <button class="form-btn">{{ __('lang.Сохранить') }}</button>
                        </form>
                    </div>
                </div>

            </main>
        </div>

    </div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>