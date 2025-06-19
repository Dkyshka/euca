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

                <h1>{{ __('lang.Автопарк') }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">
                <div class="notifications-head">
                    <button class="form-btn" data-modal-target="add-ts">{{ __('lang.Добавить') }}</button>
                </div>

                <div class="drivers__list">
                    <div class="drivers-content">
                        <h5>Автопарк</h5>
                        @foreach($transports as $transport)
                        <div class="drivers-card ts-card">
                            <picture>
                                <source srcset="{{ asset('assets/images/driver-card.avif') }}">
                                <img src="{{ asset('assets/images/driver-card.png') }}" alt="водитель" width="90" height="90">
                            </picture>

                            <div class="ts__info">
                                <b>{{ $transport->body_type }}</b>
                                <span>{{ $transport->country }} - {{ $transport->final_country }}, {{ $transport->capacity }} т</span>
                            </div>
                            <div class="drivers-card__buttons">
                                <button>
                                    <a href="{{ route('transports.edit', [app()->getLocale(), $transport->id]) }}">{{ __('lang.Редактировать') }}</a>
                                </button>
                                <button>
                                    <a href="{{ route('transports.delete', [app()->getLocale(), $transport->id]) }}">{{ __('lang.Удалить') }}</a>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </main>
        </div>

    </div>
</main>

<div class="modal-overlay" data-modal="add-ts">
    <div class="modal modal-add-ts">
        <b>{{ __('lang.Добавить грузовик') }}</b>

        <form action="{{ route('transports.store', app()->getLocale()) }}" method="POST" id="transportForm">
            @csrf

            <div class="choise-cash">

                <input type="radio" name="payment_type" id="notr" value="no_haggling">
                <label for="notr">{{ __('lang.Есть ставка') }}</label>

                <input type="radio" name="payment_type" id="tr" value="payment_request" checked>
                <label for="tr">{{ __('lang.Запросить ставку') }}</label>
            </div>

            <div class="add-goods__bid">
                <div class="add-goods__bid-row">
                    <p>{{ __('lang.С НДС, безнал') }}</p>
                    <label for="with_vat_cashless">
                        <input type="number" name="with_vat_cashless" id="with_vat_cashless">
                    </label>
                    <label>
                        <select name="currency" id="currency" class="input-select">
                            <option value="{{ __('lang.узб.сум') }}" {{ old('currency') === __('lang.узб.сум') ? 'selected' : '' }}>{{ __('lang.узб.сум') }}</option>
                            <option value="{{ __('lang.узб.сум/км') }}" {{ old('currency') === __('lang.узб.сум/км') ? 'selected' : '' }}>{{ __('lang.узб.сум/км') }}</option>
                            <option value="{{ __('lang.узб.сум/т') }}" {{ old('currency') === __('lang.узб.сум/т') ? 'selected' : '' }}>{{ __('lang.узб.сум/т') }}</option>
                            <option value="{{ __('lang.доллар') }}" {{ old('currency') === __('lang.доллар') ? 'selected' : '' }}>{{ __('lang.доллар') }}</option>
                            <option value="{{ __('lang.доллар/км') }}" {{ old('currency') === __('lang.доллар/км') ? 'selected' : '' }}>{{ __('lang.доллар/км') }}</option>
                            <option value="{{ __('lang.доллар/т') }}" {{ old('currency') === __('lang.доллар/т') ? 'selected' : '' }}>{{ __('lang.доллар/т') }}</option>
                            <option value="{{ __('lang.евро') }}" {{ old('currency') === __('lang.евро') ? 'selected' : '' }}>{{ __('lang.евро') }}</option>
                            <option value="{{ __('lang.евро/км') }}" {{ old('currency') === __('lang.евро/км') ? 'selected' : '' }}>{{ __('lang.евро/км') }}</option>
                            <option value="{{ __('lang.евро/т') }}" {{ old('currency') === __('lang.евро/т') ? 'selected' : '' }}>{{ __('lang.евро/т') }}</option>
                            <option value="{{ __('lang.руб') }}" {{ old('currency') === __('lang.руб') ? 'selected' : '' }}>{{ __('lang.руб') }}</option>
                            <option value="{{ __('lang.руб/км') }}" {{ old('currency') === __('lang.руб/км') ? 'selected' : '' }}>{{ __('lang.руб/км') }}</option>
                            <option value="{{ __('lang.руб/т') }}" {{ old('currency') === __('lang.руб/т') ? 'selected' : '' }}>{{ __('lang.руб/т') }}</option>
                        </select>
                    </label>
                </div>
                <div class="add-goods__bid-row">
                    <p>{{ __('lang.Без НДС, безнал') }}</p>
                    <label for="without_vat_cashless">
                        <input type="number" name="without_vat_cashless" value="{{ old('without_vat_cashless') }}" id="without_vat_cashless">
                    </label>
                    <p>{{ __('lang.узб.сум') }}</p>
                </div>
                <div class="add-goods__bid-row">
                    <p>{{ __('lang.Наличными') }}</p>
                    <label for="cash">
                        <input type="number" name="cash" id="cash" value="{{ old('cash') }}">
                    </label>
                    <p>{{ __('lang.узб.сум') }}</p>
                </div>
            </div>

            <div class="descriptions-ts">
                <b>{{ __('lang.Характеристики') }}</b>
                <span>{{ __('lang.Тип кузова') }}</span>
                <label for="body_type">
                    <select name="body_type" id="body_type" required>
                        <option value="" hidden>{{ __('lang.Выберите тип кузова') }}</option>
                        <option value="Тент">{{ __('lang.Тент') }}</option>
                        <option value="Рефрижератор">{{ __('lang.Рефрижератор') }}</option>
                        <option value="Открытый">{{ __('lang.Открытый') }}</option>
                        <option value="Контейнер">{{ __('lang.Контейнер') }}</option>
                        <option value="Другое">{{ __('lang.Другое') }}</option>
                    </select>
                </label>
            </div>

            <div class="ts-inputs-cards" style="flex-wrap: wrap">
                <label for="capacity">
                    {{ __('lang.Грузоподъемность,т') }}
                    <input type="number" id="capacity" name="capacity" required>
                </label>
                <label for="volume">
                    {{ __('lang.Объем, м3') }}
                    <input type="number" id="volume" name="volume" required>
                </label>
                <label for="length">
                    {{ __('lang.Длина,м') }}
                    <input type="number" id="length" name="length" required>
                </label>
                <label for="width">
                    {{ __('lang.Ширина') }}
                    <input type="number" id="width" name="width" required>
                </label>
                <label for="height">
                    {{ __('lang.Высота,м') }}
                    <input type="number" id="height" name="height" required>
                </label>
            </div>

            <div class="add-goods__inputs__row" style="margin-bottom: 20px;">
                <label for="when_type">
                    <select id="when_type" class="add-input input-select label-big" name="when_type" required>
                        <option value="1">{{ __('lang.Готов к загрузке') }}</option>
                        <option value="2">{{ __('lang.Постоянно') }}</option>
                    </select>
                </label>

                <!-- Дата и кол-во дней -->
                <div id="ready_block" style="display: flex; gap: 10px;">
                    <label for="ready_date" class="date-driver">
                        <input id="ready_date" name="ready_date" type="date" class="add-input">
                    </label>

{{--                    <label for="archive_after_days" style="display: none">--}}
{{--                        <select name="archive_after_days" id="archive_after_days" class="add-input input-small input-select">--}}
{{--                            <option value="0" {{ old('archive_after_days') == 0 ? 'selected' : '' }}>0 дн.</option>--}}
{{--                            <option value="1" {{ old('archive_after_days') == 1 ? 'selected' : '' }}>1 дн.</option>--}}
{{--                            <option value="2" {{ old('archive_after_days') == 2 ? 'selected' : '' }}>2 дн.</option>--}}
{{--                            <option value="3" {{ old('archive_after_days') == 3 ? 'selected' : '' }}>3 дн.</option>--}}
{{--                            <option value="4" {{ old('archive_after_days') == 4 ? 'selected' : '' }}>4 дн.</option>--}}
{{--                            <option value="5" {{ old('archive_after_days') == 5 ? 'selected' : '' }}>5 дн.</option>--}}
{{--                        </select>--}}
{{--                    </label>--}}
                </div>

                <!-- Блок "Постоянно" -->
                <div id="constant_block">
                    <label>
                        <select name="availability_mode" class="add-input input-select">
                            <option value="" {{ old('availability_mode') === null ? 'selected' : '' }}>{{ __('lang.Выберите частоту') }}</option>
                            <option value="daily" {{ old('availability_mode') === 'daily' ? 'selected' : '' }}>{{ __('lang.Ежедневно') }}</option>
                            <option value="workdays" {{ old('availability_mode') === 'workdays' ? 'selected' : '' }}>{{ __('lang.По рабочим дням') }}</option>
                        </select>
                    </label>
                </div>
            </div>

            <div class="descriptions-ts">
                <span>{{ __('lang.Водитель') }}</span>
                <label for="driver_id">
                    <select name="driver_id" id="driver_id">
                        <option value="" hidden>{{ __('lang.Выберите водителя') }}</option>
                        @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->first_name }} {{ $driver->middle_name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="add-goods__inputs no-border">
                <b>*{{ __('lang.Загрузка') }}</b>
                <div>
                    <div class="add-goods__inputs__row">
                        <label for="country">
                            <input type="text" name="country" required id="country" class="add-input input-search" placeholder="{{ __('lang.Населенный пункт') }}">
                        </label>
                    </div>
                </div>
            </div>

            <div class="add-goods__inputs">
                <b>*{{ __('lang.Возможная разгрузка') }}</b>
                <div>
                    <div class="add-goods__inputs__row">
                        <label for="final_country">
                            <input type="text" name="final_country" required id="final_country" class="add-input input-search" placeholder="{{ __('lang.Населенный пункт') }}">
                        </label>
                    </div>

                </div>

            </div>

            <button class="form-btn">{{ __('lang.Добавить') }}</button>
        </form>

        <button class="modal-close" type="button" data-modal-close="add-ts">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>