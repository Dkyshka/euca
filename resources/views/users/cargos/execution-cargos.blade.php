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


                @if($cargoBids->isNotEmpty())
                    @foreach($cargoBids as $cargoBid)
                        <div class="order-info">
                            <div class="order-info__head order-info-second">
                                <p>{{ __('lang.Груз') }}</p>

                                <p>{{ __('lang.загрузка') }}</p>
                                <p>{{ __('lang.разгрузка') }}</p>
                                <p>{{ __('lang.ВЕС, Т / ОБЬЕМ, М3 ГРУЗ') }}</p>
                                <p>{{ __('lang.Транспорт') }}</p>
                                <p>{{ __('lang.ставка') }}</p>
                            </div>

                            <div class="order-info-content">
                                <div class="order-info__card order-info-second">
                                    <div class="order-info-col">
                                        <p class="car-head"><strong>{{ Str::limit($cargoBid->cargoLoading->cargo->title, 50) }}</strong></p>
                                    </div>

                                    <div class="order-info-col">
                                        <p class="mobile-order-head">{{ __('lang.загрузка') }}</p>
                                        <p class="car-head"><strong>{{ Str::limit($cargoBid->cargoLoading->country, 50) }}</strong></p>
                                        @if($cargoBid->cargoLoading->cargo->constant_frequency)
                                            <p><strong>{{ $cargoBid->cargoLoading->cargo->constant_frequency == 'daily' ? __('Ежедневно') : __('По рабочим дням') }}</strong></p>
                                        @elseif($cargoBid->cargoLoading?->cargo?->ready_date)
                                            <p><strong>{{ $cargoBid->cargoLoading?->cargo?->ready_date?->format('d.m.Y') }}</strong></p>
                                        @else
                                        @endif
                                    </div>

                                    <div class="order-info-col">
                                        <p class="mobile-order-head">{{ __('lang.ВЕС, Т / ОБЬЕМ, М3 ГРУЗ') }}</p>
                                        <p class="car-head"><strong>{{ Str::limit($cargoBid->cargoLoading->final_unload_city, 50) }}</strong></p>
                                        <p>{{ $cargoBid->cargoLoading->final_unload_date_from?->format('d.m.Y') }}</p>
                                    </div>

                                    <div class="order-info-col">
                                        <p class="mobile-order-head">{{ __('lang.Транспорт') }}</p>
                                        <p class="car-head">
                                            <strong>{{ $cargoBid->cargoLoading->cargo->weight }} - </strong>
                                            {{ $cargoBid->cargoLoading->cargo->weight_type }} /
                                            {{ $cargoBid->cargoLoading->cargo->volume }} М3
                                        </p>
                                    </div>

                                    <div class="order-info-col">
                                        <p class="mobile-order-head">{{ __('lang.ставка') }}</p>
                                        <p class="car-head">
                                            <strong>
                                                {{ __('lang.Кузов') }}
                                            </strong>
                                        </p>
                                        <p>
                                            {{ Str::limit(implode(', ', array_slice($cargoBid->cargoLoading->body_types, 0, 5)), 70) }}
                                        </p>
                                    </div>

                                    <div class="order-info-col">
                                        <p class="mobile-order-head"></p>
                                        @if($cargoBid->cargoLoading->payment_type == 'payment_request')
                                            <p class="car-head">{{ __('Запрос ставки') }}</p>
                                        @else
                                            @if($cargoBid->cargoLoading->with_vat_cashless)
                                                <p class="car-head"><strong>{{ $cargoBid->cargoLoading->with_vat_cashless }}</strong> {{ $cargoBid->cargoLoading->currency }} {{ __('lang.С НДС, безнал') }}</p>
                                            @endif
                                            @if($cargoBid->cargoLoading->without_vat_cashless)
                                                <p class="car-head"><strong>{{ $cargoBid->cargoLoading->without_vat_cashless }}</strong> {{ $cargoBid->cargoLoading->currency }} {{ __('lang.Без НДС, безнал') }}</p>
                                            @endif
                                            @if($cargoBid->cargoLoading->cash)
                                                <p class="car-head"><strong>{{ $cargoBid->cargoLoading->cash }}</strong> {{ $cargoBid->cargoLoading->currency }} {{ __('lang.Наличными') }}</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="order-info__card order-info__buttom order-card-border">
                                    <div class="order-info-col">
                                        <div class="order-info-col order-info__end order-info__row">

                                            <button data-modal-target="archive-modal">{{ __('lang.отменить заказ') }}</button>

                                            <div class="modal-archive" data-modal="archive-modal">
                                                <p>{{ __('lang.Заказ будет перемещен в архив') }}</p>
                                                    <form action="{{ route('cargo.bids.finished', [app()->getLocale(), $cargoBid->cargoLoading->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="order-buttons">
                                                            <button class="form-btn" data-modal-close="archive-modal" onclick="return confirm('Вы уверены, что хотите отменить заказ?')">{{ __('lang.Отменить заказ') }}</button>
                                                            <button type="button" class="more-info" data-modal-close="archive-modal">{{ __('lang.Не отменять') }}</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

{{--                                    <div class="order-info-col order-info-bottom__end">--}}
{{--                                        <div class="order-info-m">--}}
{{--                                        </div>--}}
{{--                                        <button class="more-info" data-modal-target="archive-modal-{{ $cargoBid->id }}">завершить</button>--}}
{{--                                        <button data-modal-target="archive-modal">отменить заказ</button>--}}
{{--                                        <div class="modal-archive" data-modal="archive-modal-{{ $cargoBid->id }}">--}}
{{--                                            <p>Заказ будет перемещен в архив и отмечен как отмеченный</p>--}}
{{--                                            <div class="flex-row">--}}
{{--                                                <button class="form-btn" data-modal-close="archive-modal">Отменить заказ</button>--}}
{{--                                                <button class="more-info" data-modal-close="archive-modal">Не отменять</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif

                @if($cargoLoadings->isNotEmpty())
                @foreach($cargoLoadings as $cargoLoading)
                <div class="order-info">
                    <div class="order-info__head order-info-second">
                        <p>{{ __('lang.Груз') }}</p>

                        <p>{{ __('lang.загрузка') }}</p>
                        <p>{{ __('lang.разгрузка') }}</p>
                        <p>{{ __('lang.ВЕС, Т / ОБЬЕМ, М3 ГРУЗ') }}</p>
                        <p>{{ __('lang.Транспорт') }}</p>
                        <p>{{ __('lang.ставка') }}</p>
                    </div>

                    <div class="order-info-content">
                        <div class="order-info__card order-info-second">
                            <div class="order-info-col">
                                <p class="car-head"><strong>{{ Str::limit($cargoLoading->cargo->title, 50) }}</strong></p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">{{ __('lang.загрузка') }}</p>

                                <p class="car-head"><strong>{{ Str::limit($cargoLoading->country, 50) }}</strong></p>
                                @if($cargoLoading->cargo->constant_frequency)
                                    <p><strong>{{ $cargoLoading->cargo->constant_frequency == 'daily' ? __('lang.Ежедневно') : __('lang.По рабочим дням') }}</strong></p>
                                @elseif($cargoLoading?->cargo?->ready_date)
                                    <p><strong>{{ $cargoLoading?->cargo?->ready_date?->format('d.m.Y') }}</strong></p>
                                @else
                                @endif
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">{{ __('lang.ВЕС, Т / ОБЬЕМ, М3 ГРУЗ') }}</p>

                                <p class="car-head"><strong>{{ Str::limit($cargoLoading->final_unload_city, 50) }}</strong></p>
                                <p>{{ $cargoLoading->final_unload_date_from?->format('d.m.Y') }}</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">{{ __('lang.Транспорт') }}</p>
                                <p class="car-head">
                                    <strong>{{ $cargoLoading->cargo->weight }} - </strong>
                                    {{ $cargoLoading->cargo->weight_type }} /
                                    {{ $cargoLoading->cargo->volume }} М3
                                </p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">{{ __('lang.ставка') }}</p>

                                <p class="car-head">
                                    <strong>
                                        {{ __('lang.Кузов') }}

                                    </strong>
                                </p>
                                <p>
                                    {{ Str::limit(implode(', ', array_slice($cargoLoading->body_types, 0, 5)), 70) }}
                                </p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head"></p>
                                @if($cargoLoading->payment_type == 'payment_request')
                                    <p class="car-head">{{ __('lang.Запрос ставки') }}</p>
                                @else
                                    @if($cargoLoading->with_vat_cashless)
                                        <p class="car-head"><strong>{{ $cargoLoading->with_vat_cashless }}</strong> {{ $cargoLoading->currency }} {{ __('lang.С НДС, безнал') }}</p>
                                    @endif
                                    @if($cargoLoading->without_vat_cashless)
                                        <p class="car-head"><strong>{{ $cargoLoading->without_vat_cashless }}</strong> {{ $cargoLoading->currency }} {{ __('lang.Без НДС, безнал') }}</p>
                                    @endif
                                    @if($cargoLoading->cash)
                                        <p class="car-head"><strong>{{ $cargoLoading->cash }}</strong> {{ $cargoLoading->currency }} {{ __('lang.Наличными') }}</p>
                                    @endif
                                @endif

                                {{-- Если есть перевозчик то можно открыть и написать --}}
                                <button class="chat-message" data-modal-target="dropdown-chat">
                                    <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                                </button>

                                <div class="order-cansel-modal" data-modal="dropdown-chat">
                                    <button class="order-close-btn" data-modal-close="dropdown-chat"></button>
                                    <div class="tr">
                                        <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                        </svg>
                                    </div>
                                    <b>{{ __('lang.Отправить сообщение') }}</b>
                                    <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" id="chatForm">
                                        @csrf
                                        <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $cargoLoading?->bids?->first()?->user->id }}">
                                        <textarea required name="message" id="chat_text_public" rows="5" style="height: auto; overflow: hidden"></textarea>

                                        <button class="form-btn" data-modal-close="dropdown-chat1">{{ __('lang.Отправить') }}</button>
                                        <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">{{ __('lang.Отмена') }}</button>
                                    </form>
                                </div>


                            </div>
                        </div>

                        <div class="order-info__card order-info__buttom order-card-border">
                            <div class="order-info-col">

                            </div>

                            <div class="order-info-col order-info-bottom__end">
                                <div class="order-info-m">
                                </div>
                                <div class="order-buttons-second">
                                    <p>{{ __('lang.Заказ в исполнении') }}</p>
                                    <form action="{{ route('cargo.bids.finished', [app()->getLocale(), $cargoLoading->id]) }}" method="POST">
                                    @csrf
                                    <div class="order-buttons">
                                        <button class="form-btn button-text" data-modal-target="modal-create-order-{{ $cargoLoading->id }}"
                                        onclick="return confirm('Вы уверены, что хотите завершить заказ?')">{{ __('lang.Завершить') }}</button>
                                        <span>{{ $cargoLoading->created_at?->format('d.m.Y H:i') }}</span>
                                    </div>
                                    </form>

{{--                                    <div class="order-cansel-modal order-cansel-dropdown" data-modal="dropdown-close">--}}
{{--                                        <button class="order-close-btn" data-modal-close="dropdown-close"></button>--}}
{{--                                        <div class="tr">--}}
{{--                                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                        <b>Заказ в исполнении</b>--}}
{{--                                        <form action="" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            <textarea name="comment" id="comment" style="height: auto; overflow: hidden"></textarea>--}}
{{--                                            <b>Что сделать с грузом</b>--}}

{{--                                            <label for="save">--}}
{{--                                                Восстановить груз--}}
{{--                                                <input type="radio" name="archiveOption" id="save" value="restore" checked>--}}
{{--                                            </label>--}}
{{--                                            <label for="stay">--}}
{{--                                                Оставить груз в архиве--}}
{{--                                                <input type="radio" name="archiveOption" id="stay" value="keep">--}}
{{--                                            </label>--}}

{{--                                            <button class="form-btn" data-modal-close="dropdown-close">Отклонить--}}
{{--                                                предложение</button>--}}
{{--                                            <button type="button" class="order-cansel" data-modal-close="dropdown-close">Не--}}
{{--                                                отклонять</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

                @if($cargoBids->isEmpty() && $cargoLoadings->isEmpty())
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
                            {{ __('lang.Добавить груз') }}
                        </a>
                    </div>
                @endif



                
{{--                <div class="order-info">--}}
{{--                    <div class="order-info__head">--}}
{{--                        <p>ТC/ Информация о грузе</p>--}}
{{--                        <p>Документы/ставка</p>--}}
{{--                        <p>Водитель/контрагент</p>--}}
{{--                        <p class="order-info__end">Статус/ дата изм</p>--}}
{{--                    </div>--}}

{{--                    <div class="order-info-content">--}}
{{--                        <div class="order-info__card order-info-top">--}}
{{--                            <div class="order-info-col">--}}
{{--                                <p class="mobile-order-head">ТC/ Информация о грузе</p>--}}
{{--                                <div class="order-info-row">--}}
{{--                                    <svg width="19" height="16">--}}
{{--                                        <use xlink:href="#ts"></use>--}}
{{--                                    </svg>--}}

{{--                                    <div class="card-order-flex">--}}
{{--                                        <p>Данные ТС не указаны</p>--}}
{{--                                        <button type="button" data-modal-target="modal-ts">Указать данные</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="order-info-col">--}}
{{--                                <p class="mobile-order-head">Документы/ставка</p>--}}
{{--                                <p class="order-info-row">--}}
{{--                                    <svg width="18" height="14">--}}
{{--                                        <use xlink:href="#order-plus"></use>--}}
{{--                                    </svg>--}}

{{--                                    <button type="button" data-modal-target="modal-file">Документы и фото--}}
{{--                                    </button></p>--}}
{{--                            </div>--}}

{{--                            <div class="order-info-col">--}}
{{--                                <p class="mobile-order-head">Водитель/контрагент</p>--}}
{{--                                <div class="order-info-row">--}}
{{--                                    <svg width="19" height="16">--}}
{{--                                        <use xlink:href="#ts"></use>--}}
{{--                                    </svg>--}}

{{--                                    <div class="card-order-flex">--}}
{{--                                        <p>Данные водителя не указаны</p>--}}
{{--                                        <button type="button" data-modal-target="modal-driver">Указать данные</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="order-info-col order-info-bottom__end">--}}
{{--                                <p class="mobile-order-head"></p>--}}
{{--                                <a href=""><strong>Заказ в исполени</strong> сегодня в 20:06, не просмотрено</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="order-info__card order-info__buttom">--}}
{{--                            <div class="order-info-col">--}}
{{--                                <p class="mobile-order-head">Статус/ дата изм</p>--}}
{{--                                <h5 class="car-head">#aze2478</h5>--}}
{{--                                <p>--}}
{{--                                    Санкт-Петербург--}}
{{--                                    <strong>Москва</strong>--}}
{{--                                    <svg width="10" height="10">--}}
{{--                                        <use xlink:href="#arrow-right"></use>--}}
{{--                                    </svg>--}}
{{--                                    <small>709км</small>--}}
{{--                                </p>--}}
{{--                                <p><strong>10/</strong>Автомашины <strong>26-28 авг</strong> отд.машина</p>--}}
{{--                                <a href="#">Застраховать груз</a>--}}

{{--                                <div class="road">--}}
{{--                                    <svg width="18" height="14">--}}
{{--                                        <use xlink:href="#dark-car"></use>--}}
{{--                                    </svg>--}}
{{--                                    Санкт-Петербург--}}

{{--                                    <svg width="8" height="10" class="arrow-road">--}}
{{--                                        <use xlink:href="#arrow-right"></use>--}}
{{--                                    </svg>--}}

{{--                                    <svg width="18" height="14">--}}
{{--                                        <use xlink:href="#blue-car"></use>--}}
{{--                                    </svg>--}}
{{--                                    Улан-удЭ--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="order-info-col">--}}
{{--                                <p class="mobile-order-head"></p>--}}
{{--                                <p class="car-head"><strong>100 000</strong> руб с НДС</p>--}}
{{--                            </div>--}}

{{--                            <div class="order-info-col">--}}
{{--                                <p class="mobile-order-head"></p>--}}
{{--                                <b class="car-head">Северные грузы,ООО</b>--}}
{{--                                <div class="stars">--}}
{{--                                    <svg width="13" height="13">--}}
{{--                                        <use xlink:href="#star"></use>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="13" height="13">--}}
{{--                                        <use xlink:href="#star"></use>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="13" height="13">--}}
{{--                                        <use xlink:href="#star"></use>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="13" height="13">--}}
{{--                                        <use xlink:href="#star"></use>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="13" height="13">--}}
{{--                                        <use xlink:href="#star"></use>--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                                <span>рекомендовать</span>--}}
{{--                                <span>Татьяна, +7(000)000000</span>--}}
{{--                            </div>--}}

{{--                            <div class="order-info-col order-info__end order-info__row">--}}

{{--                                <button data-modal-target="archive-modal">отменить заказ</button>--}}
{{--                                <button class="more-info">завершить</button>--}}

{{--                                <div class="modal-archive" data-modal="archive-modal">--}}
{{--                                    <p>Заказ будет перемещен в архив и отмечен как отмеченный</p>--}}
{{--                                    <div class="flex-row">--}}
{{--                                        <button class="form-btn" data-modal-close="archive-modal">Отменить заказ</button>--}}
{{--                                        <button class="more-info" data-modal-close="archive-modal">Не отменять</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </main>
        </div>

    </div>
</main>

<div class="modal-overlay" data-modal="modal-create-order">
    <div class="modal modal-create-order">
        <b>Предложение на перевозку</b>
        <p>Пока вы не примите решение, груз будет недоступен для других перевозчиков</p>

        <form action="" method="post">
            <p>От фирмы</p>
            <div class="create-order-card">
                <svg width="24" height="18">
                    <use xlink:href="#create1"></use>
                </svg>
                <div class="create-order-card__info">
                    <p>
                        <strong>tsi</strong>
                        <svg width="9" height="9">
                            <use xlink:href="#create1-1"></use>
                        </svg>
                    </p>
                    <p>Код: 357120, Перевозчик, Санкт-Петербург</p>
                    <p>Иван, +7 999 999-99-99</p>
                </div>
            </div>
            <p>Ставка</p>
            <div class="cretae-order-row">
                <p>
                    <svg width="24" height="18">
                        <use xlink:href="#create1"></use>
                    </svg>
                    <strong>100 000</strong>
                    с НДС, торг
                </p>

                <p>Груз №AZE2739</p>
            </div>
            <p>ТС</p>
            <div class="cretae-order-row">
                <p>
                    <svg width="24" height="18">
                        <use xlink:href="#create3"></use>
                    </svg>
                    <strong>Укажу данные позже</strong>
                </p>

                <p>Груз №AZE2739</p>
            </div>
            <p>Водитель</p>
            <div class="cretae-order-row">
                <p>
                    <svg width="24" height="18">
                        <use xlink:href="#human"></use>
                    </svg>
                    <strong>Укажу данные позже</strong>
                </p>

                <p>Груз №AZE2739</p>
            </div>
            <p>Реквизиты</p>
            <div class="create-order-card">
                <svg width="24" height="18">
                    <use xlink:href="#create1"></use>
                </svg>
                <div class="create-order-card__info">
                    <p>
                        <strong>Леонов АВ, СЗ</strong>
                    </p>
                    <p><span>ИНН</span>00 000 00000 00 00</p>
                    <a href="#">Показать полностью</a>
                </div>
                <a href="#">Проверить</a>
            </div>

            <div class="create-order-buttons">
                <button type="button" class="form-btn" data-modal-close="modal-create-order">Одобрить и создать заказ</button>
                <button type="button" class="create-order-cansel" data-modal-close="modal-create-order">Отклонить</button>
            </div>
        </form>

        <button class="modal-close" type="button" data-modal-close="modal-create-order">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<div class="modal-overlay" data-modal="modal-take-load">
    <div class="modal modal-create-order">
        <b>Вы взяли груз #aze2478</b>
        <p>Предложение на перевозку отправлено заказчику. Вы получите уведомление о его решении.</p>

        <form action="" method="post">
            <p>Груз</p>
            <div class="create-order-card">
                <svg width="24" height="18">
                    <use xlink:href="#create1"></use>
                </svg>
                <div class="create-order-card__info">
                    <p>
                        <span>#aze2478</span>
                    </p>
                    <p>
                        <strong>100 000</strong>
                        с НДС, торг
                    </p>
                    <div class="take-load__road">
                        <p>
                            <strong>714 км</strong>
                            (RUS)
                        </p>
                        <div class="road">
                            <svg width="18" height="14">
                                <use xlink:href="#dark-car"></use>
                            </svg>
                            Санкт-Петербург

                            <svg width="8" height="10" class="arrow-road">
                                <use xlink:href="#arrow-right"></use>
                            </svg>

                            <svg width="18" height="14">
                                <use xlink:href="#blue-car"></use>
                            </svg>
                            Улан-удЭ
                        </div>
                    </div>
                    <p>10/10 Автомашины <strong>готов 31 авг</strong></p>
                    <p>отд.машина</p>
                    <p>
                        <a href="#">ТЭК
                            <svg width="9" height="9">
                                <use xlink:href="#create1-1"></use>
                            </svg>
                        </a></p>
                    <a href="tel:+790000000">Татьяна, +7(900)0000000
                    </a></div>
            </div>
            <p>Водитель</p>
            <div class="cretae-order-row">
                <p>
                    <svg width="24" height="18">
                        <use xlink:href="#human"></use>
                    </svg>
                    <strong>Укажу данные позже</strong>
                </p>

                <p>Груз №AZE2739</p>
            </div>
            <p>ТС</p>
            <div class="cretae-order-row">
                <p>
                    <svg width="24" height="18">
                        <use xlink:href="#create3"></use>
                    </svg>
                    <strong>Укажу данные позже</strong>
                </p>

                <p>Груз №AZE2739</p>
            </div>

            <p>Реквизиты</p>
            <div class="create-order-card">
                <svg width="24" height="18">
                    <use xlink:href="#rek"></use>
                </svg>
                <div class="create-order-card__info">
                    <p>
                        <strong>Леонов АВ, СЗ</strong>
                    </p>
                    <p><span>ИНН</span>00 000 00000 00 00</p>
                    <a href="#">Показать полностью</a>
                </div>
                <a href="#">Проверить</a>
            </div>

            <div class="create-order-buttons take-load-buttons">
                <button type="button" class="form-btn" data-modal-close="modal-take-load">Закрыть</button>
                <button type="button" class="take-load-cansel" data-modal-close="modal-take-load">Отозвать предложение</button>
                <button type="button" class="take-load-cansel" data-modal-close="modal-take-load">Изменить предложение</button>
            </div>
        </form>

        <button class="modal-close" type="button" data-modal-close="modal-take-load">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<div class="modal-overlay" data-modal="modal-driver">
    <div class="modal modal-register">
        <b>Данные водителя</b>

        <form action="" method="post">
            <div class="input__row">
                <p>Водитель</p>

                <label>
                    <select aria-label="Добавить водителя" name="" id="">
                        <option value="" hidden>Добавить водителя</option>
                        <option value="">name2</option>
                        <option value="">name3</option>
                    </select>

                    <span class="arrow"></span>
                </label>
            </div>

            <button type="submit" class="form-btn" data-modal-close="modal-driver">Сохранить</button>
        </form>

        <button class="modal-close" type="button" data-modal-close="modal-driver">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<div class="modal-overlay" data-modal="modal-ts">
    <div class="modal modal-register">
        <b>Данные ТС</b>

        <form action="" method="post">
            <div class="input__row">
                <p>ТС</p>

                <label>
                    <select aria-label="Выбирите ТС" name="" id="">
                        <option value="" hidden>Автомобиль</option>
                        <option value="">Самолет</option>
                        <option value="">Паром</option>
                    </select>

                    <span class="arrow"></span>
                </label>
            </div>

            <button type="submit" class="form-btn" data-modal-close="modal-ts">Сохранить</button>
        </form>

        <button class="modal-close" type="button" data-modal-close="modal-ts">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<div class="modal-overlay" data-modal="modal-file">
    <div class="modal modal-register modal-file">
        <b>Документы и фото Заказа #YSU660</b>

        <form action="" method="post">
            <label class="form-btn modal-file-input">
                Добавить
                <input type="file">
            </label>
        </form>

        <p>
            Храните тут документы по Заказу. Все документы будут привязаны к конкретному Заказу и доступны для сотрудников вашей компании.
            Файлами можно делится их видимым только для вашей компани.
        </p>

        <p><strong>Шаблоны документов</strong></p>
        <p><strong>Грузополучатель</strong></p>
        <p>г. Москва, Ленина 15</p>

        <span>Файлы</span>

        <div class="modal-file__cards">
            <div class="modal-file__card">
                <svg width="30" height="30">
                    <use xlink:href="#file-card"></use>
                </svg>

                <div class="modal-file__info">
                    <p>Транспортная накладная от 2022...</p>
                    <span>46 Кб, 09.03. 2022, 17:08</span>
                </div>
            </div>
        </div>
        <button class="modal-close" type="button" data-modal-close="modal-file">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>