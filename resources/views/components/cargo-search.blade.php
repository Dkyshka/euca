<section class="search-page">
    <h1 class="title">{{ $section->page->name }}</h1>

    <form action="" method class="form-search">
{{--        <div class="form-search-row">--}}
{{--            <label for="point" class="input-check-red">--}}
{{--                <input type="checkbox" id="point">--}}
{{--                <span>Искать грузы в “эллипсе” маршрута</span>--}}
{{--            </label>--}}
{{--            <label for="length" class="input-check-red">--}}
{{--                <input type="checkbox" id="length">--}}
{{--                <span>Длина маршрута</span>--}}
{{--            </label>--}}
{{--        </div>--}}

        <div class="form-search-head">
            <div class="form-search-inputs-wrapper">
                <div class="form-search-inputs">
                    <label for="from">
                        <span>{{ __('lang.Откуда') }}</span>
                        <input type="text" id="from" placeholder="{{ __('lang.Например, Узбекистан') }}" class="input-form">
                    </label>
                    <label for="to">
{{--                        <span>Радиус</span>--}}
                        <input type="number" id="to" placeholder="КМ" class="input-form">
                    </label>
                </div>
{{--                <div class="form-search-inputs__bottom">--}}
{{--                    <select name="" id="">--}}
{{--                        <option value="" hidden>Выбрать список</option>--}}
{{--                        <option value="">список 1</option>--}}
{{--                        <option value="">список 2</option>--}}
{{--                    </select>--}}

{{--                    <label for="goods" class="input-check-red">--}}
{{--                        <input type="checkbox" id="goods">--}}
{{--                        <span>точно по Загрузке</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>

            <svg width="23" height="23">
                <use xlink:href="#search-arrow"></use>
            </svg>

            <div class="form-search-inputs-wrapper">
                <div class="form-search-inputs">
                    <label for="from">
                        <span>{{ __('lang.Куда') }}</span>
                        <input type="text" id="from" placeholder="{{ __('lang.Например, Казахстан') }}" class="input-form">
                    </label>
                    <label for="to">
{{--                        <span>Радиус</span>--}}
                        <input type="number" id="to" placeholder="{{ __('lang.КМ') }}" class="input-form">
                    </label>
                </div>
{{--                <div class="form-search-inputs__bottom">--}}
{{--                    <select name="" id="">--}}
{{--                        <option value="" hidden>Выбрать список</option>--}}
{{--                        <option value="">список 1</option>--}}
{{--                        <option value="">список 2</option>--}}
{{--                    </select>--}}

{{--                    <label for="goods" class="input-check-red">--}}
{{--                        <input type="checkbox" id="goods">--}}
{{--                        <span>точно по Загрузке</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>

            <div class="form-search-inputs form-search-inputs-small">
                <label for="from">
                    <span>{{ __('lang.Вес,т') }}</span>
                    <input type="number" id="from" placeholder="{{ __('lang.от') }}" class="input-form">
                </label>
                <label for="to">
                    <input type="number" id="to" placeholder="{{ __('lang.до') }}" class="input-form">
                </label>
            </div>

            <div class="form-search-inputs form-search-inputs-small">
                <label for="from">
                    <span>{{ __('lang.Объем3') }}</span>
                    <input type="number" id="from" placeholder="{{ __('lang.от') }}" class="input-form">
                </label>
                <label for="to">
                    <input type="number" id="to" placeholder="{{ __('lang.до') }}" class="input-form">
                </label>
            </div>
        </div>

        <div class="form-search-selects">
            <label for="sel1">
                <select name="" id="sel1" class="input-select">
                    <option value="" hidden>{{ __('lang.Дата погрузки') }}</option>
                    <option value="">{{ __('lang.Сегодня') }}</option>
                    <option value="">{{ __('lang.Завтра') }}</option>
                    <option value="">{{ __('lang.Сегодня и завтра') }}</option>
                    <option value="">{{ __('lang.Сегодня, завтра и послезавтра') }}</option>
                    <option value="">{{ __('lang.Сегодня + 3 дня') }}</option>
                </select>
            </label>

            <label for="sel2">
                <select name="" id="sel2" class="input-select">
                    <option value="" hidden>{{ __('lang.Тип кузова') }}</option>
                    <option value="">{{ __('lang.Тентованный') }}</option>
                    <option value="">{{ __('lang.Контейнер') }}</option>
                    <option value="">{{ __('lang.Фургон') }}</option>
                    <option value="">{{ __('lang.Цельнометалл.') }}</option>
                    <option value="">{{ __('lang.Изотермический') }}</option>
                    <option value="">{{ __('lang.Рефрижератор') }}</option>
                    <option value="">{{ __('lang.Реф. мультирежимный') }}</option>
                    <option value="">{{ __('lang.Реф. с перегородкой') }}</option>
                    <option value="">{{ __('lang.Реф.-тушевоз') }}</option>
                    <option value="">{{ __('lang.Бортовой') }}</option>
                    <option value="">{{ __('lang.Открытый конт.') }}</option>
                    <option value="">{{ __('lang.Площадка без бортов') }}</option>
                    <option value="">{{ __('lang.Самосвал') }}</option>
                </select>
            </label>

            <label for="sel3">
                <select name="" id="sel3" class="input-select">
                    <option value="" hidden>{{ __('lang.Наименование груза') }}</option>
                    <option value="">{{ __('lang.Вагонка') }}</option>
                    <option value="">{{ __('lang.Доски') }}</option>
                    <option value="">{{ __('lang.Продукты питания') }}</option>
                    <option value="">{{ __('lang.Стройматериалы') }}</option>
                    <option value="">{{ __('lang.ТНП') }}</option>
                    <option value="">{{ __('lang.Автомобиль(ли)') }}</option>
                    <option value="">{{ __('lang.Автошины') }}</option>
                    <option value="">{{ __('lang.Алкогольные напитки') }}</option>
                    <option value="">{{ __('lang.Арматура') }}</option>
                    <option value="">{{ __('lang.Балки надрессорные') }}</option>
                    <option value="">{{ __('lang.Безалкогольные напитки') }}</option>
                    <option value="">{{ __('lang.Боковая рама') }}</option>
                    <option value="">{{ __('lang.Бумага') }}</option>
                    <option value="">{{ __('lang.Бытовая техника') }}</option>
                    <option value="">{{ __('lang.Бытовая химия') }}</option>
                    <option value="">{{ __('lang.Вагонка') }}</option>
                    <option value="">{{ __('lang.Газосиликатные блоки') }}</option>
                    <option value="">{{ __('lang.Гипс') }}</option>
                    <option value="">{{ __('lang.Гофрокартон') }}</option>
                </select>
            </label>

            <label for="sel4">
                <select name="" id="sel4" class="input-select">
                    <option value="" hidden>{{ __('lang.Тип загрузки') }}</option>
                    <option value="">{{ __('lang.верхняя') }}</option>
                    <option value="">{{ __('lang.задняя') }}</option>
                    <option value="">{{ __('lang.с полной растентовкой') }}</option>
                    <option value="">{{ __('lang.со снятием поперечных перекладин') }}</option>
                    <option value="">{{ __('lang.со снятием стоек') }}</option>
                    <option value="">{{ __('lang.без ворот') }}</option>
                    <option value="">{{ __('lang.гидроборт') }}</option>
                    <option value="">{{ __('lang.аппарели') }}</option>
                    <option value="">{{ __('lang.с обрешеткой') }}</option>
                    <option value="">{{ __('lang.с бортами') }}</option>
                    <option value="">{{ __('lang.боковая с 2-х сторон') }}</option>
                    <option value="">{{ __('lang.налив') }}</option>
                    <option value="">{{ __('lang.электрический') }}</option>
                    <option value="">{{ __('lang.гидравлический') }}</option>
                    <option value="">{{ __('lang.пневматический') }}</option>
                    <option value="">{{ __('lang.дизельный компрессор') }}</option>
                    <option value="">{{ __('lang.не указан') }}</option>
                </select>
            </label>

            <label for="sel5">
                <select name="" id="sel5" class="input-select">
                    <option value="" hidden>{{ __('lang.Оплата') }}</option>
                    <option value="">{{ __('lang.С предоплатой') }}</option>
                    <option value="">{{ __('lang.Без ставки') }}</option>
                    <option value="">{{ __('lang.За наличную оплату') }}</option>
                    <option value="">{{ __('lang.Оплата б/н с НДС') }}</option>
                    <option value="">{{ __('lang.Оплата б/н без НДС') }}</option>
                    <option value="">{{ __('lang.Со ставкой') }}</option>
                </select>
            </label>

{{--            <label for="sel6">--}}
{{--                <select name="" id="sel6" class="input-select">--}}
{{--                    <option value="" hidden>Доп. параметры</option>--}}
{{--                    <option value="">С кониками</option>--}}
{{--                    <option value="">Только кругорейс</option>--}}
{{--                    <option value="">Скрыть «постоянные»</option>--}}
{{--                    <option value="">Скрыть тендеры</option>--}}
{{--                    <option value="">Скрыть с экипажем (2 водителя)</option>--}}
{{--                    <option value="">Опасные грузы (ADR)</option>--}}
{{--                </select>--}}
{{--            </label>--}}

{{--            <label for="sel7">--}}
{{--                <select name="" id="sel7" class="input-select">--}}
{{--                    <option value="" hidden>Габариты и догруз</option>--}}
{{--                    <option value="">Неважно</option>--}}
{{--                    <option value="">Только догруз</option>--}}
{{--                    <option value="">Отдельная машина</option>--}}
{{--                </select>--}}
{{--            </label>--}}

{{--            <label for="sel7">--}}
{{--                <select name="" id="sel7" class="input-select">--}}
{{--                    <option value="" hidden>Поиск по фирмам</option>--}}
{{--                    <option value="">Доступно только платным участникам</option>--}}
{{--                </select>--}}
{{--            </label>--}}
        </div>

        <div class="form-search__footer">
            <a href="#" download>
            </a>

            <button class="form-btn">{{ __('lang.Найти грузы') }}</button>
        </div>
    </form>

    <div class="banner__mark">
        @if($bannerSection->status)
            @if($bannerSection->link)
                <a href="{{ $bannerSection->link }}" target="_blank">
                    <img src="{{ asset($bannerSection->picture()->orig) }}" alt="" width="" height="">
                </a>
            @else
                <img src="{{ asset($bannerSection->picture()->orig) }}" alt="" width="" height="">
            @endif
        @endif
    </div>

    <div class="result-goods">
        <div class="result-goods__head">
            <h1 class="title">{{ __('lang.Найдено') }} {{ $cargoLoadings->total() }}</h1>

            @if ($cargoLoadings->hasPages())
                <div class="result-pagination">
                    {{-- Кнопка "Назад" --}}
                    @if ($cargoLoadings->onFirstPage())
                        <button type="button" disabled>
                            <svg width="14" height="7"><use xlink:href="#pag-left"></use></svg>
                        </button>
                    @else
                        <a href="{{ $cargoLoadings->previousPageUrl() }}" aria-label="предыдущая страница">
                            <svg width="14" height="7"><use xlink:href="#pag-left"></use></svg>
                        </a>
                    @endif

                    {{-- Номера страниц --}}
                    @foreach ($cargoLoadings->getUrlRange(1, $cargoLoadings->lastPage()) as $page => $url)
                        @if ($page == $cargoLoadings->currentPage())
                            <a class="current" href="#" aria-label="текущая страница">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" aria-label="страница {{ $page }}">{{ $page }}</a>
                        @endif
                        @if ($page == 5 && $cargoLoadings->lastPage() > 6)
                            <span>из {{ $cargoLoadings->lastPage() }}</span>
                            @break
                        @endif
                    @endforeach

                    {{-- Кнопка "Вперёд" --}}
                    @if ($cargoLoadings->hasMorePages())
                        <a href="{{ $cargoLoadings->nextPageUrl() }}" aria-label="следующая страница">
                            <svg width="14" height="7"><use xlink:href="#pag-right"></use></svg>
                        </a>
                    @else
                        <button type="button" disabled>
                            <svg width="14" height="7"><use xlink:href="#pag-right"></use></svg>
                        </button>
                    @endif
                </div>
            @endif
        </div>


        <div class="resilts-goods__cards">
            <table class="result-goods__card">
                <thead>
                <tr>
                    <th>
                        <span>{{ __('lang.НАПРАВЛЕНИЕ') }}</span>
                    </th>
                    <th>{{ __('lang.ТРАНСПОРТ') }}</th>
                    <th>{{ __('lang.ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ') }}</th>
                    <th>{{ __('lang.МАРШРУТ') }}</th>
                    <th>{{ __('lang.СТАВКА') }}</th>
                </tr>
                </thead>

                @foreach($cargoLoadings as $cargoLoading)
                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.НАПРАВЛЕНИЕ') }}</p>
                        <span>{{ Str::limit(app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->country), 255) }} - {{ Str::limit(app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->final_unload_city), 255) }}</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.ТРАНСПОРТ') }}</p>
                        <p class="car-head">
                            <strong>{{ __('lang.Кузов') }}</strong>
                        </p>
                        <p>{{ Str::limit(app('google.translator')->setTarget(app()->getLocale())->translate(implode(', ', array_slice($cargoLoading->body_types, 0, 5))), 70) }}</p>
                        @if (!empty($cargoLoading->loading_types))
                        <strong>{{ __('lang.Загрузка') }}</strong>
                        <p>{{ Str::limit(app('google.translator')->setTarget(app()->getLocale())->translate(implode(', ', array_slice($cargoLoading->loading_types, 0, 5))), 70) }}</p>
                        @endif
                        @if (!empty($cargoLoading->unloading_types))
                        <strong>{{ __('lang.Выгрузка') }}</strong>
                        <p>{{ Str::limit(app('google.translator')->setTarget(app()->getLocale())->translate(implode(', ', array_slice($cargoLoading->unloading_types, 0, 5))), 70) }}</p>
                        @endif
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ') }}</p>
                        <p><strong>{{ app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->cargo->title) }}</strong></p>
                        <strong>{{ $cargoLoading->cargo->weight }} - </strong>
                        {{ $cargoLoading->cargo->weight_type }} /
                        {{ $cargoLoading->cargo->volume }} М3
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.МАРШРУТ') }}</p>
                        <strong>{{ Str::limit(app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->country), 50) }}</strong>
                        <br>
                        <strong>{{ app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->final_unload_city) }}</strong>
                        <br><br>
                        @if($cargoLoading->cargo->constant_frequency)
                            <p><strong>{{ $cargoLoading->cargo->constant_frequency == 'daily' ? __('lang.Ежедневно') : __('lang.По рабочим дням') }}</strong></p>
                        @elseif($cargoLoading?->cargo?->ready_date)
                            <i><strong>{{ $cargoLoading?->cargo?->ready_date?->format('d.m.Y') }}</strong></i>
                        @else
                            <i><strong>{{ __('lang.Груза нет, запрос ставки') }}</strong></i>
                        @endif
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.СТАВКА') }}</p>
                        @if($cargoLoading->payment_type == 'payment_request')
                            <p class="car-head"><strong>{{ __('lang.Запрос ставки') }}</strong></p>
                        @else
                            @if($cargoLoading->with_vat_cashless)
                                <p class="car-head"><strong>{{ $cargoLoading->with_vat_cashless }}</strong> {{ app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->currency) }} {{ __('lang.С НДС, безнал') }}</p>
                            @endif
                            @if($cargoLoading->without_vat_cashless)
                                <p class="car-head"><strong>{{ $cargoLoading->without_vat_cashless }}</strong> {{ app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->currency) }} {{ __('lang.Без НДС, безнал') }}</p>
                            @endif
                            @if($cargoLoading->cash)
                                <p class="car-head"><strong>{{ $cargoLoading->cash }}</strong> {{ app('google.translator')->setTarget(app()->getLocale())->translate($cargoLoading->currency) }} {{ __('lang.Наличными') }}</p>
                            @endif
                        @endif
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">{{ __('lang.показать контакты') }}</button>

                        <div class="show-info-contacts">
                            <p>{{ $cargoLoading->company->name }}</p>
                            <p>
                                @foreach($cargoLoading->company->phones as $item)
                                <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $item->phone) }}">{{ $item->phone }}</a>
                                @endforeach
                                {{ $cargoLoading->company?->user?->full_name }}
                            </p>
                        </div>
                    </th>
                    <th>
                    </th>

                    <th></th>
                    <th></th>

                    <th class="table-footer__buttons">
                        <div class="order-icons">
                            <button class="chat-message" data-modal-target="dropdown-chat-{{ $cargoLoading->id }}">
                                <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                            </button>

                            <a href="{{ $section->page->link . '/cargo-inner/' . $cargoLoading->id }}" class="chat-message info-goods">
                                <img src="{{ asset('assets/images/svg/goods-info.svg') }}" alt="info" width="30" height="30">
                            </a>

{{--                            <button class="chat-message" data-modal-target="dropdown-close">--}}
{{--                                <img src="{{ asset('assets/images/svg/order-close.svg') }}" alt="meassge" width="30" height="30">--}}
{{--                            </button>--}}

                            <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat-{{ $cargoLoading->id }}">
                                <button class="order-close-btn" data-modal-close="dropdown-chat-{{ $cargoLoading->id }}"></button>
                                <div class="tr">
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                    </svg>
                                </div>
                                <b>{{ __('lang.Отправить сообщение') }}</b>
                                <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" class="chat-form">
                                    @csrf
                                    <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $cargoLoading->company->user->id }}">
                                    <textarea required name="message" rows="5" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat1">{{ __('lang.Отправить') }}</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">{{ __('lang.Отмена') }}</button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>

                @endforeach
            </table>
        </div>
    </div>
</section>

<div class="search-page__mark">
    @if($bannerSideBar->status)
        @if($bannerSideBar->link)
            <a href="{{ $bannerSideBar->link }}" target="_blank">
                <img src="{{ asset($bannerSideBar->picture()->orig) }}" alt="" width="" height="">
            </a>
        @else
            <img src="{{ asset($bannerSideBar->picture()->orig) }}" alt="" width="" height="">
        @endif
    @endif
</div>