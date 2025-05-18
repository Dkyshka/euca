<x-main.assets-header :menu="$menu"/>

<x-menu :page="$page"/>

<main class="main-wrapper search-inner-wrapper">
    <section class="search-page">
        <h1 class="title">Поиск грузов</h1>
        <div class="search-goods__head">
            <b>{{ $article->country }} - {{ $article->final_unload_city }}, {{ $article->cargo->title }}</b>
            <p><strong>( Создан {{ $article->created_at?->format('d.m.Y') }} ) </strong>изменен {{ $article->updated_at?->format('d.m.Y') }}</p>
        </div>
        <div class="add-goods__inner add-goods__main">
            <div class="add-gods__left search-goods__left">
                <div class="route-goods">
                    <p><strong>Маршрут и груз</strong></p>
                    <div class="route-goods__card">
                        <div class="route-goods__line">
                            <svg width="18" height="14">
                                <use xlink:href="#dark-car"></use>
                            </svg>

                            <span></span>

                            <svg width="18" height="14">
                                <use xlink:href="#blue-car"></use>
                            </svg>

                            <span></span>
                        </div>
                        <div class="route-goods__info">
                            <div class="route-goods__info-top">
                                <p>{{ $article->country }} ({{ $article->address }})</p>
                                @if($article->cargo->constant_frequency)
                                    <p><strong>{{ $article->cargo->constant_frequency == 'daily' ? 'Ежедневно' : 'По рабочим дням' }}</strong></p>
                                @elseif($article?->cargo?->ready_date)
                                    <p><strong>{{ $article?->cargo?->ready_date?->format('d.m.Y') }}</strong></p>
                                @else
                                    <p><strong>{{ __('Груза нет, запрос ставки') }}</strong></p>
                                @endif
                                <p>
                                    <svg width="24" height="18">
                                        <use xlink:href="#get-goods"></use>
                                    </svg>
                                    <strong>{{ $article->cargo->title }}</strong>
                                </p>
                            </div>
                            <div class="route-goods__info-bottom">
                                <p>{{ $article->final_unload_city }} ({{ $article->final_unload_address }})</p>
                                <p><strong>Разгрузка</strong></p>
                                @if($article->final_unload_date_from)
                                <p><strong>{{ $article->final_unload_date_from?->format('d.m.Y') }}</strong>
                                    @if($article->final_unload_date_to)
                                    - <strong>{{ $article->final_unload_date_to?->format('d.m.Y') }}</strong>
                                    @endif
                                </p>
                                @endif
                                @if($article->final_unload_datetime_from)
                                    <p><strong>{{ $article->final_unload_datetime_from?->format('H:i') }}</strong>
                                        @if($article->final_unload_datetime_to)
                                            - <strong>{{ $article->final_unload_datetime_to?->format('H:i') }}</strong>
                                        @endif
                                    </p>
                                @endif
                                @if($article->final_is_24h)
                                    <p><strong>{{ __('Круглосуточно') }}</strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="goods-map__wrapper">
                    <p><strong>Расчет расстояний</strong></p>
                    <div class="goods-map__cards">
                        <div class="goods-map__card">
                            <p id="distance"></p>
                        </div>
                    </div>
                    <div class="goods-map" id="goods-map">
                        <div class="map" id="myMap"></div>
                    </div>
                </div>
                <div class="route-goods__bottom">
                    <p><strong>Транспорт</strong></p>
                    <br>
                    <p><strong>Кузов</strong></p>
                    <p>{{ Str::limit(implode(', ', array_slice($article->body_types, 0, 5)), 70) }}</p>
                    @if (!empty($article->loading_types))
                        <p><strong>Загрузка</strong></p>
                        <p>{{ Str::limit(implode(', ', array_slice($article->loading_types, 0, 5)), 70) }}</p>
                    @endif
                    @if (!empty($article->unloading_types))
                        <p><strong>Выгрузка</strong></p>
                        <p>{{ Str::limit(implode(', ', array_slice($article->unloading_types, 0, 5)), 70) }}</p>
                    @endif

{{--                    <b>Комментарии</b>--}}
{{--                    <p><strong>шумоизоляция оплата по копиям 5 дней</strong></p>--}}
                </div>
                <p><strong>Ставка</strong></p>
                <div class="route-footer">
                    <div class="route-footer-col">
                    @if($article->with_vat_cashless)
                        <p><strong>{{ $article->with_vat_cashless }}</strong> {{ $article->currency }} С НДС, безнал</p>
                    @endif
                    </div>
                    @if($article->without_vat_cashless)
                    <div class="route-footer-col">
                            <p><strong>{{ $article->without_vat_cashless }}</strong> {{ $article->currency }} Без НДС, безнал</p>
                    </div>
                    @endif
                    @if($article->cash)
                    <div class="route-footer-col">
                        <p><strong>{{ $article->cash }}</strong> {{ $article->currency }} Наличными</p>
                    </div>
                    @endif

                    <div class="route-footer-col">
                        @auth
                            <button class="form-btn" data-modal-target="send-offer">Отправить предложение</button>
                        @else
                            <button class="form-btn" data-modal-target="modal-login">Отправить предложение</button>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="add-goods__right search-goods__right-inner">
                <div class="company-image">
                    @if($article->company->avatar)
                    <picture>
                        <source srcset="{{ asset($article->company->avatar) }}">
                        <img src="{{ asset($article->company->avatar) }}" width="90" height="90" alt="company-image" style="object-fit: contain;">
                    </picture>
                    @else
                    <picture>
                        <source srcset="{{ asset('assets/images/avatar.avif') }}">
                        <img src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
                    </picture>
                    @endif
                </div>
                <b>{{ $article->company->name }}</b>
                <p>{{ $article->company->country }}</p>
                <div class="company-contacts" style="position: relative">
                    <p>{{ $article->company->user?->full_name }}</p>
                    @foreach($article->company->phones as $item)
                    <a href="tel:{{ str_replace(['(', ')', '-', ' '], '', $item->phone) }}">{{ $item->phone }}</a>
                    @endforeach
                    <a class="company-link" href="javascript:;" data-modal-target="dropdown-chat1">Написать сообщение</a>

                    <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat1" style="top: -100%;left: 0;">
                        <button class="order-close-btn" data-modal-close="dropdown-chat1"></button>
                        <div class="tr">
                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                            </svg>
                        </div>
                        <b>Отправить сообщение</b>
                        <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" id="chatForm">
                            @csrf
                            <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $article->company->user->id }}">
                            <textarea required name="message" id="chat_text_public" rows="5" style="height: auto; overflow: hidden"></textarea>

                            <button class="form-btn" data-modal-close="dropdown-chat1">Отправить</button>
                            <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">Отмена</button>
                        </form>

                    </div>

                    @auth
                        <button class="form-btn" data-modal-target="send-offer">Отправить предложение</button>
                    @else
                        <button class="form-btn" data-modal-target="modal-login">Отправить предложение</button>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <x-main.assets-footer :footer="$footer" :settings="$settings"/>


{{--    <div class="modal-overlay" data-modal="modal-change-tarifs">--}}
{{--        <div class="modal modal-change-tarifs">--}}
{{--            <b>Смена тарифа</b>--}}

{{--            <p>--}}
{{--                Lorem ipsum dolor sit amet consectetur. Sagittis metus aenean convallis nulla accumsan tortor est est ornare. Pretium ornare--}}
{{--                congue at egestas tellus amet arcu.--}}
{{--            </p>--}}

{{--            <button class="form-btn">Подвердить</button>--}}
{{--            <button class="tarifs-change-btn" data-modal-close="modal-change-tarifs">Отмена</button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="modal-overlay" data-modal="get-goods">--}}
{{--        <div class="modal modal-create-order">--}}
{{--            <b>Взять груз</b>--}}
{{--            <p>У вас есть 24 мин, 52 сек, чтобы отправить предложение на перевозку.</p>--}}

{{--            <form action="" method="get">--}}
{{--                <p>Груз</p>--}}
{{--                <div class="create-order-card">--}}
{{--                    <svg width="24" height="18">--}}
{{--                        <use xlink:href="#get-goods"></use>--}}
{{--                    </svg>--}}
{{--                    <div class="create-order-card__info">--}}
{{--                        <p>--}}
{{--                            <strong>#aze2478</strong>--}}
{{--                            <svg width="9" height="9">--}}
{{--                                <use xlink:href="#create1-1"></use>--}}
{{--                            </svg>--}}
{{--                        </p>--}}
{{--                        <p><strong>100 000 </strong> с НДС, торг</p>--}}
{{--                        <div class="modal-row">--}}
{{--                            <p><strong>714</strong> (RUS)</p>--}}
{{--                            <div class="road">--}}
{{--                                <svg width="18" height="14">--}}
{{--                                    <use xlink:href="#dark-car"></use>--}}
{{--                                </svg>--}}
{{--                                Санкт-Петербург--}}

{{--                                <svg width="8" height="10" class="arrow-road">--}}
{{--                                    <use xlink:href="#arrow-right"></use>--}}
{{--                                </svg>--}}

{{--                                <svg width="18" height="14">--}}
{{--                                    <use xlink:href="#blue-car"></use>--}}
{{--                                </svg>--}}
{{--                                Улан-удЭ--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>10/ - Автошины<strong>14-16 фев</strong></p>--}}
{{--                        <p>отд.машина</p>--}}
{{--                        <span>Северные грузы</span>--}}
{{--                        <span><a href="#">Татьяна, +7(900)0000000</a></span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <p>Ставка</p>--}}
{{--                <p><strong>100 000 руб</strong>140,06 руб/км с ндс</p>--}}
{{--                <span>Водитель</span>--}}


{{--                <div class="cretae-order-row">--}}
{{--                    <p>--}}
{{--                        <svg width="24" height="18">--}}
{{--                            <use xlink:href="#create3"></use>--}}
{{--                        </svg>--}}
{{--                        <a href="#">Добавить водителя</a>--}}
{{--                    </p>--}}

{{--                    <p><a href="#">Укажу данные позже</a></p>--}}
{{--                </div>--}}

{{--                <p>ТС</p>--}}
{{--                <div class="cretae-order-row">--}}
{{--                    <p>--}}
{{--                        <svg width="24" height="18">--}}
{{--                            <use xlink:href="#human"></use>--}}
{{--                        </svg>--}}

{{--                        <label for="">--}}
{{--                            <select name="" id="">--}}
{{--                                <option value="" hidden>Добавить ТС</option>--}}
{{--                            </select>--}}
{{--                        </label>--}}

{{--                    </p>--}}

{{--                    <p><a href="#">Укажу данные позже</a></p>--}}
{{--                </div>--}}
{{--                <p>Реквизиты</p>--}}
{{--                <div class="cretae-order-row">--}}
{{--                    <p>--}}
{{--                        <svg width="24" height="18">--}}
{{--                            <use xlink:href="#create4"></use>--}}
{{--                        </svg>--}}

{{--                        <label for="" class="label-big-modal">--}}
{{--                            <select name="" id="">--}}
{{--                                <option value="" hidden>Выберите реквизиты</option>--}}
{{--                            </select>--}}
{{--                        </label>--}}

{{--                    </p>--}}
{{--                </div>--}}

{{--                <span>КОММЕНТАРИЙ (виден только грузовладельцу в отчетах по распределению грузов)</span>--}}

{{--                <div class="cretae-order-card">--}}
{{--                    <p>--}}
{{--                        <svg width="24" height="18">--}}
{{--                            <use xlink:href="#modal-chat"></use>--}}
{{--                        </svg>--}}
{{--                        Введите дополнительную информацию--}}
{{--                    </p>--}}

{{--                    <label class="modal-textarea">--}}
{{--					<textarea name="" id="" placeholder="Введите дополнительную информацию">--}}

{{--					</textarea>--}}
{{--                    </label>--}}
{{--                </div>--}}

{{--                <span>Чтобы взять груз, выберите водителя, ТС и реквезиты</span>--}}

{{--                <div class="create-order-buttons">--}}
{{--                    <button type="button" class="form-btn" data-modal-close="get-goods">Взять груз</button>--}}
{{--                    <p> <svg width="24" height="18">--}}
{{--                            <use xlink:href="#modal-time"></use>--}}
{{--                        </svg>--}}
{{--                        24:35--}}
{{--                    </p>--}}
{{--                    <button type="button" class="create-order-cansel" data-modal-close="get-goods">Отказаться от--}}
{{--                        груза</button>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <button class="modal-close" type="button" data-modal-close="get-goods">--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="modal-overlay" data-modal="send-offer">
        <div class="modal modal-send-offer">
            <div class="send-offer__header">
                <b>Груз</b>
            </div>
            <div class="send-offer__card">
                <div class="send-offer__row">
                    <div class="send-offer__col1">
                        <p><strong>Транспорт:</strong></p>
                    </div>
                    <div class="send-offer__col2">
                        <p><strong>Кузов</strong></p>
                        <p>{{ Str::limit(implode(', ', array_slice($article->body_types, 0, 5)), 70) }}</p>
                        @if (!empty($article->loading_types))
                            <p><strong>Загрузка</strong></p>
                            <p>{{ Str::limit(implode(', ', array_slice($article->loading_types, 0, 5)), 70) }}</p>
                        @endif
                        @if (!empty($article->unloading_types))
                            <p><strong>Выгрузка</strong></p>
                            <p>{{ Str::limit(implode(', ', array_slice($article->unloading_types, 0, 5)), 70) }}</p>
                        @endif
                    </div>
                </div>
                <div class="send-offer__row">
                    <div class="send-offer__col1">
                        <p><strong>Вес / объем, м3, груз:</strong></p>
                    </div>
                    <div class="send-offer__col2">
                        <strong>{{ $article->cargo->weight }} - </strong>
                        {{ $article->cargo->weight_type }} /
                        {{ $article->cargo->volume }} М3
                        <p>{{ $article->cargo->title }}</p>
                    </div>
                </div>
                <div class="send-offer__row">
                    <div class="send-offer__col1">
                        <p><strong>Маршрут:</strong></p>
                    </div>
                    <div class="send-offer__col2">
                        <p><strong>{{ $article->country }} - {{ $article->final_unload_city }}</strong></p>
                        <p>{{ $article->address }} - {{ $article->final_unload_address }}</p>
                    </div>
                </div>
                <div class="send-offer__row">
                    <div class="send-offer__col1">
                        <p><strong>Ставка:</strong></p>
                    </div>
                    <div class="send-offer__col2">
                        @if($article->with_vat_cashless)
                            <p><strong>{{ $article->with_vat_cashless }}</strong> {{ $article->currency }} С НДС, безнал</p>
                        @endif
                        @if($article->without_vat_cashless)
                            <p><strong>{{ $article->without_vat_cashless }}</strong> {{ $article->currency }} Без НДС, безнал</p>
                        @endif
                        @if($article->cash)
                            <p><strong>{{ $article->cash }}</strong> {{ $article->currency }} Наличными</p>
                        @endif
                    </div>
                </div>

                <div class="send-offer__row">
                    <div class="send-offer__col">
                        <p><strong>Ставка:</strong></p>
                    </div>
                    <div class="send-offer__col">
                        <p><strong>Дополнительно</strong></p>
                    </div>
                    <div class="send-offer__col">
                        <p><strong>Добавлено</strong></p>
                    </div>
                </div>

                @if($article->counter_offers)
                    @if($article->bids->isNotEmpty())
                        @foreach($article->bids as $bid)
                        <div class="send-offer__row">
                            <div class="send-offer__col">
                                <p>{{ $bid->with_vat_cashless }} {{ $article->currency }} С НДС, безнал</p>
                                <p>{{ $bid->without_vat_cashless }} {{ $article->currency }} Без НДС, безнал</p>
                                <p>{{ $bid->cash }} {{ $article->currency }} наличными</p>
                            </div>
                            <div class="send-offer__col">
                                <p>{{ $bid->created_at?->format('d.m.Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    @endif

                @else
                    <div class="send-offer__row">
                        <div class="send-offer__col">
                        <p>Грузовладелец скрыл встречные предложения</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="send-offer__header">
                <b>Ваше предложение</b>
            </div>
            <form action="{{ route('cargo.bids.store', [app()->getLocale(), $article->id]) }}" method="POST" id="bidForm">
                @csrf
                <div class="send-offer__card">
                    <div class="send-offer__row">
                        <div class="send-offer__col1">
                            <p><strong>Ставка:</strong></p>
                        </div>

                        <div class="send-offer__col2 send-offer__flex">
                            {{-- без торга --}}
                            @if($article->payment_type == 'no_haggling')
                            <label for="offer">
                                <select name="price" id="offer">
                                    @if($article->with_vat_cashless)
                                    <option value="{{ $article->with_vat_cashless }}">{{ $article->with_vat_cashless }} {{ $article->currency }} С НДС, безнал</option>
                                    @endif
                                    @if($article->without_vat_cashless)
                                    <option value="{{ $article->without_vat_cashless }}">{{ $article->without_vat_cashless }} {{ $article->currency }} Без НДС, безнал</option>
                                    @endif
                                    @if($article->cash)
                                    <option value="{{ $article->cash }}">{{ $article->cash }} {{ $article->currency }} наличными</option>
                                    @endif
                                </select>
                            </label>
                            <p>Ставка фиксирована и не предполагает торга</p>
                            @else
                            <label for="without_vat_cashless">
                                <input type="number" name="with_vat_cashless">
                                <p>С НДС, безнал</p>
                            </label>
                            <label for="without_vat_cashless">
                                <input type="number" name="without_vat_cashless">
                                <p>Без НДС, безнал</p>
                            </label>
                            <label for="cash">
                                <input type="number" name="cash">
                                <p>наличными</p>
                            </label>
                            @endif
                        </div>
                    </div>

                    <div class="send-offer__row">
                        <div class="send-offer__col1">
                            <p><strong>Дополнительно:</strong></p>
                        </div>
                        <div class="send-offer__col2 send-offer__flex">
                            <label for="is_prepayment" class="label-checkbox">
                                <input type="checkbox" name="is_prepayment" hidden value="0">
                                <input type="checkbox" name="is_prepayment" id="is_prepayment" value="1">
                                <span>Предоплата</span>
                            </label>
                            <label for="prepayment_percent">
                                <input type="number" name="prepayment_percent" id="prepayment_percent">
                                <span>%</span>
                            </label>
                            <label for="is_on_unloading" class="label-checkbox">
                                <input type="checkbox" name="is_on_unloading" hidden value="0">
                                <input type="checkbox" name="is_on_unloading" id="is_on_unloading" value="1">
                                <span>На выгрузке</span>
                            </label>
                            <label for="is_bank_transfer" class="label-checkbox">
                                <input type="checkbox" name="is_bank_transfer" id="is_bank_transfer" hidden value="0">
                                <input type="checkbox" name="is_bank_transfer" id="is_bank_transfer" value="1">
                                <span>Через</span>
                            </label>
                            <label for="bank_transfer_days">
                                <input type="number" name="bank_transfer_days" id="bank_transfer_days">
                                <span>банк дней</span>
                            </label>
                        </div>
                    </div>

                    <div class="send-offer__row">
                        <div class="send-offer__col1">
                            <p><strong>Комментарии:</strong></p>
                        </div>
                        <div class="send-offer__col2">
                            <label class="commtent-textarea">
                                <textarea name="payment_comment" id="payment_comment"></textarea>
                            </label>
                            <p>не более 512 символов</p>
                        </div>
                    </div>

                    <div class="send-offer__row">
                        <div class="send-offer__col1">
                            <p><strong>Дата:</strong></p>
                        </div>
                        <div class="send-offer__col2">
                            <label for="ready_date" class="label-date">
                                <input type="date" name="ready_date" id="ready_date">
                            </label>
                        </div>
                    </div>

                    <div class="send-offer__row">
                        <div class="send-offer__col1">
                            <p><strong>Контакт:</strong></p>
                        </div>

                        <div class="send-offer__col2">
                            <p>{{ auth()->user()?->full_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="send-offer__bottom">
                    <div class="send-offer__buttons">
                        <button class="form-btn">Отправить</button>
                        <a href="javascript:;" class="form-btn-gray" data-modal-close="send-offer">Закрыть</a>
                    </div>
                </div>

            </form>
            <button class="modal-close" type="button" data-modal-close="send-offer">
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</main>

<script src="https://api-maps.yandex.ru/2.1/?apikey=49817d12-35af-402e-82b9-91b83b18ac74&lang=ru_RU"></script>

<style>
    #myMap {
        width: 100%;
        height: 600px;
    }
</style>

<script>
    let urlPin = "{{ asset('assets/images/svg/map-pin.svg') }}";
    const COORDINATES = [{{ $settings->markup['coordinates']['lat'] ?? '' }}, {{ $settings->markup['coordinates']['long'] ?? '' }}];

    ymaps.ready(init);

    function init() {
        const pointA = "{{ $article->country }} {{ $article->address }}";
        const pointB = "{{ $article->final_unload_city }} {{ $article->final_unload_address }}";

        const multiRoute = new ymaps.multiRouter.MultiRoute({
            referencePoints: [pointA, pointB],
            params: { results: 1 }
        }, {
            boundsAutoApply: true
        });

        const myMap = new ymaps.Map('myMap', {
            center: [55.751244, 37.618423],
            zoom: 10,
            controls: ['zoomControl', 'trafficControl', 'typeSelector', 'rulerControl']
        });


        myMap.geoObjects.add(multiRoute);

        // Когда маршрут построен — получаем расстояние
        multiRoute.model.events.add('requestsuccess', function () {
            const activeRoute = multiRoute.getActiveRoute();
            if (activeRoute) {
                const distance = activeRoute.properties.get("distance").text;
                const duration = activeRoute.properties.get("duration").text;
                document.getElementById("distance").innerText =
                    `{{ __('Расстояние:') }} ${distance}, {{ __('Время в пути:') }} ${duration}`;
            }
        });
    }
</script>


