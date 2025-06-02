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

                        <div class="form-order_row">

                            <a href="{{ route('cargos.create', app()->getLocale()) }}" class="form-btn">
                                <svg width="14" height="14">
                                    <use xlink:href="#plus"></use>
                                </svg>
                                Добавить груз
                            </a>
                        </div>
                    </form>
                </div>

                @if($cargoLoadings->isNotEmpty())
                @foreach($cargoLoadings as $cargo)
                <div class="order-info">
                    <div class="order-info-second order-info__head">
                        <p>Груз</p>

                        <p>загрузка</p>
                        <p>разгрузка</p>
                        <p>ВЕС, Т / ОБЬЕМ, М3 ГРУЗ</p>
                        <p>Транспорт</p>
                        <p>ставка</p>
                    </div>

                    <div class="order-info-content">
                        <div class="order-info-second order-info__card">

                            <div class="order-info-col">
                                <p class="car-head"><strong>{{ Str::limit($cargo->cargo->title, 50) }}</strong></p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">загрузка</p>
                                <p>{{ $cargo?->country }}</p>
                                @if($cargo->cargo->constant_frequency)
                                    <p><strong>{{ $cargo->cargo->constant_frequency == 'daily' ? __('Ежедневно') : __('По рабочим дням') }}</strong></p>
                                @elseif($cargo?->cargo?->ready_date)
                                    <p><strong>{{ $cargo?->cargo?->ready_date?->format('d.m.Y') }}</strong></p>
                                @else
                                @endif
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">разгрузка</p>
                                <p>{{ $cargo?->final_unload_city }}</p>
                                <p>{{ $cargo->final_unload_date_from?->format('d.m.Y') }}</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">ВЕС, Т / ОБЬЕМ, М3 ГРУЗ</p>
                                <p class="car-head"><strong>{{ $cargo?->cargo?->weight }} - {{ $cargo?->cargo?->weight_type }} /</strong>
                                    {{ $cargo?->cargo?->volume }} М3
                                </p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">Транспорт</p>
                                <p>{{ Str::limit(implode(', ', array_slice($cargo?->body_types, 0, 5)), 70) }}</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">ставка</p>
                                @if($cargo->payment_type == 'payment_request')
                                    <p class="car-head">{{ __('Запрос ставки') }}</p>
                                @else
                                    @if($cargo?->with_vat_cashless)
                                    <p class="car-head">{{ $cargo?->with_vat_cashless }} {{ $cargo?->currency }}</p>
                                    @endif
                                    @if($cargo?->without_vat_cashless)
                                    <p class="car-head">{{ $cargo?->without_vat_cashless }} {{ $cargo?->currency }}</p>
                                    @endif
                                    @if($cargo?->cash)
                                    <p class="car-head">{{ $cargo?->cash }} {{ $cargo?->currency }}</p>
                                    @endif
                                @endif
                                <div class="order-icons">
                                    {{--Редактирование--}}
                                    <a href="{{ route('cargos.edit', [app()->getLocale(), $cargo->id]) }}" class="chat-message" data-modal-target="dropdown-chat">
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
                                <a href="{{ url(app()->getLocale(), 'transport-search') }}" target="_blank" class="form-btn" style="color: #fff; text-decoration: none;">Предложить груз</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="goods-empty notifications-empty">
                        <picture>
                            <source srcset="{{ asset('assets/images/goods.avif') }}">
                            <img src="{{ asset('assets/images/goods.png') }}" alt="empty" width="85" height="85">
                        </picture>
                        @if ($errors->has('company'))
                            <div class="alert alert-danger" style="color: red">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                        <a href="{{ route('cargos.create', app()->getLocale()) }}" class="form-btn">
                            Добавить груз
                        </a>
                    </div>
                @endif
            </main>
        </div>

    </div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>