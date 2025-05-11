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

            <main class="coorfinations-content profile-content">
                <div class="order-head order-head-second">
                    <button type="button" class="form-btn form-btn__filters">Поиск по фильтрам</button>

                    <form class="form-order form-order-goods">
{{--                        <button class="form-order-close">--}}
{{--                            <span></span>--}}
{{--                            <span></span>--}}
{{--                        </button>--}}

                        <div class="form-order_row">
{{--                            <label for="all" class="search-icon">--}}
{{--                                <svg width="12" height="16">--}}
{{--                                    <use xlink:href="#search-icon"></use>--}}
{{--                                </svg>--}}
{{--                                <input type="text" id="all" placeholder="Все подразделения" name="all">--}}
{{--                            </label>--}}

{{--                            <label for="name">--}}
{{--                                <select name="name" id="name" class="input-select">--}}
{{--                                    <option value="" hidden>Имя</option>--}}
{{--                                    <option value="">Имя1</option>--}}
{{--                                    <option value="">Имя2</option>--}}
{{--                                    <option value="">Имя3</option>--}}
{{--                                </select>--}}
{{--                            </label>--}}

{{--                            <label for="place">--}}
{{--                                <select name="name" id="place" class="input-select">--}}
{{--                                    <option value="" hidden>Все площадки</option>--}}
{{--                                    <option value="">площадка1</option>--}}
{{--                                    <option value="">площадка2</option>--}}
{{--                                    <option value="">площадка3</option>--}}
{{--                                </select>--}}
{{--                            </label>--}}

{{--                            <label for="status">--}}
{{--                                <select name="name" id="status" class="input-select">--}}
{{--                                    <option value="" hidden>Все статусы грузов</option>--}}
{{--                                    <option value="">на погрузке</option>--}}
{{--                                    <option value="">в пути</option>--}}
{{--                                    <option value="">ожидает одобрения</option>--}}
{{--                                </select>--}}
{{--                            </label>--}}

{{--                            <label class="check-offer">--}}
{{--                                <input type="checkbox">--}}
{{--                                Только со встречными предложениями--}}
{{--                            </label>--}}

                            <a href="{{ route('cargos.create', app()->getLocale()) }}" class="form-btn">
                                <svg width="14" height="14">
                                    <use xlink:href="#plus"></use>
                                </svg>
                                Добавить груз
                            </a>
                        </div>

{{--                        <div class="form-order_row">--}}
{{--                            <label for="all" class="search-icon">--}}
{{--                                <svg width="12" height="16">--}}
{{--                                    <use xlink:href="#search-icon"></use>--}}
{{--                                </svg>--}}
{{--                                <input type="text" id="all" placeholder="№ груза/Заказа" name="all">--}}
{{--                            </label>--}}

{{--                            <label for="from">--}}
{{--                                <svg width="12" height="16">--}}
{{--                                    <use xlink:href="#map"></use>--}}
{{--                                </svg>--}}

{{--                                <input type="text" id="from" placeholder="Откуда" name="from">--}}
{{--                            </label>--}}

{{--                            <label for="to">--}}
{{--                                <svg width="12" height="16">--}}
{{--                                    <use xlink:href="#map"></use>--}}
{{--                                </svg>--}}

{{--                                <input type="text" id="to" placeholder="Откуда" name="to">--}}
{{--                            </label>--}}

{{--                            <div class="form-order__counts">--}}
{{--                                Вес--}}
{{--                                <label for="weightfrom" class="label-small">--}}
{{--                                    <input type="text" placeholder="от" id="weightfrom">--}}
{{--                                    <span>T</span>--}}
{{--                                </label>--}}
{{--                                <label for="weightto" class="label-small">--}}
{{--                                    <input type="text" placeholder="до" id="weightto">--}}
{{--                                    <span>T</span>--}}
{{--                                </label>--}}
{{--                                Объем--}}
{{--                                <label for="valuefrom" class="label-small">--}}
{{--                                    <input type="text" placeholder="от" id="valuefrom">--}}
{{--                                    <span>м<sup>2</sup></span>--}}
{{--                                </label>--}}
{{--                                <label for="valueto" class="label-small">--}}
{{--                                    <input type="text" placeholder="до" id="valueto">--}}
{{--                                    <span>м<sup>2</sup></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </form>
                </div>

                @if($cargoLoadings->isNotEmpty())
                @foreach($cargoLoadings as $cargo)
                <div class="order-info">
                    <div class="order-info-second order-info__head">
                        <label for="dir" class="label-order">
                            <input type="checkbox" id="dir">
                            Груз
                        </label>

                        <p>загрузка</p>
                        <p>разгрузка</p>
                        <p>ВЕС, Т / ОБЬЕМ, М3 ГРУЗ</p>
                        <p>Транспорт</p>
                        <p>ставка</p>
                    </div>

                    <div class="order-info-content">
                        <div class="order-info-second order-info__card">
                            <div class="order-info-col">
                                <label for="dir" class="mobile-order-head label-order">
                                    <input type="checkbox" id="dir">
                                    Груз
                                </label>

                                <details>
                                    <summary>{{ $cargo?->cargo?->title }}</summary>
                                </details>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">загрузка</p>
                                <p>{{ $cargo?->country }}</p>
                                <p>{{ $cargo?->address }}</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">разгрузка</p>
                                <p>{{ $cargo?->final_unload_country }}</p>
                                <p>{{ $cargo?->final_unload_address }}</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">ВЕС, Т / ОБЬЕМ, М3 ГРУЗ</p>
                                <p class="car-head"><strong>{{ $cargo?->cargo?->weight }} / {{ $cargo?->cargo?->weight_type }}</strong></p>
                                <p class="car-head"><strong>{{ $cargo?->cargo?->volume }}</strong></p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">Транспорт</p>
                                <p>{{ implode(', ', $cargo?->body_types) }}</p>
                                <p>{{ implode(', ', $cargo?->loading_types) }}</p>
                                <p>{{ implode(', ', $cargo?->unloading_types) }}</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">ставка</p>
                                @if($cargo?->with_vat_cashless)
                                <p class="car-head">{{ $cargo?->with_vat_cashless }} {{ $cargo?->currency }}</p>
                                @endif
                                @if($cargo?->without_vat_cashless)
                                <p class="car-head">{{ $cargo?->without_vat_cashless }} {{ $cargo?->currency }}</p>
                                @endif
                                @if($cargo?->cash)
                                <p class="car-head">{{ $cargo?->cash }} {{ $cargo?->currency }}</p>
                                @endif
                                <div class="order-icons">
                                    <a href="" class="chat-message" data-modal-target="dropdown-chat">
                                        <img src="{{ asset('assets/images/svg/order-pen.svg') }}" alt="meassge" width="30" height="30">
                                    </a>

                                    <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat">
                                        <button class="order-close-btn" data-modal-close="dropdown-chat"></button>
                                        <div class="tr">
                                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                            </svg>
                                        </div>
                                        <b>Отправить сообщение</b>
                                        <form action="" method="">
                                            <textarea name="" id="" style="height: auto; overflow: hidden"></textarea>

                                            <button class="form-btn" data-modal-close="dropdown-chat">Отправить</button>
                                            <button type="button" class="order-cansel" data-modal-close="dropdown-chat">Не
                                                отклонять</button>
                                        </form>
                                    </div>

                                    <div class="modal-overlay dropdown-links-order" data-modal="dropdown">
                                        <button data-modal-target="modal-change-bid">Изменить ставку</button>
                                        <button data-modal-target="modal-change-road">Изменить маршрут</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-info__card order-card-border order-info__buttom">
                            <div class="order-info-col">
{{--                                <p>--}}
{{--                                    Имя--}}
{{--                                </p>--}}
                            </div>

                            <div class="order-info-col">
                            </div>

                            <div class="order-info-col">
                            </div>

                            <div class="order-info-col order-goods-info order-info-bottom__end">
                                <p>доб <strong>{{ $cargo->created_at->format('d.m.Y H:i') }}</strong></p>
                                <button class="form-btn">Предложить груз</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </main>
        </div>

    </div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>