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
                        <span>Откуда</span>
                        <input type="text" id="from" placeholder="Напрмиер, Узбекистан" class="input-form">
                    </label>
                    <label for="to">
                        <span>Радиус</span>
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
                        <span>Куда</span>
                        <input type="text" id="from" placeholder="Например, Казахстан" class="input-form">
                    </label>
                    <label for="to">
                        <span>Радиус</span>
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

            <div class="form-search-inputs form-search-inputs-small">
                <label for="from">
                    <span>Вес,т</span>
                    <input type="number" id="from" placeholder="от" class="input-form">
                </label>
                <label for="to">
                    <input type="number" id="to" placeholder="до" class="input-form">
                </label>
            </div>

            <div class="form-search-inputs form-search-inputs-small">
                <label for="from">
                    <span>Обьем3</span>
                    <input type="number" id="from" placeholder="от" class="input-form">
                </label>
                <label for="to">
                    <input type="number" id="to" placeholder="до" class="input-form">
                </label>
            </div>
        </div>

        <div class="form-search-selects">
            <label for="sel1">
                <select name="" id="sel1" class="input-select">
                    <option value="" hidden>Дата погрузки</option>
                    <option value="">Сегодня</option>
                    <option value="">Завтра</option>
                    <option value="">Сегодня и завтра</option>
                    <option value="">Сегодня, завтра и послезавтра</option>
                    <option value="">Сегодня + 3 дня</option>
                </select>
            </label>

            <label for="sel2">
                <select name="" id="sel2" class="input-select">
                    <option value="" hidden>Тип кузова</option>
                    <option value="">Тентованный</option>
                    <option value="">Контейнер</option>
                    <option value="">Фургон</option>
                    <option value="">Цельнометалл.</option>
                    <option value="">Изотермический</option>
                    <option value="">Рефрижератор</option>
                    <option value="">Реф. мультирежимный</option>
                    <option value="">Реф. с перегородкой</option>
                    <option value="">Реф.-тушевоз</option>
                    <option value="">Бортовой</option>
                    <option value="">Открытый конт.</option>
                    <option value="">Площадка без бортов</option>
                    <option value="">Самосвал</option>
                </select>
            </label>

            <label for="sel3">
                <select name="" id="sel3" class="input-select">
                    <option value="" hidden>Наименование груза</option>
                    <option value="">Вагонка</option>
                    <option value="">Доски</option>
                    <option value="">Продукты питания</option>
                    <option value="">Стройматериалы</option>
                    <option value="">ТНП</option>
                    <option value="">Автомобиль(ли)</option>
                    <option value="">Автошины</option>
                    <option value="">Алкогольные напитки</option>
                    <option value="">Арматура</option>
                    <option value="">Балки надрессорные</option>
                    <option value="">Безалкогольные напитки</option>
                    <option value="">Боковая рама</option>
                    <option value="">Бумага</option>
                    <option value="">Бытовая техника</option>
                    <option value="">Бытовая химия</option>
                    <option value="">Вагонка</option>
                    <option value="">Газосиликатные блоки</option>
                    <option value="">Гипс</option>
                    <option value="">Гофрокартон</option>
                </select>
            </label>

            <label for="sel4">
                <select name="" id="sel4" class="input-select">
                    <option value="" hidden>Тип загрузки</option>
                    <option value="">верхняя</option>
                    <option value="">задняя</option>
                    <option value="">с с полной растентовкой</option>
                    <option value="">со снятием поперечных перекладин</option>
                    <option value="">со снятием стоек</option>
                    <option value="">без ворот</option>
                    <option value="">гидроборт</option>
                    <option value="">аппарели</option>
                    <option value="">с обрешеткой</option>
                    <option value="">с бортами</option>
                    <option value="">боковая с 2-х сторон</option>
                    <option value="">налив</option>
                    <option value="">электрический</option>
                    <option value="">гидравлический</option>
                    <option value="">пневматический</option>
                    <option value="">дизельный компрессор</option>
                    <option value="">не указан</option>
                </select>
            </label>

            <label for="sel5">
                <select name="" id="sel5" class="input-select">
                    <option value="" hidden>Оплата</option>
                    <option value="">С предоплатой</option>
                    <option value="">Без ставки</option>
                    <option value="">За наличную оплату</option>
                    <option value="">Оплата б/н с НДС</option>
                    <option value="">Оплата б/н без НДС</option>
                    <option value="">Со ставкой</option>
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

            <label for="sel7">
                <select name="" id="sel7" class="input-select">
                    <option value="" hidden>Поиск по фирмам</option>
                    <option value="">Доступно только платным участникам</option>
                </select>
            </label>
        </div>

        <div class="form-search__footer">
            <a href="#" download>
            </a>

            <button class="form-btn">Найти грузы</button>
        </div>
    </form>

    <div class="banner__mark">
        <img src="{{ asset('assets/images/0517.gif') }}" alt="" width="" height="">
    </div>

    <div class="result-goods">
        <div class="result-goods__head">
            <h1 class="title">Найдено {{ $cargoLoadings->total() }}</h1>

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
                        <span>НАПРАВЛЕНИЕ</span>
                    </th>
                    <th>ТРАНСПОРТ</th>
                    <th>ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</th>
                    <th>МАРШРУТ</th>
                    <th>СТАВКА</th>
                </tr>
                </thead>

                @foreach($cargoLoadings as $cargoLoading)
                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">НАПРАВЛЕНИЕ</p>
                        <span>{{ Str::limit($cargoLoading->country, 50) }} - {{ Str::limit($cargoLoading->final_unload_city, 50) }}</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">ТРАНСПОРТ</p>
                        <p class="car-head">
                            <strong>Кузов</strong>
                        </p>
                        <p>{{ Str::limit(implode(', ', array_slice($cargoLoading->body_types, 0, 5)), 70) }}</p>
                        @if (!empty($cargoLoading->loading_types))
                        <strong>Загрузка</strong>
                        <p>{{ Str::limit(implode(', ', array_slice($cargoLoading->loading_types, 0, 5)), 70) }}</p>
                        @endif
                        @if (!empty($cargoLoading->unloading_types))
                        <strong>Выгрузка</strong>
                        <p>{{ Str::limit(implode(', ', array_slice($cargoLoading->unloading_types, 0, 5)), 70) }}</p>
                        @endif
                    </td>
                    <td>
                        <p class="mobile-order-head">ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</p>
                        <p><strong>{{ $cargoLoading->cargo->title }}</strong></p>
                        <strong>{{ $cargoLoading->cargo->weight }} - </strong>
                        {{ $cargoLoading->cargo->weight_type }} /
                        {{ $cargoLoading->cargo->volume }} М3
                    </td>
                    <td>
                        <p class="mobile-order-head">МАРШРУТ</p>
                        <strong>{{ Str::limit($cargoLoading->country, 50) }}</strong>
                        <br>
                        <strong>{{ $cargoLoading->final_unload_city }}</strong>
                        <br><br>
                        @if($cargoLoading->cargo->constant_frequency)
                            <p><strong>{{ $cargoLoading->cargo->constant_frequency == 'daily' ? __('Ежедневно') : __('По рабочим дням') }}</strong></p>
                        @elseif($cargoLoading?->cargo?->ready_date)
                            <i><strong>{{ $cargoLoading?->cargo?->ready_date?->format('d.m.Y') }}</strong></i>
                        @else
                            <i><strong>{{ __('Груза нет, запрос ставки') }}</strong></i>
                        @endif
                    </td>
                    <td>
                        <p class="mobile-order-head">СТАВКА</p>
                        @if($cargoLoading->payment_type == 'payment_request')
                            <p class="car-head"><strong>{{ __('Запрос ставки') }}</strong></p>
                        @else
                            @if($cargoLoading->with_vat_cashless)
                                <p class="car-head"><strong>{{ $cargoLoading->with_vat_cashless }}</strong> {{ $cargoLoading->currency }} С НДС, безнал</p>
                            @endif
                            @if($cargoLoading->without_vat_cashless)
                                <p class="car-head"><strong>{{ $cargoLoading->without_vat_cashless }}</strong> {{ $cargoLoading->currency }} Без НДС, безнал</p>
                            @endif
                            @if($cargoLoading->cash)
                                <p class="car-head"><strong>{{ $cargoLoading->cash }}</strong> {{ $cargoLoading->currency }} Наличными</p>
                            @endif
                        @endif
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">{{ __('показать контакты') }}</button>

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
                                <b>Отправить сообщение</b>
                                <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" id="chatForm">
                                    @csrf
                                    <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $cargoLoading->company->user->id }}">
                                    <textarea required name="message" id="chat_text_public" rows="5" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat1">Отправить</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">Отмена</button>
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
    <img src="{{ asset('assets/images/banner_right.jpg') }}" alt="" width="" height="">
</div>