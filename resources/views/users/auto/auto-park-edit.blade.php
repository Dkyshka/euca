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

                <h1>Ваши грузы</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">


                <div class="drivers__list">
                    <div class="drivers-content">
                        <h5>Автопарк</h5>
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
                                <label for="notr">Есть ставка</label>

                                <input type="radio" name="payment_type" id="tr" value="payment_request" {{ $transport->payment_type == 'payment_request' ? 'checked' : '' }}>
                                <label for="tr">Запросить ставку</label>
                            </div>

                            <div class="add-goods__bid">
                                <div class="add-goods__bid-row">
                                    <p>С НДС, безнал</p>
                                    <label for="with_vat_cashless">
                                        <input type="number" name="with_vat_cashless" id="with_vat_cashless" value="{{ $transport?->with_vat_cashless ?? '' }}">
                                        @if ($errors->has('with_vat_cashless'))<br><p style="color:red;">{{ $errors->first('with_vat_cashless') }}</p>@endif
                                    </label>
                                    <label>
                                        <select name="currency" id="currency" class="input-select">
                                            <option value="узб.сум" {{ old('currency', $transport->currency) === 'узб.сум' ? 'selected' : '' }}>узб.сум</option>
                                            <option value="узб.сум/км" {{ old('currency', $transport->currency) === 'узб.сум/км' ? 'selected' : '' }}>узб.сум/км</option>
                                            <option value="узб.сум/т" {{ old('currency', $transport->currency) === 'узб.сум/т' ? 'selected' : '' }}>узб.сум/т</option>
                                            <option value="доллар" {{ old('currency', $transport->currency) === 'доллар' ? 'selected' : '' }}>доллар</option>
                                            <option value="доллар/км" {{ old('currency', $transport->currency) === 'доллар/км' ? 'selected' : '' }}>доллар/км</option>
                                            <option value="доллар/т" {{ old('currency', $transport->currency) === 'доллар/т' ? 'selected' : '' }}>доллар/т</option>
                                            <option value="евро" {{ old('currency', $transport->currency) === 'евро' ? 'selected' : '' }}>евро</option>
                                            <option value="евро/км" {{ old('currency', $transport->currency) === 'евро/км' ? 'selected' : '' }}>евро/км</option>
                                            <option value="евро/т" {{ old('currency', $transport->currency) === 'евро/т' ? 'selected' : '' }}>евро/т</option>
                                            <option value="руб" {{ old('currency', $transport->currency) === 'руб' ? 'selected' : '' }}>руб</option>
                                            <option value="руб/км" {{ old('currency', $transport->currency) === 'руб/км' ? 'selected' : '' }}>руб/км</option>
                                            <option value="руб/т" {{ old('currency', $transport->currency) === 'руб/т' ? 'selected' : '' }}>руб/т</option>
                                        </select>
                                        @if ($errors->has('currency'))<br><p style="color:red;">{{ $errors->first('currency') }}</p>@endif
                                    </label>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>Без НДС, безнал</p>
                                    <label for="without_vat_cashless">
                                        <input type="number" name="without_vat_cashless" value="{{ old('without_vat_cashless', $transport->without_vat_cashless) }}" id="without_vat_cashless">
                                        @if ($errors->has('without_vat_cashless'))<br><p style="color:red;">{{ $errors->first('without_vat_cashless') }}</p>@endif
                                    </label>
                                    <p>{{ $transport->currency }}</p>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>Наличными</p>
                                    <label for="cash">
                                        <input type="number" name="cash" id="cash" value="{{ old('cash', $transport->cash) }}">
                                        @if ($errors->has('cash'))<br><p style="color:red;">{{ $errors->first('cash') }}</p>@endif
                                    </label>
                                    <p>{{ $transport->currency }}</p>
                                </div>
                            </div>

                            <div class="descriptions-ts">
                                <b>Характеристики</b>
                                <span>Тип кузова</span>
                                <label for="body_type">
                                    <select name="body_type" id="body_type" required>
                                        <option value="" hidden>Выберите тип кузова</option>
                                        <option value="Тент" {{ $transport->body_type == 'Тент' ? 'selected' : '' }}>Тент</option>
                                        <option value="Рефрижератор" {{ $transport->body_type == 'Рефрижератор' ? 'selected' : '' }}>Рефрижератор</option>
                                        <option value="Открытый" {{ $transport->body_type == 'Открытый' ? 'selected' : '' }}>Открытый</option>
                                        <option value="Контейнер" {{ $transport->body_type == 'Контейнер' ? 'selected' : '' }}>Контейнер</option>
                                        <option value="Другое" {{ $transport->body_type == 'Другое' ? 'selected' : '' }}>Другое</option>
                                    </select>
                                    @if ($errors->has('body_type'))<br><p style="color:red;">{{ $errors->first('body_type') }}</p>@endif
                                </label>
                            </div>

                            <div class="ts-inputs-cards" style="flex-wrap: wrap">
                                <label for="capacity">
                                    Грузоподъемность,т
                                    <input type="number" id="capacity" name="capacity" required value="{{ $transport->capacity }}">
                                    @if ($errors->has('capacity'))<br><p style="color:red;">{{ $errors->first('capacity') }}</p>@endif
                                </label>
                                <label for="volume">
                                    Объем, м3
                                    <input type="number" id="volume" name="volume" required value="{{ $transport->volume }}">
                                    @if ($errors->has('volume'))<br><p style="color:red;">{{ $errors->first('volume') }}</p>@endif
                                </label>
                                <label for="length">
                                    Длина,м
                                    <input type="number" id="length" name="length" required value="{{ $transport->length }}">
                                    @if ($errors->has('length'))<br><p style="color:red;">{{ $errors->first('length') }}</p>@endif
                                </label>
                                <label for="width">
                                    Ширина, м
                                    <input type="number" id="width" name="width" required value="{{ $transport->width }}">
                                    @if ($errors->has('width'))<br><p style="color:red;">{{ $errors->first('width') }}</p>@endif
                                </label>
                                <label for="height">
                                    Высота,м
                                    <input type="number" id="height" name="height" required value="{{ $transport->height }}">
                                    @if ($errors->has('height'))<br><p style="color:red;">{{ $errors->first('height') }}</p>@endif
                                </label>
                            </div>

                            <div class="add-goods__inputs__row" style="margin-bottom: 20px;">
                                <label for="when_type">
                                    <select id="when_type" class="add-input input-select label-big" name="when_type" required>
                                        <option value="1">Готов к загрузке</option>
                                        <option value="2" {{ $transport->availability_mode == 'daily' || $transport->availability_mode == 'workdays'  ? 'selected' : '' }}>Постоянно</option>
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
                                            <option value="" {{ old('availability_mode', $transport->availability_mode) === null ? 'selected' : '' }}>Выберите частоту</option>
                                            <option value="daily" {{ old('availability_mode', $transport->availability_mode) == 'daily' ? 'selected' : '' }}>Ежедневно</option>
                                            <option value="workdays" {{ old('availability_mode', $transport->availability_mode) == 'workdays' ? 'selected' : '' }}>По рабочим дням</option>
                                        </select>
                                        @if ($errors->has('availability_mode'))<br><p style="color:red;">{{ $errors->first('availability_mode') }}</p>@endif
                                    </label>
                                </div>
                            </div>

                            <div class="descriptions-ts">
                                <span>Водитель</span>
                                <label for="driver_id">
                                    <select name="driver_id" id="driver_id">
                                        <option value="" hidden>Выберите водителя</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $transport->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->first_name }} {{ $driver->middle_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('driver_id'))<br><p style="color:red;">{{ $errors->first('driver_id') }}</p>@endif
                                </label>
                            </div>

                            <div class="add-goods__inputs no-border">
                                <b>*Загрузка</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="country">
                                            <input type="text" name="country" required id="country" class="add-input input-search" placeholder="Населенный пункт" value="{{ $transport->country }}">
                                            @if ($errors->has('country'))<br><p style="color:red;">{{ $errors->first('country') }}</p>@endif
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="add-goods__inputs">
                                <b>*Возможная разгрузка</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="final_country">
                                            <input type="text" name="final_country" required id="final_country" class="add-input input-search" placeholder="Населенный пункт" value="{{ $transport->final_country }}">
                                            @if ($errors->has('final_country'))<br><p style="color:red;">{{ $errors->first('final_country') }}</p>@endif
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <button class="form-btn">Сохранить</button>
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