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

                <h1>{{ __('lang.Ваши грузы') }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="coorfinations-content profile-content">

                @if($cargoLoadings->isNotEmpty())
                <div class="order-head order-head-second">
                    <form class="form-order">
{{--                        <label for="cargo-title" class="search-icon">--}}
{{--                            <svg width="12" height="16">--}}
{{--                                <use xlink:href="#search-icon"></use>--}}
{{--                            </svg>--}}
{{--                            <input type="text" id="cargo-title" placeholder="Груз" name="cargo-title">--}}
{{--                        </label>--}}

{{--                        <label for="from">--}}
{{--                            <svg width="12" height="16">--}}
{{--                                <use xlink:href="#map"></use>--}}
{{--                            </svg>--}}

{{--                            <input type="text" id="from" placeholder="Загрузка" name="from">--}}
{{--                        </label>--}}

{{--                        <label for="to">--}}
{{--                            <svg width="12" height="16">--}}
{{--                                <use xlink:href="#map"></use>--}}
{{--                            </svg>--}}

{{--                            <input type="text" id="to" placeholder="Выгрузка" name="to">--}}
{{--                        </label>--}}
                    </form>
                    <a href="javascript:;" class="form-btn">
                        <svg width="14" height="14">
                            <use xlink:href="#plus"></use>
                        </svg>

                        {{ __('lang.Добавить заявку водителю') }}
                    </a>
                </div>
                @endif

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
                                            <p><strong>{{ $cargoBid->cargoLoading->cargo->constant_frequency == 'daily' ? __('lang.Ежедневно') : __('lang.По рабочим дням') }}</strong></p>
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

                                    </div>

                                    <div class="order-info-col order-info-bottom__end">
                                        <div class="order-info-m">
                                        </div>
                                        <b class="car-head">{{ __('lang.Ожидает одобрения') }}</b>
                                    </div>
                                </div>
                            </div>
                        </div>

{{--                        <div class="modal-overlay" data-modal="modal-create-order-{{ $cargoBid->cargoLoading->id }}">--}}
{{--                            <div class="modal modal-create-order">--}}
{{--                                <b>{{ __('lang.Предложение на перевозку') }}</b>--}}
{{--                                <p>{{ __('lang.Пока вы не примите решение, груз будет недоступен для других перевозчиков') }}</p>--}}

{{--                                <form action="{{ route('cargo.bids.accept', [app()->getLocale(), $cargoBid?->id]) }}" method="post">--}}
{{--                                    @csrf--}}

{{--                                    @if ($cargoBid?->user?->company)--}}
{{--                                        <p>{{ __('lang.От фирмы') }}</p>--}}
{{--                                        <div class="create-order-card">--}}
{{--                                            <svg width="24" height="18">--}}
{{--                                                <use xlink:href="#create1"></use>--}}
{{--                                            </svg>--}}
{{--                                            <div class="create-order-card__info">--}}
{{--                                                <p>--}}
{{--                                                    <strong>{{ $cargoBid?->user?->company?->name ?? __('lang.Неизвестно') }}</strong>--}}
{{--                                                </p>--}}
{{--                                                @foreach($cargoBid?->user?->company?->phones as $phone)--}}
{{--                                                    <p>{{ $phone->phone }}</p>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <p>{{ __('lang.Ставка') }}</p>--}}
{{--                                    @if($cargoBid->price)--}}
{{--                                        <div class="cretae-order-row">--}}
{{--                                            <p>--}}
{{--                                                <svg width="24" height="18">--}}
{{--                                                    <use xlink:href="#create1"></use>--}}
{{--                                                </svg>--}}
{{--                                                <strong>{{ $cargoBid?->price }} {{ $cargoBid->currency }}</strong>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        @if($cargoBid->with_vat_cashless)--}}
{{--                                            <div class="cretae-order-row">--}}
{{--                                                <p>--}}
{{--                                                    <svg width="24" height="18">--}}
{{--                                                        <use xlink:href="#create1"></use>--}}
{{--                                                    </svg>--}}
{{--                                                    <strong>{{ $cargoBid->with_vat_cashless }} {{ $cargoBid->currency }}</strong>--}}
{{--                                                    {{ __('lang.С НДС, безнал') }}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

{{--                                        @if($cargoBid->cargoLoading->without_vat_cashless)--}}
{{--                                            <div class="cretae-order-row">--}}
{{--                                                <p>--}}
{{--                                                    <svg width="24" height="18">--}}
{{--                                                        <use xlink:href="#create1"></use>--}}
{{--                                                    </svg>--}}
{{--                                                    <strong>{{ $cargoBid->without_vat_cashless }} {{ $cargoBid->currency }}</strong>--}}
{{--                                                    {{ __('lang.Без НДС, безнал') }}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

{{--                                        @if($cargoBid->cargoLoading->cash)--}}
{{--                                            <div class="cretae-order-row">--}}
{{--                                                <p>--}}
{{--                                                    <svg width="24" height="18">--}}
{{--                                                        <use xlink:href="#create1"></use>--}}
{{--                                                    </svg>--}}
{{--                                                    <strong>{{ $cargoBid->cash }} {{ $cargoBid->currency }}</strong>--}}
{{--                                                    {{ __('lang.Наличными') }}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

{{--                                    @endif--}}

{{--                                    --}}{{--                            <p>ТС</p>--}}
{{--                                    --}}{{--                            <div class="cretae-order-row">--}}
{{--                                    --}}{{--                                <p>--}}
{{--                                    --}}{{--                                    <svg width="24" height="18">--}}
{{--                                    --}}{{--                                        <use xlink:href="#create3"></use>--}}
{{--                                    --}}{{--                                    </svg>--}}
{{--                                    --}}{{--                                    <strong>Укажу данные позже</strong>--}}
{{--                                    --}}{{--                                </p>--}}
{{--                                    --}}{{--                            </div>--}}

{{--                                    --}}{{--                            <p>Водитель</p>--}}
{{--                                    --}}{{--                            <div class="cretae-order-row">--}}
{{--                                    --}}{{--                                <p>--}}
{{--                                    --}}{{--                                    <svg width="24" height="18">--}}
{{--                                    --}}{{--                                        <use xlink:href="#human"></use>--}}
{{--                                    --}}{{--                                    </svg>--}}
{{--                                    --}}{{--                                    <strong>Укажу данные позже</strong>--}}
{{--                                    --}}{{--                                </p>--}}
{{--                                    --}}{{--                            </div>--}}

{{--                                    <p>{{ __('lang.Информация') }}</p>--}}
{{--                                    <div class="create-order-card">--}}
{{--                                        <svg width="24" height="18">--}}
{{--                                            <use xlink:href="#create1"></use>--}}
{{--                                        </svg>--}}
{{--                                        <div class="create-order-card__info">--}}
{{--                                            <p>--}}
{{--                                                <strong>{{ $cargoBid?->user?->full_name }}</strong>--}}
{{--                                            </p>--}}
{{--                                            <p><span>{{ __('lang.ИНН') }}</span>{{ $cargoBid?->user?->inn }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <p>{{ __('lang.Комментарий') }}</p>--}}
{{--                                    <div class="create-order-card">--}}
{{--                                        <div class="create-order-card__info">--}}
{{--                                            <p>{{ $cargoBid?->payment_comment }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="create-order-buttons">--}}
{{--                                        <button type="submit" class="form-btn" data-modal-close="modal-create-order-{{ $cargoBid->cargoLoading->id }}">{{ __('lang.Одобрить и создать заказ') }}</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}

{{--                                <button class="modal-close" type="button" data-modal-close="modal-create-order-{{ $cargoBid->cargoLoading->id }}">--}}
{{--                                    <span></span>--}}
{{--                                    <span></span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
                                    <p>{{ __('lang.Перевозчик взял груз') }}</p>
                                    <p>{{ __('lang.Вы можете оформить заявку') }}</p>
                                    <div class="order-buttons">
                                        <button class="form-btn button-text" data-modal-target="modal-create-order-{{ $cargoLoading->id }}">{{ __('lang.Оформить') }}</button>

                                        <button class="button-text chat-message" data-modal-target="dropdown-close-{{ $cargoLoading->id }}">{{ __('lang.Отклонить') }}</button>

                                        <span>{{ $cargoLoading?->bid?->created_at?->format('d.m.Y H:i') }}</span>
                                    </div>

                                    <div class="order-cansel-modal order-cansel-dropdown" data-modal="dropdown-close-{{ $cargoLoading->id }}">
                                        <button class="order-close-btn" data-modal-close="dropdown-close-{{ $cargoLoading->id }}"></button>
                                        <div class="tr">
                                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                            </svg>
                                        </div>
                                        <b>{{ __('lang.Отклонить предложение') }}</b>
                                        <p>{{ __('lang.Укажите причину отмены предложения') }}</p>
                                        <form action="{{ route('cargo.bids.decline', [app()->getLocale(), $cargoLoading?->bid?->id]) }}" method="POST">
                                            @csrf
                                            <textarea name="comment" data-error="{{ __('lang.Пожалуйста, укажите причину отмены.') }}" id="comment-{{ $cargoLoading?->bid?->id }}" style="height: auto; overflow: hidden" required></textarea>
                                            <b>{{ __('lang.Что сделать с грузом') }}</b>

                                            <label for="save-{{ $cargoLoading?->bid?->id }}">
                                                {{ __('lang.Восстановить груз') }}
                                                <input type="radio" name="archiveOption" id="save-{{ $cargoLoading?->bid?->id }}" value="restore" checked>
                                            </label>
                                            <label for="stay-{{ $cargoLoading?->bid?->id }}">
                                                {{ __('lang.Оставить груз в архиве') }}
                                                <input type="radio" name="archiveOption" id="stay-{{ $cargoLoading?->bid?->id }}" value="keep">
                                            </label>

                                            <button class="form-btn" onclick="submitDeclineForm({{ $cargoLoading?->bid?->id }})" data-modal-close="dropdown-close-{{ $cargoLoading->id }}">{{ __('lang.Отклонить предложение') }}</button>
                                            <button type="button" class="order-cansel" data-modal-close="dropdown-close-{{ $cargoLoading->id }}">{{ __('lang.Не отклонять') }}</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" data-modal="modal-create-order-{{ $cargoLoading->id }}">
                    <div class="modal modal-create-order">
                        <b>{{ __('lang.Предложение на перевозку') }}</b>
                        <p>{{ __('lang.Пока вы не примите решение, груз будет недоступен для других перевозчиков') }}</p>

                        <form action="{{ route('cargo.bids.accept', [app()->getLocale(), $cargoLoading->bid?->id]) }}" method="post">
                            @csrf

                            <div class="create-order-card">
                                <svg width="24" height="18">
                                    <use xlink:href="#create1"></use>
                                </svg>
                                <div class="create-order-card__info">
                                    <p><strong>{{ $cargoLoading->bid?->user?->full_name ?? __('lang.Неизвестно') }}</strong></p>
                                    <p>{{ $cargoLoading->bid?->user?->phone }}</p>
                                </div>
                            </div>

                            <p>{{ __('lang.Ставка') }}</p>
                            @if($cargoLoading->bid->price)
                            <div class="cretae-order-row">
                                <p>
                                    <svg width="24" height="18">
                                        <use xlink:href="#create1"></use>
                                    </svg>
                                    <strong>{{ $cargoLoading->bid->price }} {{ $cargoLoading->currency }}</strong>
                                </p>
                            </div>
                            @else
                                @if($cargoLoading->bid->with_vat_cashless)
                                    <div class="cretae-order-row">
                                        <p>
                                            <svg width="24" height="18">
                                                <use xlink:href="#create1"></use>
                                            </svg>
                                            <strong>{{ $cargoLoading->bid->with_vat_cashless }} {{ $cargoLoading->bid->currency }}</strong>
                                            {{ __('lang.С НДС, безнал') }}
                                        </p>
                                    </div>
                                @endif

                                @if($cargoLoading->bid->without_vat_cashless)
                                    <div class="cretae-order-row">
                                        <p>
                                            <svg width="24" height="18">
                                                <use xlink:href="#create1"></use>
                                            </svg>
                                            <strong>{{ $cargoLoading->bid->without_vat_cashless }} {{ $cargoLoading->bid->currency }}</strong>
                                            {{ __('lang.Без НДС, безнал') }}
                                        </p>
                                    </div>
                                @endif

                                @if($cargoLoading->bid->cash)
                                    <div class="cretae-order-row">
                                        <p>
                                            <svg width="24" height="18">
                                                <use xlink:href="#create1"></use>
                                            </svg>
                                            <strong>{{ $cargoLoading->bid->cash }} {{ $cargoLoading->bid->currency }}</strong>
                                            {{ __('lang.Наличными') }}
                                        </p>
                                    </div>
                                @endif
                                @if($cargoLoading->bid->is_prepayment || $cargoLoading->bid->prepayment_percent)
                                    <div class="cretae-order-row">
                                        <p>
                                            <strong>{{ __('lang.Предоплата:') }} {{ $cargoLoading->bid?->prepayment_percent }}%</strong>
                                        </p>
                                    </div>
                                @endif

                                @if($cargoLoading->bid->is_on_unloading || $cargoLoading->bid->is_bank_transfer || $cargoLoading->bid->bank_transfer_days)
                                    <div class="cretae-order-row">

                                        <p>
                                            @if($cargoLoading->bid->is_on_unloading)
                                                <strong>{{ __('lang.На выгрузке') }}</strong>
                                            @endif

                                            @if($cargoLoading->bid->is_on_unloading || $cargoLoading->bid->bank_transfer_days)
                                            <strong>{{ __('lang.Через:') }}</strong> {{ $cargoLoading->bid->bank_transfer_days }} {{ __('lang.дней') }}
                                            @endif
                                        </p>
                                    </div>
                                @endif

                            @endif

                            <p>{{ __('lang.Информация') }}</p>
                            <div class="create-order-card">
                                <svg width="24" height="18">
                                    <use xlink:href="#create1"></use>
                                </svg>
                                <div class="create-order-card__info">
                                    <p><span>{{ __('lang.ИНН') }}</span>{{ $cargoLoading->bid?->user?->inn }}</p>
                                </div>
                            </div>

                            <p>{{ __('lang.Комментарий') }}</p>
                            <div class="create-order-card">
                                <div class="create-order-card__info">
                                    <p>{{ $cargoLoading->bid?->payment_comment }}</p>
                                </div>
                            </div>

                            <div class="create-order-buttons">
                                <button type="submit" class="form-btn" data-modal-close="modal-create-order-{{ $cargoLoading->id }}">{{ __('lang.Одобрить и создать заказ') }}</button>
                            </div>
                        </form>

                        <button class="modal-close" type="button" data-modal-close="modal-create-order-{{ $cargoLoading->id }}">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
                @endforeach
                @endif

                @if($cargoLoadings->isEmpty() && $cargoBids->isEmpty())
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

            </main>
        </div>

    </div>
</main>

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

{{--<div class="modal-overlay" data-modal="modal-driver">--}}
{{--    <div class="modal modal-register">--}}
{{--        <b>Данные водителя</b>--}}

{{--        <form action="" method="post">--}}
{{--            <div class="input__row">--}}
{{--                <p>Водитель</p>--}}

{{--                <label>--}}
{{--                    <select aria-label="Добавить водителя" name="" id="">--}}
{{--                        <option value="" hidden>Добавить водителя</option>--}}
{{--                        <option value="">name2</option>--}}
{{--                        <option value="">name3</option>--}}
{{--                    </select>--}}

{{--                    <span class="arrow"></span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <button type="submit" class="form-btn" data-modal-close="modal-driver">Сохранить</button>--}}
{{--        </form>--}}

{{--        <button class="modal-close" type="button" data-modal-close="modal-driver">--}}
{{--            <span></span>--}}
{{--            <span></span>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="modal-overlay" data-modal="modal-ts">--}}
{{--    <div class="modal modal-register">--}}
{{--        <b>Данные ТС</b>--}}

{{--        <form action="" method="post">--}}
{{--            <div class="input__row">--}}
{{--                <p>ТС</p>--}}

{{--                <label>--}}
{{--                    <select aria-label="Выбирите ТС" name="" id="">--}}
{{--                        <option value="" hidden>Автомобиль</option>--}}
{{--                        <option value="">Самолет</option>--}}
{{--                        <option value="">Паром</option>--}}
{{--                    </select>--}}

{{--                    <span class="arrow"></span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <button type="submit" class="form-btn" data-modal-close="modal-ts">Сохранить</button>--}}
{{--        </form>--}}

{{--        <button class="modal-close" type="button" data-modal-close="modal-ts">--}}
{{--            <span></span>--}}
{{--            <span></span>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}

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

<script>
    function submitDeclineForm(id) {
        const textarea = document.getElementById('comment-' + id);
        const form = document.getElementById('declineForm-' + id);
        const errorMessage = textarea.dataset.error || 'Поле не заполнено';

        if (!textarea.value.trim()) {
            alert(errorMessage);
            textarea.focus();
            return;
        }

        form.submit();
    }
</script>

</body>
</html>