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
                    <div class="validation-errors" style="background: #fdd; padding: 10px; border: 1px solid red; margin-bottom: 20px; font-size: 14px;">
                        <ul style="margin: 0; padding-left: 20px; color: #b30000;">
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
                        <b>Добавить груз</b>
                        <div class="add-goods__buttons">
{{--                            <button type="button">Заполнить из шаблона</button>--}}
{{--                            <button type="reset">Очистить форму</button>--}}
                        </div>
                    </div>

                    <div class="add-goods__main">
                        <div class="add-gods__left">
                            <div class="add-goods__inputs">
                                <b>*Груз</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="cargo-name">
                                            <input type="text" name="title" id="cargo-name" class="add-input input-search" list="cargo-types" placeholder="Выберите или введите своё">
                                            <datalist id="cargo-types">
                                                @foreach($cargoTypes as $type)
                                                <option value="{{ $type->name }}">
                                                @endforeach
                                            </datalist>
                                        </label>
                                        <label for="weight">
                                            <input class="add-input input-small" type="number" id="weight" name="weight" placeholder="вес">
                                        </label>
                                        <label for="weight_type">
                                            <select name="weight_type" id="weight_type" class="add-input input-small input-select">
                                                <option value="t" selected>т</option>
                                                <option value="kg">кг</option>
                                            </select>
                                        </label>
                                        <label for="volume" class="label-value">
                                            <input class="add-input input-small input-value" name="volume" type="number" id="volume" placeholder="Объем">
                                            <span>М<sup>3</sup></span>
                                        </label>
                                    </div>

                                    <div class="add-goods__inputs__row" id="packages_container" style="display: none;">
                                        <label for="package_id" style="display: none;">
                                            <select name="package_id" id="package_id" class="add-input input-small input-select">
                                                @foreach($packages as $package)
                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>

                                        <label for="quantity" class="label-value" style="display: none">
                                            <input class="add-input input-small input-value" name="quantity" type="number" id="quantity">
                                            <span>шт.</span>
                                        </label>
                                    </div>

                                    <div class="add-goods__inputs__row" id="dimensions_container" style="display: none;">

                                        <label for="length" class="label-value" style="display: none">
                                            <label>Д</label>
                                            <input class="add-input input-small input-value" name="length" type="number" id="length">
                                            <span>м.</span>
                                        </label>

                                        <label for="width" class="label-value" style="display: none">
                                            <label>Ш</label>
                                            <input class="add-input input-small input-value" name="width" type="number" id="width">
                                            <span>м.</span>
                                        </label>

                                        <label for="height_d" class="label-value" style="display: none">
                                            <label>В</label>
                                            <input class="add-input input-small input-value" name="height" type="number" id="height_d">
                                            <span>м.</span>
                                        </label>

                                        <label for="diameter" class="label-value" style="display: none">
                                            <label>Диаметр</label>
                                            <input class="add-input input-small input-value" name="diameter" type="number" id="diameter">
                                            <span>м.</span>
                                        </label>
                                    </div>

                                    <div class="drivers-tags">
                                        <button id="add_package">
                                            <svg width="12" height="12">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                            Упаковка
                                        </button>
                                        <button id="add_dimensions">
                                            <svg width="12" height="12">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                            Габариты и диаметр
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
                                <b>*Когда</b>
                                <div>
                                    <div class="add-goods__inputs__row">
                                        <label for="when_type">
                                            <select id="when_type" class="add-input input-select label-big" name="when_type" required>
                                                <option value="1">Готов к загрузке</option>
                                                <option value="2">Постоянно</option>
                                                <option value="3">Груза нет, запрос ставки</option>
                                            </select>
                                        </label>

                                        <!-- Дата и кол-во дней -->
                                        <div id="ready_block" style="display: flex; gap: 10px;">
                                            <label for="date" class="add-input input-date">
                                                <span id="date-label-text">выберите дату</span>
                                                <input type="date" id="date" name="ready_date">
                                            </label>

                                            <label for="archive_after_days">
                                                <select name="archive_after_days" id="archive_after_days" class="add-input input-small input-select">
                                                    <option value="0">0 дн.</option>
                                                    <option value="1">1 дн.</option>
                                                    <option value="3">3 дн.</option>
                                                    <option value="4">4 дн.</option>
                                                    <option value="5">5 дн.</option>
                                                </select>
                                            </label>
                                        </div>

                                        <!-- Блок "Постоянно" -->
                                        <div id="constant_block" style="display: none;">
                                            <label>
                                                <select name="constant_frequency" class="add-input input-select">
                                                    <option value="daily">Ежедневно</option>
                                                    <option value="workdays">По рабочим дням</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-goods__wrapper">
                                <div class="add-gods-ponts"></div>
                                <div class="add-goods__inputs no-border">
                                    <b>*Загрузка</b>
                                    <div>
                                        <div class="add-goods__inputs__row">
                                            <label for="place">
                                                <input type="text" name="country" id="place" class="add-input input-search" placeholder="Населенный пункт">
                                            </label>
                                            <label for="address">
                                                <input class="add-input input-big" type="text" id="address" name="address" placeholder="Адрес в населенном пункте">
                                            </label>
                                            <svg width="16" height="18">
                                                <use xlink:href="#map"></use>
                                            </svg>
                                        </div>

                                        <div class="add-goods__inputs__row" id="upload_time_container" style="display: none;">

                                            <label for="time_at" class="label-value" style="display: none">
                                                <input class="add-input input-small input-value" name="time_at" type="time" id="time_at">
                                                <input class="add-input input-small input-value" name="time_to" type="time" id="time_to">
                                            </label>

                                            <label for="is_24h" class="label-value" style="display: none">
                                                <input type="hidden" name="is_24h" value="0">
                                                <input class="add-input input-small input-value" name="is_24h" type="checkbox" id="is_24h" value="1" style="min-width: 25px;">
                                                круглосуточно
                                            </label>

                                        </div>

                                        <div class="drivers-tags">
                                            <button id="add_time">
                                                <svg width="12" height="12">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                                Время загрузки
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
                                    <b>*Разгрузка</b>
                                    <div>
                                        <div class="add-goods__inputs__row">
                                            <label for="final_unload_country">
                                                <input type="text" name="final_unload_country" id="final_unload_country" class="add-input input-search" placeholder="Населенный пункт">
                                            </label>
                                            <label for="final_unload_address">
                                                <input class="add-input input-big" type="text" id="final_unload_address" name="final_unload_address" placeholder="Адрес в населенном пункте">
                                            </label>
                                            <svg width="16" height="18">
                                                <use xlink:href="#map"></use>
                                            </svg>
                                        </div>

                                        <div class="add-goods__inputs__row" id="upload_final_container" style="display: none;">

                                            <label for="final_unload_date_from" style="display: none">
                                                <input type="date" id="final_unload_date_from" name="final_unload_date_from">
                                            </label>

                                            <label for="final_unload_date_to" style="display: none">
                                                <input type="date" id="final_unload_date_to" name="final_unload_date_to">
                                            </label>

                                            <label for="final_unload_datetime_from" class="label-value" style="display: none">
                                                <input class="add-input input-small input-value" name="final_unload_datetime_from" type="time" id="final_unload_datetime_from">
                                                <input class="add-input input-small input-value" name="final_unload_datetime_to" type="time" id="final_unload_datetime_to">
                                            </label>

                                            <label for="final_is_24h" class="label-value" style="display: none">
                                                <input type="hidden" name="final_is_24h" value="0">
                                                <input class="add-input input-small input-value" name="final_is_24h" value="1" type="checkbox" id="final_is_24h" style="min-width: 25px;">
                                                круглосуточно
                                            </label>

                                        </div>

                                        <div class="drivers-tags">
                                            <button id="add_final">
                                                <svg width="12" height="12">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                                Дата и время
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-inputs-cards">
                                <div class="add-inputs-card">
                                    <b>*Кузов</b>
                                    <div class="add-inputs-card__wrapp">
                                        <div class="add-inputs-card_block border">
                                            <label for="all" class="add-input-general">
                                                <input type="checkbox" name="body_types[]" id="all" value="все закр.+изотерм">
                                                все закр.+изотерм
                                            </label>
                                            <label for="tnt">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="tnt" value="тентованный">
                                                тентованный
                                            </label>
                                            <label for="cn">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="cn" value="контейнер">
                                                контейнер
                                            </label>
                                            <label for="fr">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="fr" value="фургон">
                                                фургон
                                            </label>
                                            <label for="mt">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="mt" value="цельнометалл">
                                                цельнометалл.
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block">
                                            <label for="0">
                                                <input type="checkbox" name="body_types[]" id="0" value="изотермический">
                                                изотермический
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block border">
                                            <label for="refz" class="add-input-general">
                                                <input type="checkbox" name="body_types[]" id="refz" value="реф.+изотерм">
                                                реф.+изотерм
                                            </label>
                                            <label for="tnt">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="tnt" value="рефрижератор">
                                                рефрижератор
                                            </label>
                                            <label for="cn">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="cn" value="реф. с перегородкой">
                                                реф. с перегородкой
                                            </label>
                                            <label for="fr">
                                                <span></span>
                                                <input type="checkbox" name="body_types[]" id="fr" value="реф. мультирежимный">
                                                реф. мультирежимный
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="add-inputs-card">
                                    <b>*Загрузка</b>
                                    <div class="add-inputs-card__wrapp">
                                        <div class="add-inputs-card_block">
                                            <label for="1">
                                                <input type="checkbox" name="loading_types[]" id="1" value="верхняя">
                                                верхняя
                                            </label>
                                            <label for="2">
                                                <input type="checkbox" name="loading_types[]" id="2" value="боковая">
                                                боковая
                                            </label>
                                            <label for="3">
                                                <input type="checkbox" name="loading_types[]" id="3" value="задняя">
                                                задняя
                                            </label>
                                            <label for="4">
                                                <input type="checkbox" name="loading_types[]" id="4" value="с полной растентовкой">
                                                с полной растентовкой
                                            </label>
                                            <label for="5">
                                                <input type="checkbox" name="loading_types[]" id="5" value="со снятием поперечных перекладин">
                                                со снятием поперечных перекладин
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block">
                                            <label for="6">
                                                <input type="checkbox" name="loading_types[]" id="6" value="верхняя">
                                                верхняя
                                            </label>
                                            <label for="7">
                                                <input type="checkbox" name="loading_types[]" id="7" value="боковая">
                                                боковая
                                            </label>
                                            <label for="8">
                                                <input type="checkbox" name="loading_types[]" id="8" value="задняя">
                                                задняя
                                            </label>
                                            <label for="9">
                                                <input type="checkbox" name="loading_types[]" id="9" value="с полной растентовкой.">
                                                с полной растентовкой.
                                            </label>
                                            <label for="10">
                                                <input type="checkbox" name="loading_types[]" id="10" value=" полной растентовкой">
                                                с полной растентовкой
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="add-inputs-card">
                                    <b>*Выгрузка</b>
                                    <div class="add-inputs-card__wrapp">
                                        <div class="add-inputs-card_block">
                                            <label for="11">
                                                <input type="checkbox" name="unloading_types[]" id="11" value="верхняя">
                                                верхняя
                                            </label>
                                            <label for="12">
                                                <input type="checkbox" name="unloading_types[]" id="12" value="боковая">
                                                боковая
                                            </label>
                                            <label for="13">
                                                <input type="checkbox" name="unloading_types[]" id="13" value="задняя">
                                                задняя
                                            </label>
                                            <label for="14">
                                                <input type="checkbox" name="unloading_types[]" id="14" value="с полной растентовкой">
                                                с полной растентовкой
                                            </label>
                                            <label for="15">
                                                <input type="checkbox" name="unloading_types[]" id="15" value="со снятием поперечных перекладин">
                                                со снятием поперечных перекладин
                                            </label>
                                        </div>

                                        <div class="add-inputs-card_block">
                                            <label for="16">
                                                <input type="checkbox" name="unloading_types[]" id="16" value="верхняя">
                                                верхняя
                                            </label>
                                            <label for="17">
                                                <input type="checkbox" name="unloading_types[]" id="17" value="боковая">
                                                боковая
                                            </label>
                                            <label for="18">
                                                <input type="checkbox" name="unloading_types[]" id="18" value="задняя">
                                                задняя
                                            </label>
                                            <label for="19">
                                                <input type="checkbox" name="unloading_types[]" id="19" value="с полной растентовкой.">
                                                с полной растентовкой.
                                            </label>
                                            <label for="20">
                                                <input type="checkbox" name="unloading_types[]" id="20" value="с полной растентовкой">
                                                с полной растентовкой
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="add-goods-more__row">--}}
{{--                                <p>Загрузка</p>--}}
{{--                                <div class="add-goods_radios">--}}
{{--                                    <label>--}}
{{--                                        <input type="radio" name="loading" id="radio1" checked>--}}
{{--                                        <span>отдельной машиной (FTL)</span>--}}
{{--                                    </label>--}}
{{--                                    <label>--}}
{{--                                        <input type="radio" name="loading" id="radio2">--}}
{{--                                        <span>отдельной машиной или догрузом (FTL или LTL)</span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="add-goods-more__row">--}}
{{--                                <p>Добавить</p>--}}

{{--                                <div class="drivers-tags">--}}
{{--                                    <button>--}}
{{--                                        <svg width="12" height="12">--}}
{{--                                            <use xlink:href="#plus"></use>--}}
{{--                                        </svg>--}}
{{--                                        Кол-во машин--}}
{{--                                    </button>--}}
{{--                                    <button>--}}
{{--                                        <svg width="12" height="12">--}}
{{--                                            <use xlink:href="#plus"></use>--}}
{{--                                        </svg>--}}
{{--                                        ADR--}}
{{--                                    </button>--}}
{{--                                    <button>--}}
{{--                                        <svg width="12" height="12">--}}
{{--                                            <use xlink:href="#plus"></use>--}}
{{--                                        </svg>--}}
{{--                                        Сценка, пнемоход, коники--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="add-goods-choise choise-cash">
                                <input type="radio" name="payment_type" id="tr" value="negotiable">
                                <label for="tr">Возможен торг</label>

                                <input type="radio" name="payment_type" id="notr" checked value="no_haggling">
                                <label for="notr"> Без торга</label>

                                <input type="radio" name="payment_type" id="net" value="payment_request">
                                <label for="net">Запрос</label>

{{--                                <input type="radio" name="payment" id="rtr">--}}
{{--                                <label for="rtr">Торги</label>--}}
                            </div>

                            <p>Участники смогут предлагать свои услуги только по вашей ставке</p>
                            <br>
                            <div class="add-goods__bid">
                                <div class="add-goods__bid-row">
                                    <p>С НДС, безнал</p>
                                    <label for="with_vat_cashless">
                                        <input type="number" name="with_vat_cashless" id="with_vat_cashless">
                                    </label>
                                    <label>
                                        <select name="currency" id="currency" class="input-select">
                                            <option value="узб.сум">узб.сум</option>
                                            <option value="узб.сум">usd</option>
                                            <option value="тыс.руб">тыс.руб</option>
                                            <option value="руб/км">руб/км</option>
                                            <option value="руб/час">руб/час</option>
                                            <option value="руб/куб">руб/куб</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>Без НДС, безнал</p>
                                    <label for="without_vat_cashless">
                                        <input type="number" name="without_vat_cashless" id="without_vat_cashless">
                                    </label>
                                    <p>узб.сум</p>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>Наличными</p>
                                    <label for="cash">
                                        <input type="number" name="cash" id="cash">
                                    </label>
                                    <p>узб.сум</p>
                                </div>
                                <div class="add-goods__bid-row">
                                    <p>Встречные предложения</p>
                                    <div class="add-goods__bid-inputs">
                                        <label for="on_cart">
                                            <input type="hidden" name="on_cart" value="0">
                                            <input type="checkbox" id="on_cart" name="on_cart" value="1">
                                            на карту
                                        </label>
                                        <label for="counter_offers">
                                            <input type="hidden" name="counter_offers" value="0">
                                            <input type="checkbox" id="counter_offers" name="counter_offers" value="1">
                                            видны только вам
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="add-goods-more__row">
                                <p>Оплата через</p>

                                <div class="add-goods-more__payment">
                                    <label>
                                        <input type="number" name="payment_via">
{{--                                        <div class="add-goods__days">--}}
{{--                                            <button type="button">3дн.</button>--}}
{{--                                            <button type="button">5дн.</button>--}}
{{--                                            <button type="button">7дн.</button>--}}
{{--                                        </div>--}}
                                    </label>
                                    <p>банковских дней</p>
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

                            <div class="add-goods__bottom-radios">
                                <input type="radio" name="top" id="top">
                                <label for="top">Поднять груз в ТОП поиска (Приоритетный заказ)</label>

{{--                                <input type="radio" name="top" id="hidden">--}}
{{--                                <label for="hidden">Скрыть груз от нежелательных фирм(Стелс)</label>--}}

{{--                                <input type="radio" name="top" id="agree">--}}
{{--                                <label for="agree">Разрешить перевозчикам бронировать груз</label>--}}
                            </div>

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
                                    <b>Груз</b>
                                    <p>не заполнено</p>
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
                                        <b>Когда</b>
                                        <p>не заполнено</p>
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
                                        <b>Маршрут</b>
                                        <p>не заполнено</p>
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
                                        <b>Оплата</b>
                                        <p>не заполнено</p>
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
                                    <b>Дополнительно</b>
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
                                    <b>Площадки</b>
                                    <p><strong>Биржа EUCA ALLIANCE</strong></p>
                                </div>
                            </div>

                            <button class="add-goods__btn">Опублковать груз</button>
{{--                            <button class="add-goods__link">Сохранить как шаблон</button>--}}
                        </div>
                    </div>

                    <div class="add-goods__head add-goods__footer">
                        <div class="add-goods__buttons">
{{--                            <button type="button">Заполнить из шаблона</button>--}}
{{--                            <button type="reset">Очистить форму</button>--}}
                        </div>
                    </div>
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

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>