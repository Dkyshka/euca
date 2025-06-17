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

                <h1>{{ $page->name }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="add-goods" action="{{ route('cargos.store', app()->getLocale()) }}" method="POST">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ auth()->user()?->company?->id }}">
                    <div class="add-goods__head">
                        <b>{{ __('lang.Добавить груз') }}</b>
                        <div class="add-goods__buttons">
{{--                            <button type="button">Заполнить из шаблона</button>--}}
{{--                            <button type="reset">Очистить форму</button>--}}
                        </div>
                    </div>

                    <div class="add-goods__main">
                        <div class="add-gods__left">
                            <div class="add-goods__inputs">
                                <b>*{{ __('lang.Груз') }}</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="cargo-name">
                                            <input type="text" name="title" value="{{ old('title') }}" id="cargo-name" class="add-input input-search" list="cargo-types" required placeholder="{{ __('lang.Выберите или введите своё') }}">
                                            @if ($errors->has('title'))<br><p style="color:red;">{{ $errors->first('title') }}</p>@endif
                                            <datalist id="cargo-types">
                                                @foreach($cargoTypes as $type)
                                                <option value="{{ $type->name }}">
                                                @endforeach
                                            </datalist>
                                        </label>
                                        <label for="weight">
                                            <input class="add-input input-small" value="{{ old('weight') }}" type="text" id="weight" name="weight" placeholder="{{ __('lang.вес') }}" required>
                                            @if ($errors->has('weight'))<br><p style="color:red;">{{ $errors->first('weight') }}</p>@endif
                                        </label>
                                        <label for="weight_type">
                                            <select name="weight_type" id="weight_type" class="add-input input-small input-select" required>
                                                <option value="t" {{ old('weight_type', 't') === 't' ? 'selected' : '' }}>{{ __('lang.т') }}</option>
                                                <option value="kg" {{ old('weight_type') === 'kg' ? 'selected' : '' }}>{{ __('lang.кг') }}</option>
                                            </select>
                                            @if ($errors->has('weight_type'))
                                                <br><p style="color:red;">{{ $errors->first('weight_type') }}</p>
                                            @endif
                                        </label>
                                        <label for="volume" class="label-value">
                                            <input class="add-input input-small input-value" name="volume" value="{{ old('volume') }}" type="text" id="volume" placeholder="{{ __('lang.Объем') }}" required>
                                            @if ($errors->has('volume'))<br><p style="color:red;">{{ $errors->first('volume') }}</p>@endif
                                            <span>М<sup>3</sup></span>
                                        </label>
                                    </div>

                                    <div class="add-goods__inputs__row" id="packages_container"
                                         style="display: {{ (old('package_id') || old('quantity') || $errors->has('package_id') || $errors->has('quantity')) ? 'flex' : 'none' }};">

                                        <label for="package_id"
                                               style="display: {{ (old('package_id') || $errors->has('package_id')) ? 'block' : 'none' }};">
                                            <select name="package_id" id="package_id" class="add-input input-small input-select">
                                                @foreach($packages as $package)
                                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                                        {{ $package->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('package_id'))<br><p style="color:red;">{{ $errors->first('package_id') }}</p>@endif
                                        </label>

                                        <label for="quantity" class="label-value"
                                               style="display: {{ (old('quantity') || $errors->has('quantity')) ? 'block' : 'none' }};">
                                            <input class="add-input input-small input-value"
                                                   name="quantity"
                                                   type="text"
                                                   id="quantity"
                                                   value="{{ old('quantity') }}">
                                            @if ($errors->has('quantity'))<br><p style="color:red;">{{ $errors->first('quantity') }}</p>@endif
                                            <span>шт.</span>
                                        </label>
                                    </div>

                                    <div class="add-goods__inputs__row" id="dimensions_container"
                                         style="display: {{ (old('length') || old('width') || old('height') || $errors->has('length')
                                            || $errors->has('width')
                                            || $errors->has('height')) ? 'flex' : 'none' }};">

                                        <label for="length" class="label-value"
                                               style="display: {{ (old('length') || $errors->has('length')) ? 'block' : 'none' }};">
                                            <label>{{ __('lang.Д') }}</label>
                                            <input class="add-input input-small input-value" name="length" value="{{ old('length') }}" type="text" id="length">
                                            @if ($errors->has('length'))<br><p style="color:red;">{{ $errors->first('length') }}</p>@endif
                                            <span>м.</span>
                                        </label>

                                        <label for="width" class="label-value"
                                               style="display: {{ (old('width') || $errors->has('width')) ? 'block' : 'none' }};">
                                            <label>{{ __('lang.Ш') }}</label>
                                            <input class="add-input input-small input-value" name="width" value="{{ old('width') }}" type="text" id="width">
                                            @if ($errors->has('width'))<br><p style="color:red;">{{ $errors->first('width') }}</p>@endif
                                            <span>м.</span>
                                        </label>

                                        <label for="height_d" class="label-value"
                                               style="display: {{ (old('height') || $errors->has('height')) ? 'block' : 'none' }};">
                                            <label>{{ __('lang.В') }}</label>
                                            <input class="add-input input-small input-value" name="height" value="{{ old('height') }}" type="text" id="height_d">
                                            @if ($errors->has('height'))<br><p style="color:red;">{{ $errors->first('height') }}</p>@endif
                                            <span>м.</span>
                                        </label>

                                        <label for="diameter" class="label-value"
                                               style="display: {{ (old('diameter') || $errors->has('diameter')) ? 'block' : 'none' }};">
                                            <label>{{ __('lang.Диаметр') }}</label>
                                            <input class="add-input input-small input-value" name="diameter" value="{{ old('diameter') }}" type="text" id="diameter">
                                            @if ($errors->has('diameter'))<br><p style="color:red;">{{ $errors->first('diameter') }}</p>@endif
                                            <span>м.</span>
                                        </label>
                                    </div>

                                    <div class="drivers-tags">
                                        <button id="add_package">
                                            <svg width="12" height="12">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                            {{ __('lang.Упаковка') }}
                                        </button>
                                        <button id="add_dimensions">
                                            <svg width="12" height="12">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                            {{ __('lang.Габариты и диаметр') }}
                                        </button>
{{--                                        <button>--}}
{{--                                            <svg width="12" height="12">--}}
{{--                                                <use xlink:href="#plus"></use>--}}
{{--                                            </svg>--}}
{{--                                            Еще груз--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="add-goods__inputs">
                                <b>*{{ __('lang.Когда') }}</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="when_type">
                                            <select id="when_type" class="add-input input-select label-big" name="when_type" required>
                                                <option value="1" {{ old('when_type') == 1 ? 'selected' : '' }}>{{ __('lang.Готов к загрузке') }}</option>
                                                <option value="2" {{ old('when_type') == 2 ? 'selected' : '' }}>{{ __('lang.Постоянно') }}</option>
                                                <option value="3" {{ old('when_type') == 3 ? 'selected' : '' }}>{{ __('lang.Груза нет, запрос ставки') }}</option>
                                            </select>
                                            @if ($errors->has('when_type'))<br><p style="color:red;">{{ $errors->first('when_type') }}</p>@endif
                                        </label>

                                        <!-- Дата и кол-во дней -->
                                        <div id="ready_block" style="display: flex; gap: 10px;">
                                            <label for="date" class="add-input input-date">
                                                <span id="date-label-text">{{ old('ready_date') ? old('ready_date') : __('lang.выберите дату') }}</span>
                                                <input type="date" id="date" name="ready_date" value="{{ old('ready_date') }}">
                                                @if ($errors->has('ready_date'))<br><p style="color:red;">{{ $errors->first('ready_date') }}</p>@endif
                                            </label>

                                            <label for="archive_after_days">
                                                <select name="archive_after_days" id="archive_after_days" class="add-input input-small input-select">
                                                    <option value="0" {{ old('archive_after_days') == 0 ? 'selected' : '' }}>0 {{ __('lang.дн.') }}</option>
                                                    <option value="1" {{ old('archive_after_days') == 1 ? 'selected' : '' }}>1 {{ __('lang.дн.') }}</option>
                                                    <option value="2" {{ old('archive_after_days') == 2 ? 'selected' : '' }}>2 {{ __('lang.дн.') }}</option>
                                                    <option value="3" {{ old('archive_after_days') == 3 ? 'selected' : '' }}>3 {{ __('lang.дн.') }}</option>
                                                    <option value="4" {{ old('archive_after_days') == 4 ? 'selected' : '' }}>4 {{ __('lang.дн.') }}</option>
                                                    <option value="5" {{ old('archive_after_days') == 5 ? 'selected' : '' }}>5 {{ __('lang.дн.') }}</option>
                                                </select>
                                            </label>
                                        </div>

                                        <!-- Блок "Постоянно" -->
                                        <div id="constant_block"
                                             style="display: {{ (old('constant_frequency') || $errors->has('constant_frequency')) ? 'block' : 'none' }};">
                                            <label>
                                                <select name="constant_frequency" class="add-input input-select">
                                                    <option value="" {{ old('constant_frequency') === null ? 'selected' : '' }}>{{ __('lang.Выберите частоту') }}</option>
                                                    <option value="daily" {{ old('constant_frequency') === 'daily' ? 'selected' : '' }}>{{ __('lang.Ежедневно') }}</option>
                                                    <option value="workdays" {{ old('constant_frequency') === 'workdays' ? 'selected' : '' }}>{{ __('lang.По рабочим дням') }}</option>
                                                </select>
                                                @if ($errors->has('constant_frequency'))<br><p style="color:red;">{{ $errors->first('constant_frequency') }}</p>@endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-goods__wrapper">
                                <div class="add-gods-ponts"></div>
                                <div class="add-goods__inputs no-border">
                                    <b>*{{ __('lang.Загрузка') }}</b>
                                    <div>
                                        <div class="add-goods__inputs__row">
                                            <label for="place">
                                                <input type="text" name="country" required id="place" value="{{ old('country') }}" class="add-input input-search" placeholder="{{ __('lang.Введите адрес') }}">
                                                @if ($errors->has('country'))<br><p style="color:red;">{{ $errors->first('country') }}</p>@endif
                                            </label>
{{--                                            <label for="address">--}}
{{--                                                <input class="add-input input-big" type="text" id="address" value="{{ old('address') }}" name="address" required placeholder="Адрес в населенном пункте">--}}
{{--                                                @if ($errors->has('address'))<br><p style="color:red;">{{ $errors->first('address') }}</p>@endif--}}
{{--                                            </label>--}}
                                            <svg width="16" height="18">
                                                <use xlink:href="#map"></use>
                                            </svg>
                                        </div>

                                        <div class="add-goods__inputs__row" id="upload_time_container"
                                             style="display: {{ (old('time_at') || old('time_to') || $errors->has('time_at') || $errors->has('time_to')) ? 'flex' : 'none' }};">

                                            <label for="time_at" class="label-value"
                                                   style="display: {{ (old('time_at') || old('time_to') || $errors->has('time_at') || $errors->has('time_to')) ? 'block' : 'none' }};">
                                                <input class="add-input input-small input-value" name="time_at" value="{{ old('time_at') }}" type="time" id="time_at">
                                                @if ($errors->has('time_at'))<br><p style="color:red;">{{ $errors->first('time_at') }}</p>@endif
                                                <input class="add-input input-small input-value" name="time_to" value="{{ old('time_to') }}" type="time" id="time_to">
                                                @if ($errors->has('time_to'))<br><p style="color:red;">{{ $errors->first('time_to') }}</p>@endif
                                            </label>

                                            <label for="is_24h" class="label-value"
                                                   style="display: {{ (old('is_24h') || $errors->has('is_24h')) ? 'block' : 'none' }};">
                                                <input type="hidden" name="is_24h" value="0">
                                                <input class="add-input input-small input-value" name="is_24h" type="checkbox" id="is_24h" value="1" style="min-width: 25px;" {{ old('is_24h') ? 'checked' : '' }}>
                                                {{ __('lang.круглосуточно') }}
                                                @if ($errors->has('is_24h'))<br><p style="color:red;">{{ $errors->first('is_24h') }}</p>@endif
                                            </label>

                                        </div>

                                        <div class="drivers-tags">
                                            <button id="add_time">
                                                <svg width="12" height="12">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                                {{ __('lang.Время загрузки') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="row-text">--}}
{{--                                    <b>Добавить точку маршрута:</b>--}}
{{--                                    <button type="button">+ Загрузка</button>--}}
{{--                                    <button type="button">+ Разгрузка</button>--}}
{{--                                    <button type="button">+ Ехать через</button>--}}
{{--                                    <button type="button">+ Таможня</button>--}}
{{--                                </div>--}}

                                <div class="add-goods__inputs">
                                    <b>*{{ __('lang.Разгрузка') }}</b>
                                    <div>
                                        <div class="add-goods__inputs__row">
                                            <label for="final_unload_country">
                                                <input type="text" name="final_unload_city" required id="final_unload_city" value="{{ old('final_unload_city') }}" class="add-input input-search" placeholder="{{ __('lang.Введите адрес') }}">
                                                @if ($errors->has('final_unload_city'))<br><p style="color:red;">{{ $errors->first('final_unload_city') }}</p>@endif
                                            </label>
{{--                                            <label for="final_unload_address">--}}
{{--                                                <input class="add-input input-big" required type="text" id="final_unload_address" name="final_unload_address" value="{{ old('final_unload_address') }}" placeholder="Адрес в населенном пункте">--}}
{{--                                                @if ($errors->has('final_unload_address'))<br><p style="color:red;">{{ $errors->first('final_unload_address') }}</p>@endif--}}
{{--                                            </label>--}}
                                            <svg width="16" height="18">
                                                <use xlink:href="#map"></use>
                                            </svg>
                                        </div>

                                        <div class="add-goods__inputs__row" id="upload_final_container"
                                             style="display: {{ (old('final_unload_date_from')
                                                || old('final_unload_date_to')
                                                || old('final_unload_datetime_from')
                                                || old('final_unload_datetime_to')
                                                || old('final_is_24h')
                                                || $errors->has('final_unload_date_from')
                                                || $errors->has('final_unload_date_to')
                                                || $errors->has('final_unload_datetime_from')
                                                || $errors->has('final_unload_datetime_to')
                                                || $errors->has('final_is_24h')) ? 'flex' : 'none' }};">

                                            <label for="final_unload_date_from"
                                                   style="display: {{ (old('final_unload_date_from') || $errors->has('final_unload_date_from')) ? 'block' : 'none' }};">
                                                <input type="date" id="final_unload_date_from" name="final_unload_date_from" value="{{ old('final_unload_date_from') }}">
                                                @if ($errors->has('final_unload_date_from'))<br><p style="color:red;">{{ $errors->first('final_unload_date_from') }}</p>@endif
                                            </label>

                                            <label for="final_unload_date_to"
                                                   style="display: {{ (old('final_unload_date_to') || $errors->has('final_unload_date_to')) ? 'block' : 'none' }};">
                                                <input type="date" id="final_unload_date_to" name="final_unload_date_to" value="{{ old('final_unload_date_to') }}">
                                                @if ($errors->has('final_unload_date_to'))<br><p style="color:red;">{{ $errors->first('final_unload_date_to') }}</p>@endif
                                            </label>

                                            <label for="final_unload_datetime_from" class="label-value"
                                                   style="display: {{ (old('final_unload_datetime_from') || old('final_unload_datetime_to') || $errors->has('final_unload_datetime_from') || $errors->has('final_unload_datetime_to')) ? 'block' : 'none' }};">
                                                <input class="add-input input-small input-value" name="final_unload_datetime_from" type="time" value="{{ old('final_unload_datetime_from') }}" id="final_unload_datetime_from">
                                                @if ($errors->has('final_unload_datetime_from'))<br><p style="color:red;">{{ $errors->first('final_unload_datetime_from') }}</p>@endif

                                                <input class="add-input input-small input-value" name="final_unload_datetime_to" value="{{ old('final_unload_datetime_to') }}" type="time" id="final_unload_datetime_to">
                                                @if ($errors->has('final_unload_datetime_to'))<br><p style="color:red;">{{ $errors->first('final_unload_datetime_to') }}</p>@endif
                                            </label>

                                            <label for="final_is_24h" class="label-value"
                                                   style="display: {{ (old('final_is_24h') || $errors->has('final_is_24h')) ? 'block' : 'none' }};">
                                                <input type="hidden" name="final_is_24h" value="0">
                                                <input class="add-input input-small input-value" name="final_is_24h" value="1" type="checkbox" id="final_is_24h" style="min-width: 25px;" {{ old('final_is_24h') ? 'checked' : '' }}>
                                                {{ __('lang.круглосуточно') }}
                                                @if ($errors->has('final_is_24h'))<br><p style="color:red;">{{ $errors->first('final_is_24h') }}</p>@endif
                                            </label>

                                        </div>

                                        <div class="drivers-tags">
                                            <button id="add_final">
                                                <svg width="12" height="12">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                                {{ __('lang.Дата и время') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-inputs-cards">
                                <div class="add-inputs-card">
                                    <b>*{{ __('lang.Кузов') }}</b>
                                    <div class="add-inputs-card__wrapp">
                                        <div class="add-inputs-card_block border">
                                            <label for="all" class="add-input-general">
                                                <input type="checkbox" name="body_types[]" id="all" value="все закр.+изотерм"
                                                        {{ in_array('все закр.+изотерм', old('body_types', [])) ? 'checked' : '' }}>
                                                все закр.+изотерм
                                            </label>
                                            <label for="tnt">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="tnt" value="тентованный"
                                                        {{ in_array('тентованный', old('body_types', [])) ? 'checked' : '' }}>
                                                тентованный
                                            </label>
                                            <label for="cn">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="cn" value="контейнер"
                                                        {{ in_array('контейнер', old('body_types', [])) ? 'checked' : '' }}>
                                                контейнер
                                            </label>
                                            <label for="fr">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="fr" value="фургон"
                                                        {{ in_array('фургон', old('body_types', [])) ? 'checked' : '' }}>
                                                фургон
                                            </label>
                                            <label for="mt">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="mt" value="цельнометалл"
                                                        {{ in_array('цельнометалл', old('body_types', [])) ? 'checked' : '' }}>
                                                цельнометалл.
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block">
                                            <label for="изотермический">
                                                <input type="checkbox" name="body_types[]" id="изотермический" value="изотермический"
                                                        {{ in_array('изотермический', old('body_types', [])) ? 'checked' : '' }}>
                                                изотермический
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block border">
                                            <label for="refz" class="add-input-general">
                                                <input type="checkbox" name="body_types[]" id="refz" value="реф.+изотерм"
                                                        {{ in_array('реф.+изотерм', old('body_types', [])) ? 'checked' : '' }}>
                                                реф.+изотерм
                                            </label>
                                            <label for="refrijetor">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="refrijetor" value="рефрижератор"
                                                        {{ in_array('рефрижератор', old('body_types', [])) ? 'checked' : '' }}>
                                                рефрижератор
                                            </label>
                                            <label for="ref-s-peregorodkoy">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="ref-s-peregorodkoy" value="реф. с перегородкой"
                                                        {{ in_array('реф. с перегородкой', old('body_types', [])) ? 'checked' : '' }}>
                                                реф. с перегородкой
                                            </label>
                                            <label for="ref-multi">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="ref-multi" value="реф. мультирежимный"
                                                        {{ in_array('реф. мультирежимный', old('body_types', [])) ? 'checked' : '' }}>
                                                реф. мультирежимный
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block">
                                            <label for="реф.-тушевоз">
                                                <input type="checkbox" name="body_types[]" id="реф.-тушевоз" value="реф.-тушевоз"
                                                        {{ in_array('реф.-тушевоз', old('body_types', [])) ? 'checked' : '' }}>
                                                реф.-тушевоз
                                            </label>
                                        </div>

                                        <!-- -- -->
                                        <div class="add-inputs-card_block border">
                                            <label for="open_all" class="add-input-general">
                                                <input type="checkbox" name="body_types[]" id="open_all" value="все открытые"
                                                        {{ in_array('все открытые', old('body_types', [])) ? 'checked' : '' }}>
                                                все открытые
                                            </label>
                                            <label for="bord">
                                                <input type="checkbox" name="body_types[]" id="bord" value="бортовой"
                                                        {{ in_array('бортовой', old('body_types', [])) ? 'checked' : '' }}>
                                                бортовой
                                            </label>
                                            <label for="open_cont">
                                                <input type="checkbox" name="body_types[]" id="open_cont" value="открытый конт."
                                                        {{ in_array('открытый конт.', old('body_types', [])) ? 'checked' : '' }}>
                                                открытый конт.
                                            </label>
                                            <label for="sam">
                                                <input type="checkbox" name="body_types[]" id="sam" value="самосвал"
                                                        {{ in_array('самосвал', old('body_types', [])) ? 'checked' : '' }}>
                                                самосвал
                                            </label>
                                            <label for="shal">
                                                <input type="checkbox" name="body_types[]" id="shal" value="шаланда"
                                                        {{ in_array('шаланда', old('body_types', [])) ? 'checked' : '' }}>
                                                шаланда
                                            </label>
                                            <label for="plat">
                                                <input type="checkbox" name="body_types[]" id="plat" value="площадка без бортов"
                                                        {{ in_array('площадка без бортов', old('body_types', [])) ? 'checked' : '' }}>
                                                площадка без бортов
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block">
                                            <label for="bus">
                                                <input type="checkbox" name="body_types[]" id="bus" value="автобус"
                                                        {{ in_array('автобус', old('body_types', [])) ? 'checked' : '' }}>
                                                автобус
                                            </label>
                                            <label for="avto">
                                                <input type="checkbox" name="body_types[]" id="avto" value="автовоз"
                                                        {{ in_array('автовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                автовоз
                                            </label>
                                            <label for="avto_vishka">
                                                <input type="checkbox" name="body_types[]" id="avto_vishka" value="автовышка"
                                                        {{ in_array('автовышка', old('body_types', [])) ? 'checked' : '' }}>
                                                автовышка
                                            </label>
                                            <label for="avtotrans">
                                                <input type="checkbox" name="body_types[]" id="avtotrans" value="автотранспортер"
                                                        {{ in_array('автотранспортер', old('body_types', [])) ? 'checked' : '' }}>
                                                автотранспортер
                                            </label>
                                            <label for="beton">
                                                <input type="checkbox" name="body_types[]" id="beton" value="бетоновоз"
                                                        {{ in_array('бетоновоз', old('body_types', [])) ? 'checked' : '' }}>
                                                бетоновоз
                                            </label>
                                            <label for="bitum">
                                                <input type="checkbox" name="body_types[]" id="bitum" value="битумовоз"
                                                        {{ in_array('битумовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                битумовоз
                                            </label>
                                            <label for="benz">
                                                <input type="checkbox" name="body_types[]" id="benz" value="бензовоз"
                                                        {{ in_array('бензовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                бензовоз
                                            </label>
                                            <label for="vezdehod">
                                                <input type="checkbox" name="body_types[]" id="vezdehod" value="вездеход"
                                                        {{ in_array('вездеход', old('body_types', [])) ? 'checked' : '' }}>
                                                вездеход
                                            </label>
                                            <label for="gaz">
                                                <input type="checkbox" name="body_types[]" id="gaz" value="газовоз"
                                                        {{ in_array('газовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                газовоз
                                            </label>
                                            <label for="zerno">
                                                <input type="checkbox" name="body_types[]" id="zerno" value="зерновоз"
                                                        {{ in_array('зерновоз', old('body_types', [])) ? 'checked' : '' }}>
                                                зерновоз
                                            </label>
                                            <label for="konevoz">
                                                <input type="checkbox" name="body_types[]" id="konevoz" value="коневоз"
                                                        {{ in_array('коневоз', old('body_types', [])) ? 'checked' : '' }}>
                                                коневоз
                                            </label>
                                            <label for="konteynerovoz">
                                                <input type="checkbox" name="body_types[]" id="konteynerovoz" value="контейнеровоз"
                                                        {{ in_array('контейнеровоз', old('body_types', [])) ? 'checked' : '' }}>
                                                контейнеровоз
                                            </label>
                                            <label for="kormovoz">
                                                <input type="checkbox" name="body_types[]" id="kormovoz" value="кормовоз"
                                                        {{ in_array('кормовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                кормовоз
                                            </label>
                                            <label for="kran">
                                                <input type="checkbox" name="body_types[]" id="kran" value="кран"
                                                        {{ in_array('кран', old('body_types', [])) ? 'checked' : '' }}>
                                                кран
                                            </label>
                                            <label for="lesovoz">
                                                <input type="checkbox" name="body_types[]" id="lesovoz" value="лесовоз"
                                                        {{ in_array('лесовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                лесовоз
                                            </label>
                                            <label for="lomovoz">
                                                <input type="checkbox" name="body_types[]" id="lomovoz" value="ломовоз"
                                                        {{ in_array('ломовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                ломовоз
                                            </label>
                                            <label for="manip">
                                                <input type="checkbox" name="body_types[]" id="manip" value="манипулятор"
                                                        {{ in_array('манипулятор', old('body_types', [])) ? 'checked' : '' }}>
                                                манипулятор
                                            </label>
                                            <label for="micro">
                                                <input type="checkbox" name="body_types[]" id="micro" value="микроавтобус"
                                                        {{ in_array('микроавтобус', old('body_types', [])) ? 'checked' : '' }}>
                                                микроавтобус
                                            </label>
                                            <label for="mukovoz">
                                                <input type="checkbox" name="body_types[]" id="mukovoz" value="муковоз"
                                                        {{ in_array('муковоз', old('body_types', [])) ? 'checked' : '' }}>
                                                муковоз
                                            </label>
                                            <label for="panel">
                                                <input type="checkbox" name="body_types[]" id="panel" value="панелевоз"
                                                        {{ in_array('панелевоз', old('body_types', [])) ? 'checked' : '' }}>
                                                панелевоз
                                            </label>
                                            <label for="pickup">
                                                <input type="checkbox" name="body_types[]" id="pickup" value="пикап"
                                                        {{ in_array('пикап', old('body_types', [])) ? 'checked' : '' }}>
                                                пикап
                                            </label>
                                            <label for="puhtovoz">
                                                <input type="checkbox" name="body_types[]" id="puhtovoz" value="пухтовоз"
                                                        {{ in_array('пухтовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                пухтовоз
                                            </label>
                                            <label for="pir">
                                                <input type="checkbox" name="body_types[]" id="pir" value="пирамида"
                                                        {{ in_array('пирамида', old('body_types', [])) ? 'checked' : '' }}>
                                                пирамида
                                            </label>
                                            <label for="rulon">
                                                <input type="checkbox" name="body_types[]" id="rulon" value="рулоновоз"
                                                        {{ in_array('рулоновоз', old('body_types', [])) ? 'checked' : '' }}>
                                                рулоновоз
                                            </label>
                                            <label for="tyagach">
                                                <input type="checkbox" name="body_types[]" id="tyagach" value="седельный тягач"
                                                        {{ in_array('седельный тягач', old('body_types', [])) ? 'checked' : '' }}>
                                                седельный тягач
                                            </label>
                                            <label for="skotovoz">
                                                <input type="checkbox" name="body_types[]" id="skotovoz" value="скотовоз"
                                                        {{ in_array('скотовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                скотовоз
                                            </label>
                                            <label for="steklovoz">
                                                <input type="checkbox" name="body_types[]" id="steklovoz" value="стекловоз"
                                                        {{ in_array('стекловоз', old('body_types', [])) ? 'checked' : '' }}>
                                                стекловоз
                                            </label>
                                            <label for="trubovoz">
                                                <input type="checkbox" name="body_types[]" id="trubovoz" value="трубовоз"
                                                        {{ in_array('трубовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                трубовоз
                                            </label>
                                            <label for="cement">
                                                <input type="checkbox" name="body_types[]" id="cement" value="цементовоз"
                                                        {{ in_array('цементовоз', old('body_types', [])) ? 'checked' : '' }}>
                                                цементовоз
                                            </label>
                                            <label for="cistern">
                                                <input type="checkbox" name="body_types[]" id="cistern" value="автоцистерна"
                                                        {{ in_array('автоцистерна', old('body_types', [])) ? 'checked' : '' }}>
                                                автоцистерна
                                            </label>
                                            <label for="schepa">
                                                <input type="checkbox" name="body_types[]" id="schepa" value="щеповоз"
                                                        {{ in_array('щеповоз', old('body_types', [])) ? 'checked' : '' }}>
                                                щеповоз
                                            </label>
                                            <label for="evakuator">
                                                <input type="checkbox" name="body_types[]" id="evakuator" value="эвакуатор"
                                                        {{ in_array('эвакуатор', old('body_types', [])) ? 'checked' : '' }}>
                                                эвакуатор
                                            </label>
                                            <label for="gruzpas">
                                                <input type="checkbox" name="body_types[]" id="gruzpas" value="грузопассажирский"
                                                        {{ in_array('грузопассажирский', old('body_types', [])) ? 'checked' : '' }}>
                                                грузопассажирский
                                            </label>
                                            <label for="klyushka">
                                                <input type="checkbox" name="body_types[]" id="klyushka" value="клюшковоз"
                                                        {{ in_array('клюшковоз', old('body_types', [])) ? 'checked' : '' }}>
                                                клюшковоз
                                            </label>
                                            <label for="musor">
                                                <input type="checkbox" name="body_types[]" id="musor" value="мусоровоз"
                                                        {{ in_array('мусоровоз', old('body_types', [])) ? 'checked' : '' }}>
                                                мусоровоз
                                            </label>
                                            <label for="jumbo">
                                                <input type="checkbox" name="body_types[]" id="jumbo" value="jumbo"
                                                        {{ in_array('jumbo', old('body_types', [])) ? 'checked' : '' }}>
                                                jumbo
                                            </label>
                                            <label for="tank20">
                                                <input type="checkbox" name="body_types[]" id="tank20" value="20' танк-контейнер"
                                                        {{ in_array("20' танк-контейнер", old('body_types', [])) ? 'checked' : '' }}>
                                                20' танк-контейнер
                                            </label>
                                            <label for="tank40">
                                                <input type="checkbox" name="body_types[]" id="tank40" value="40' танк-контейнер"
                                                        {{ in_array("40' танк-контейнер", old('body_types', [])) ? 'checked' : '' }}>
                                                40' танк-контейнер
                                            </label>
                                            <label for="mega">
                                                <input type="checkbox" name="body_types[]" id="mega" value="мега фура"
                                                        {{ in_array('мега фура', old('body_types', [])) ? 'checked' : '' }}>
                                                мега фура
                                            </label>
                                            <label for="doppelstock">
                                                <input type="checkbox" name="body_types[]" id="doppelstock" value="допельшток"
                                                        {{ in_array('допельшток', old('body_types', [])) ? 'checked' : '' }}>
                                                допельшток
                                            </label>
                                            <label for="razdvizh">
                                                <input type="checkbox" name="body_types[]" id="razdvizh" value="Раздвижной полуприцеп 20'/40'"
                                                        {{ in_array("Раздвижной полуприцеп 20'/40'", old('body_types', [])) ? 'checked' : '' }}>
                                                Раздвижной полуприцеп 20'/40'
                                            </label>
                                        </div>

                                    </div>
                                    @if ($errors->has('body_types'))<br><p style="color:red;">{{ $errors->first('body_types') }}</p>@endif
                                </div>

                                <div class="add-inputs-card">
                                    <b>*{{ __('lang.Загрузка') }}</b>
                                    <div class="add-inputs-card__wrapp">
                                        <div class="add-inputs-card_block">
                                            <label for="1">
                                                <input type="checkbox" name="loading_types[]" id="1" value="верхняя"
                                                        {{ in_array('верхняя', old('loading_types', [])) ? 'checked' : '' }}>
                                                верхняя
                                            </label>
                                            <label for="2">
                                                <input type="checkbox" name="loading_types[]" id="2" value="боковая"
                                                        {{ in_array('боковая', old('loading_types', [])) ? 'checked' : '' }}>
                                                боковая
                                            </label>
                                            <label for="3">
                                                <input type="checkbox" name="loading_types[]" id="3" value="задняя"
                                                        {{ in_array('задняя', old('loading_types', [])) ? 'checked' : '' }}>
                                                задняя
                                            </label>
                                            <label for="4">
                                                <input type="checkbox" name="loading_types[]" id="4" value="с полной растентовкой"
                                                        {{ in_array('с полной растентовкой', old('loading_types', [])) ? 'checked' : '' }}>
                                                с полной растентовкой
                                            </label>
                                            <label for="5">
                                                <input type="checkbox" name="loading_types[]" id="5" value="со снятием поперечных перекладин"
                                                        {{ in_array('со снятием поперечных перекладин', old('loading_types', [])) ? 'checked' : '' }}>
                                                со снятием поперечных перекладин
                                            </label>

                                            {{--______--}}

                                            <label for="55">
                                                <input type="checkbox" name="loading_types[]" id="55" value="со снятием стоек"
                                                        {{ in_array('со снятием стоек', old('loading_types', [])) ? 'checked' : '' }}>
                                                со снятием стоек
                                            </label>

                                            <label for="66">
                                                <input type="checkbox" name="loading_types[]" id="66" value="без ворот"
                                                        {{ in_array('без ворот', old('loading_types', [])) ? 'checked' : '' }}>
                                                без ворот
                                            </label>
                                            <label for="77">
                                                <input type="checkbox" name="loading_types[]" id="77" value="гидроборт"
                                                        {{ in_array('гидроборт', old('loading_types', [])) ? 'checked' : '' }}>
                                                гидроборт
                                            </label>
                                            <label for="88">
                                                <input type="checkbox" name="loading_types[]" id="88" value="аппарели"
                                                        {{ in_array('аппарели', old('loading_types', [])) ? 'checked' : '' }}>
                                                аппарели
                                            </label>
                                            <label for="99">
                                                <input type="checkbox" name="loading_types[]" id="99" value="с обрешеткой"
                                                        {{ in_array('с обрешеткой', old('loading_types', [])) ? 'checked' : '' }}>
                                                с обрешеткой
                                            </label>
                                            <label for="1010">
                                                <input type="checkbox" name="loading_types[]" id="1010" value="с бортами"
                                                        {{ in_array('с бортами', old('loading_types', [])) ? 'checked' : '' }}>
                                                с бортами
                                            </label>
                                            <label for="1011">
                                                <input type="checkbox" name="loading_types[]" id="1011" value="боковая с 2-х сторон"
                                                        {{ in_array('боковая с 2-х сторон', old('loading_types', [])) ? 'checked' : '' }}>
                                                боковая с 2-х сторон
                                            </label>
                                            <label for="1012">
                                                <input type="checkbox" name="loading_types[]" id="1012" value="налив"
                                                        {{ in_array('налив', old('loading_types', [])) ? 'checked' : '' }}>
                                                налив
                                            </label>
                                            <label for="1013">
                                                <input type="checkbox" name="loading_types[]" id="1013" value="электрический"
                                                        {{ in_array('электрический', old('loading_types', [])) ? 'checked' : '' }}>
                                                электрический
                                            </label>
                                            <label for="1014">
                                                <input type="checkbox" name="loading_types[]" id="1014" value="гидравлический"
                                                        {{ in_array('гидравлический', old('loading_types', [])) ? 'checked' : '' }}>
                                                гидравлический
                                            </label>
                                            <label for="1015">
                                                <input type="checkbox" name="loading_types[]" id="1015" value="пневматический"
                                                        {{ in_array('пневматический', old('loading_types', [])) ? 'checked' : '' }}>
                                                пневматический
                                            </label>
                                            <label for="1016">
                                                <input type="checkbox" name="loading_types[]" id="1016" value="дизельный компрессор"
                                                        {{ in_array('дизельный компрессор', old('loading_types', [])) ? 'checked' : '' }}>
                                                дизельный компрессор
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="add-inputs-card">
                                    <b>*{{ __('lang.Выгрузка') }}</b>
                                    <div class="add-inputs-card__wrapp">
                                        <div class="add-inputs-card_block">
                                            <label for="111">
                                                <input type="checkbox" name="unloading_types[]" id="111" value="верхняя"
                                                        {{ in_array('верхняя', old('unloading_types', [])) ? 'checked' : '' }}>
                                                верхняя
                                            </label>
                                            <label for="222">
                                                <input type="checkbox" name="unloading_types[]" id="222" value="боковая"
                                                        {{ in_array('боковая', old('unloading_types', [])) ? 'checked' : '' }}>
                                                боковая
                                            </label>
                                            <label for="333">
                                                <input type="checkbox" name="unloading_types[]" id="333" value="задняя"
                                                        {{ in_array('задняя', old('unloading_types', [])) ? 'checked' : '' }}>
                                                задняя
                                            </label>
                                            <label for="444">
                                                <input type="checkbox" name="unloading_types[]" id="444" value="с полной растентовкой"
                                                        {{ in_array('с полной растентовкой', old('unloading_types', [])) ? 'checked' : '' }}>
                                                с полной растентовкой
                                            </label>
                                            <label for="555">
                                                <input type="checkbox" name="unloading_types[]" id="555" value="со снятием поперечных перекладин"
                                                        {{ in_array('со снятием поперечных перекладин', old('unloading_types', [])) ? 'checked' : '' }}>
                                                со снятием поперечных перекладин
                                            </label>

                                            {{--______--}}

                                            <label for="666">
                                                <input type="checkbox" name="unloading_types[]" id="666" value="со снятием стоек"
                                                        {{ in_array('со снятием стоек', old('unloading_types', [])) ? 'checked' : '' }}>
                                                со снятием стоек
                                            </label>

                                            <label for="777">
                                                <input type="checkbox" name="unloading_types[]" id="777" value="без ворот"
                                                        {{ in_array('без ворот', old('unloading_types', [])) ? 'checked' : '' }}>
                                                без ворот
                                            </label>
                                            <label for="888">
                                                <input type="checkbox" name="unloading_types[]" id="888" value="гидроборт"
                                                        {{ in_array('гидроборт', old('unloading_types', [])) ? 'checked' : '' }}>
                                                гидроборт
                                            </label>
                                            <label for="999">
                                                <input type="checkbox" name="unloading_types[]" id="999" value="аппарели"
                                                        {{ in_array('аппарели', old('unloading_types', [])) ? 'checked' : '' }}>
                                                аппарели
                                            </label>
                                            <label for="101010">
                                                <input type="checkbox" name="unloading_types[]" id="101010" value="с обрешеткой"
                                                        {{ in_array('с обрешеткой', old('unloading_types', [])) ? 'checked' : '' }}>
                                                с обрешеткой
                                            </label>
                                            <label for="111111">
                                                <input type="checkbox" name="unloading_types[]" id="111111" value="с бортами"
                                                        {{ in_array('с бортами', old('unloading_types', [])) ? 'checked' : '' }}>
                                                с бортами
                                            </label>
                                            <label for="121212">
                                                <input type="checkbox" name="unloading_types[]" id="121212" value="боковая с 2-х сторон"
                                                        {{ in_array('боковая с 2-х сторон', old('unloading_types', [])) ? 'checked' : '' }}>
                                                боковая с 2-х сторон
                                            </label>
                                            <label for="131313">
                                                <input type="checkbox" name="unloading_types[]" id="131313" value="налив"
                                                        {{ in_array('налив', old('unloading_types', [])) ? 'checked' : '' }}>
                                                налив
                                            </label>
                                            <label for="141414">
                                                <input type="checkbox" name="unloading_types[]" id="141414" value="электрический"
                                                        {{ in_array('электрический', old('unloading_types', [])) ? 'checked' : '' }}>
                                                электрический
                                            </label>
                                            <label for="151515">
                                                <input type="checkbox" name="unloading_types[]" id="151515" value="гидравлический"
                                                        {{ in_array('гидравлический', old('unloading_types', [])) ? 'checked' : '' }}>
                                                гидравлический
                                            </label>
                                            <label for="161616">
                                                <input type="checkbox" name="unloading_types[]" id="161616" value="пневматический"
                                                        {{ in_array('пневматический', old('unloading_types', [])) ? 'checked' : '' }}>
                                                пневматический
                                            </label>
                                            <label for="171717">
                                                <input type="checkbox" name="unloading_types[]" id="171717" value="дизельный компрессор"
                                                        {{ in_array('дизельный компрессор', old('unloading_types', [])) ? 'checked' : '' }}>
                                                дизельный компрессор
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="add-goods-choise choise-cash">
                                <input type="radio" name="payment_type" id="tr" value="negotiable"
                                        {{ old('payment_type') === 'negotiable' ? 'checked' : '' }}>
                                <label for="tr">{{ __('lang.Возможен торг') }}</label>

                                <input type="radio" name="payment_type" id="notr" value="no_haggling"
                                        {{ old('payment_type', 'no_haggling') === 'no_haggling' ? 'checked' : '' }}>
                                <label for="notr">{{ __('lang.Без торга') }}</label>

                                <input type="radio" name="payment_type" id="net" value="payment_request"
                                        {{ old('payment_type') === 'payment_request' ? 'checked' : '' }}>
                                <label for="net">{{ __('lang.Запрос') }}</label>
{{--                                <input type="radio" name="payment" id="rtr">--}}
{{--                                <label for="rtr">Торги</label>--}}
                            </div>
                            @if ($errors->has('payment_type'))<br><p style="color:red;">{{ $errors->first('payment_type') }}</p>@endif
                            <br>
                            <div class="add-goods__bid">
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.С НДС, безнал') }}</p>
                                    <label for="with_vat_cashless">
                                        <input type="number" name="with_vat_cashless" id="with_vat_cashless" value="{{ old('with_vat_cashless') }}">
                                        @if ($errors->has('with_vat_cashless'))<br><p style="color:red;">{{ $errors->first('with_vat_cashless') }}</p>@endif
                                    </label>
                                    <label>
                                        <select name="currency" id="currency" class="input-select">
                                            <option value="узб.сум" {{ old('currency') === 'узб.сум' ? 'selected' : '' }}>узб.сум</option>
                                            <option value="узб.сум/км" {{ old('currency') === 'узб.сум/км' ? 'selected' : '' }}>узб.сум/км</option>
                                            <option value="узб.сум/т" {{ old('currency') === 'узб.сум/т' ? 'selected' : '' }}>узб.сум/т</option>
                                            <option value="доллар" {{ old('currency') === 'доллар' ? 'selected' : '' }}>доллар</option>
                                            <option value="доллар/км" {{ old('currency') === 'доллар/км' ? 'selected' : '' }}>доллар/км</option>
                                            <option value="доллар/т" {{ old('currency') === 'доллар/т' ? 'selected' : '' }}>доллар/т</option>
                                            <option value="евро" {{ old('currency') === 'евро' ? 'selected' : '' }}>евро</option>
                                            <option value="евро/км" {{ old('currency') === 'евро/км' ? 'selected' : '' }}>евро/км</option>
                                            <option value="евро/т" {{ old('currency') === 'евро/т' ? 'selected' : '' }}>евро/т</option>
                                            <option value="руб" {{ old('currency') === 'руб' ? 'selected' : '' }}>руб</option>
                                            <option value="руб/км" {{ old('currency') === 'руб/км' ? 'selected' : '' }}>руб/км</option>
                                            <option value="руб/т" {{ old('currency') === 'руб/т' ? 'selected' : '' }}>руб/т</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.Без НДС, безнал') }}</p>
                                    <label for="without_vat_cashless">
                                        <input type="number" name="without_vat_cashless" value="{{ old('without_vat_cashless') }}" id="without_vat_cashless">
                                        @if ($errors->has('without_vat_cashless'))<br><p style="color:red;">{{ $errors->first('without_vat_cashless') }}</p>@endif
                                    </label>
                                    <p>{{ __('lang.узб.сум') }}</p>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.Наличными') }}</p>
                                    <label for="cash">
                                        <input type="number" name="cash" id="cash" value="{{ old('cash') }}">
                                        @if ($errors->has('cash'))<br><p style="color:red;">{{ $errors->first('cash') }}</p>@endif
                                    </label>
                                    <p>{{ __('lang.узб.сум') }}</p>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>{{ __('lang.Встречные предложения') }}</p>
                                    <div class="add-goods__bid-inputs">
                                        <label for="on_cart">
                                            <input type="hidden" name="on_cart" value="0">
                                            <input type="checkbox" id="on_cart" name="on_cart" value="1"
                                                    {{ old('on_cart') ? 'checked' : '' }}>
                                            {{ __('lang.на карту') }}
                                            @if ($errors->has('on_cart'))<br><p style="color:red;">{{ $errors->first('on_cart') }}</p>@endif
                                        </label>

                                        <label for="counter_offers">
                                            <input type="hidden" name="counter_offers" value="0">
                                            <input type="checkbox" id="counter_offers" name="counter_offers" value="1"
                                                    {{ old('counter_offers') ? 'checked' : '' }}>
                                            {{ __('lang.видны только вам') }}
                                            @if ($errors->has('counter_offers'))<br><p style="color:red;">{{ $errors->first('counter_offers') }}</p>@endif
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="add-goods-more__row">
                                <p>{{ __('lang.Оплата через') }}</p>

                                <div class="add-goods-more__payment">
                                    <label>
                                        <input type="number" name="payment_via" value="{{ old('payment_via') }}">
                                        @if ($errors->has('payment_via'))<br><p style="color:red;">{{ $errors->first('payment_via') }}</p>@endif
                                    </label>
                                    <p>{{ __('lang.банковских дней') }}</p>
                                </div>
                            </div>

{{--                            <div class="add-goods-more__row">--}}
{{--                                <p>Добавить</p>--}}

{{--                                <div class="drivers-tags">--}}
{{--                                    <button>--}}
{{--                                        <svg width="12" height="12">--}}
{{--                                            <use xlink:href="#plus"></use>--}}
{{--                                        </svg>--}}
{{--                                        Предоплата деньгами или топливом--}}
{{--                                    </button>--}}
{{--                                    <button>--}}
{{--                                        <svg width="12" height="12">--}}
{{--                                            <use xlink:href="#plus"></use>--}}
{{--                                        </svg>--}}
{{--                                        Оплата на выгрузке--}}
{{--                                    </button>--}}
{{--                                    <button>--}}
{{--                                        <svg width="12" height="12">--}}
{{--                                            <use xlink:href="#plus"></use>--}}
{{--                                        </svg>--}}
{{--                                        Прямой договор--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="add-goods__contacts">--}}
{{--                                <div class="add-goods-more__row">--}}
{{--                                    <p>Контакты</p>--}}

{{--                                    <div class="add-goods__contact">--}}
{{--                                        <p>Укажите к кому обратиться по обьвлению</p>--}}
{{--                                        <div class="add-goods__contact-inputs">--}}
{{--                                            <label for="fullname">--}}
{{--                                                <input type="text" class="fullname" id="fullname" placeholder="Filipov Filip Filiopovich">--}}
{{--                                            </label>--}}
{{--                                            <label for="usertel">--}}
{{--                                                <input type="tel" id="usertel" placeholder="+9989(909)037045">--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <button class="add-goods__cansel">--}}
{{--                                            <span></span>--}}
{{--                                            <span></span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="add-goods-more__row">--}}
{{--                                    <p>Примечание</p>--}}
{{--                                    <label for="textinfo" class="add-goods__textinfo">--}}
{{--                                        <textarea name="" id="textinfo"> </textarea>--}}
{{--                                        <span>Не указыайте контакты( телефона, скайп и пр) иначе ваш груз удалит--}}
{{--									модератор</span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}

{{--                                <div class="add-goods-more__row">--}}
{{--                                    <p>Добавить</p>--}}

{{--                                    <div class="drivers-tags">--}}
{{--                                        <button>--}}
{{--                                            <svg width="12" height="12">--}}
{{--                                                <use xlink:href="#plus"></use>--}}
{{--                                            </svg>--}}
{{--                                            № груза или заказа--}}
{{--                                        </button>--}}
{{--                                        <button>--}}
{{--                                            <svg width="12" height="12">--}}
{{--                                                <use xlink:href="#plus"></use>--}}
{{--                                            </svg>--}}
{{--                                            фото--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

    {{--                            <div class="add-goods__bottom-radios">--}}
    {{--                                <input type="radio" name="top" id="top">--}}
    {{--                                <label for="top">Поднять груз в ТОП поиска (Приоритетный заказ)</label>--}}

    {{--                                <input type="radio" name="top" id="hidden">--}}
    {{--                                <label for="hidden">Скрыть груз от нежелательных фирм(Стелс)</label>--}}

    {{--                                <input type="radio" name="top" id="agree">--}}
    {{--                                <label for="agree">Разрешить перевозчикам бронировать груз</label>--}}
    {{--                            </div>--}}

{{--                            <div class="add-goods__bottom">--}}
{{--                                <svg width="15" height="15">--}}
{{--                                    <use xlink:href="#time"></use>--}}
{{--                                </svg>--}}
{{--                                <p>Опубликовать груз</p>--}}
{{--                                <select class="input-select">--}}
{{--                                    <option value="" hidden>сразу</option>--}}
{{--                                    <option value="">через час</option>--}}
{{--                                    <option value="">через день</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>

                        <div class="add-goods__right">
                            <div class="side-bar__goods">
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

                                <div class="side-bar__goods-info">
                                    <b>{{ __('lang.Груз') }}</b>
                                    <p>{{ __('lang.не заполнено') }}</p>
                                </div>
                            </div>
                            <div class="side-bar__goods">
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

                                <div class="side-bar__goods when-summary">
                                    <div class="side-bar__goods-info">
                                        <b>{{ __('lang.Когда') }}</b>
                                        <p>{{ __('lang.не заполнено') }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="side-bar__goods">
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

                                <div class="side-bar__goods route-summary">
                                    <div class="side-bar__goods-info">
                                        <b>{{ __('lang.Маршрут') }}</b>
                                        <p>{{ __('lang.не заполнено') }}</p>
                                    </div>
                                </div>

                            </div>
{{--                            <div class="side-bar__goods">--}}
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

{{--                                <div class="side-bar__goods-info">--}}
{{--                                    <b>Транспорт</b>--}}
{{--                                    <p>--}}
{{--                                        <strong>отд. машиной <br>1 машина</strong>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="side-bar__goods">
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

                                <div class="side-bar__goods payment-summary">
                                    <div class="side-bar__goods-info">
                                        <b>{{ __('lang.Оплата') }}</b>
                                        <p>{{ __('lang.не заполнено') }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="side-bar__goods active">
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

                                <div class="side-bar__goods-info">
                                    <b>{{ __('lang.Дополнительно') }}</b>
                                    <p>
                                        <strong>
                                            {{ auth()->user()?->name }},<br>
                                            {{ auth()->user()?->phone }}
                                        </strong>
                                    </p>
                                </div>
                            </div>

                            <div class="side-bar__goods active">
{{--                                <span>--}}
{{--                                    <svg width="10" height="7">--}}
{{--                                        <use xlink:href="#add-goods"></use>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}

                                <div class="side-bar__goods-info">
                                    <b>{{ __('lang.Площадки') }}</b>
                                    <p><strong>{{ __('lang.Биржа EUCA ALLIANCE') }}</strong></p>
                                </div>
                            </div>

                            <button class="add-goods__btn">{{ __('lang.Опубликовать груз') }}</button>
{{--                            <button class="add-goods__link">Сохранить как шаблон</button>--}}
                        </div>
                    </div>

                    <div class="add-goods__head add-goods__footer">
                        <div class="add-goods__buttons">
{{--                            <button type="button">Заполнить из шаблона</button>--}}
{{--                            <button type="reset">Очистить форму</button>--}}
                        </div>
                    </div>

                    <!-- Загрузка -->
                    <input type="hidden" id="place_lat" name="place_lat" value="{{ old('place_lat') }}">
                    <input type="hidden" id="place_lng" name="place_lng" value="{{ old('place_lng') }}">

                    <!-- Разгрузка -->
                    <input type="hidden" id="final_unload_city_lat" name="final_unload_city_lat" value="{{ old('final_unload_city_lat') }}">
                    <input type="hidden" id="final_unload_city_lng" name="final_unload_city_lng" value="{{ old('final_unload_city_lng') }}">

                </form>
            </main>

            <script>
                document.querySelector(".input-date").addEventListener("click", function () {
                    this.querySelector("input").showPicker();
                });
            </script>
        </div>

    </div>
</main>
<script src="https://api-maps.yandex.ru/2.1/?apikey=49817d12-35af-402e-82b9-91b83b18ac74&suggest_apikey=7ed47521-ec68-4122-8f01-7f47b9e7672f
&lang={{ app()->getLocale() }}"></script>
<script src="{{ asset('assets/js/main.min.js') }}"></script>

<script>
    ymaps.ready(function () {
        // Подсказки для городов (населенных пунктов)
        const suggestLoadCity = new ymaps.SuggestView('place');
        const suggestUnloadCity = new ymaps.SuggestView('final_unload_city');

        // Функция геокодирования с объединением города + адрес
        function geocodeFullAddress(cityId, addressId, latId, lngId) {
            const city = document.getElementById(cityId).value.trim();
            // const address = document.getElementById(addressId).value.trim();
            if (!city) return;
            // if (!city && !address) return;

            // Формируем полный адрес для геокодирования
            // const fullAddress = city + (address ? ', ' + address : '');
            const fullAddress = city;

            ymaps.geocode(fullAddress).then(function (res) {
                const firstGeoObject = res.geoObjects.get(0);
                if (!firstGeoObject) {
                    console.warn('Адрес не найден:', fullAddress);
                    return;
                }
                const coords = firstGeoObject.geometry.getCoordinates();
                document.getElementById(latId).value = coords[1]; // широта
                document.getElementById(lngId).value = coords[0]; // долгота
            }).catch(function (err) {
                console.error('Ошибка геокодирования:', err);
            });
        }

        // Обработчики потери фокуса: геокодируем при уходе с адреса или города
        ['place'].forEach(id => {
            document.getElementById(id)?.addEventListener('blur', function () {
                geocodeFullAddress('place', 'place_lat', 'place_lng');
            });
        });

        ['final_unload_city'].forEach(id => {
            document.getElementById(id)?.addEventListener('blur', function () {
                geocodeFullAddress('final_unload_city', 'final_unload_city_lat', 'final_unload_city_lng');
            });
        });
    });

</script>

</body>
</html>