<section class="search-page">
    <h1 class="title">{{ $section->page->name }}</h1>

    <form action="" method class="form-search">

        <div class="form-search-head">
            <div class="form-search-inputs-wrapper">
                <div class="form-search-inputs">
                    <label for="from">
                        <span>Откуда</span>
                        <input type="text" id="from" placeholder="Напрмиер, Москва" class="input-form">
                    </label>
                    <label for="to">
                        <span>Радиус</span>
                        <input type="number" id="to" placeholder="КМ" class="input-form">
                    </label>
                </div>
            </div>

            <svg width="23" height="23">
                <use xlink:href="#search-arrow"></use>
            </svg>

            <div class="form-search-inputs-wrapper">
                <div class="form-search-inputs">
                    <label for="from">
                        <span>Куда</span>
                        <input type="text" id="from" placeholder="Напрмиер, Санкт-Петербург" class="input-form">
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

{{--                    <label for="goods-2" class="input-check-red">--}}
{{--                        <input type="checkbox" id="goods-2">--}}
{{--                        <span>точно по Разгрузке</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>

            <div class="form-search-inputs form-search-inputs-small">
                <label for="from">
                    <span>Грузоподъемность</span>
                    <input type="number" id="from" placeholder="от (т)" class="input-form">
                </label>
                <label for="to">
                    <input type="number" id="to" placeholder="до (т)" class="input-form">
                </label>
            </div>

            <div class="form-search-inputs form-search-inputs-small">
                <label for="from">
                    <span>Объем</span>
                    <input type="number" id="from" placeholder="от м3" class="input-form">
                </label>
                <label for="to">
                    <input type="number" id="to" placeholder="до м3" class="input-form">
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

            <label for="sel4">
                <select name="" id="sel4" class="input-select">
                    <option value="" hidden>Тип загрузки</option>
                    <option value="">Верхняя</option>
                    <option value="">Боковая</option>
                    <option value="">Задняя</option>
                    <option value="">С полной растентовкой</option>
                    <option value="">Со снятием поперечных перекладин</option>
                    <option value="">Со снятием стоек</option>
                    <option value="">Без ворот</option>
                    <option value="">Гидроборт</option>
                    <option value="">Аппарели</option>
                    <option value="">Электрический</option>
                    <option value="">Гидравлический</option>
                </select>
            </label>

            <label for="sel5">
                <select name="" id="sel5" class="input-select">
                    <option value="" hidden>Оплата</option>
                    <option value="">За наличную оплату</option>
                    <option value="">б/нал c НДС</option>
                    <option value="">б/нал без НДС</option>
                </select>
            </label>

            <label for="sel6">
                <select name="" id="sel6" class="input-select">
                    <option value="" hidden>Доп. параметры</option>
                    <option value="">Гидролифт</option>
                    <option value="">С кониками</option>
                    <option value="">Не показывать «постоянные»</option>
                </select>
            </label>

            <label for="sel7">
                <select name="" id="sel7" class="input-select">
                    <option value="" hidden>Габариты и догруз</option>
                    <option value="">Неважно</option>
                    <option value="">Только догруз</option>
                    <option value="">Отдельная машина</option>
                </select>
            </label>

            <label for="sel7">
                <select name="" id="sel7" class="input-select">
                    <option value="" hidden>Поиск по фирмам</option>
                    <option value="">Доступно только платным участникам</option>
                </select>
            </label>
        </div>

        <div class="form-search__footer">
            <a href="#" download>
{{--                <svg width="15" height="20">--}}
{{--                    <use xlink:href="#download"></use>--}}
{{--                </svg>--}}
{{--                <span>Инструкция по поиску грузов</span>--}}
            </a>

            <button class="form-btn">Найти транспорт</button>
        </div>
    </form>

    <div class="banner__mark">
        <img src="{{ asset('assets/images/0517.gif') }}" alt="" width="" height="">
    </div>

    <div class="result-goods">
        <div class="result-goods__head">
            <h1 class="title">Транспорт ({{ $transports->count() }})</h1>

            @if ($transports->hasPages())
                <div class="result-pagination">
                    {{-- Кнопка "Назад" --}}
                    @if ($transports->onFirstPage())
                        <button type="button" disabled>
                            <svg width="14" height="7"><use xlink:href="#pag-left"></use></svg>
                        </button>
                    @else
                        <a href="{{ $transports->previousPageUrl() }}" aria-label="предыдущая страница">
                            <svg width="14" height="7"><use xlink:href="#pag-left"></use></svg>
                        </a>
                    @endif

                    {{-- Номера страниц --}}
                    @foreach ($transports->getUrlRange(1, $transports->lastPage()) as $page => $url)
                        @if ($page == $transports->currentPage())
                            <a class="current" href="#" aria-label="текущая страница">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" aria-label="страница {{ $page }}">{{ $page }}</a>
                        @endif
                        @if ($page == 5 && $transports->lastPage() > 6)
                            <span>из {{ $transports->lastPage() }}</span>
                            @break
                        @endif
                    @endforeach

                    {{-- Кнопка "Вперёд" --}}
                    @if ($transports->hasMorePages())
                        <a href="{{ $transports->nextPageUrl() }}" aria-label="следующая страница">
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
                    <span>НАПРАВЛ</span>
                    </th>
                    <th>ТРАНСПОРТ</th>
                    <th>ОБЪЕМ, М³ Д-Ш-В</th>
                    <th>МАРШРУТ</th>
                    <th>СТАВКА</th>
                </tr>
                </thead>

                @foreach($transports as $transport)
                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">НАПРАВЛЕНИЕ</p>
                        <span>UZB-TKM</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">ТРАНСПОРТ</p>
                        <strong>{{ $transport->body_type }}</strong><br>
                        <p>Грузоподъёмность - {{ $transport->capacity }} T</p>
                    </td>
                    <td>
                        <p class="mobile-order-head">ОБЪЕМ, М³ ДхШхВ</p>
                        <strong>{{ $transport->volume }}  М³</strong> /
                        {{ $transport->length }} /
                        {{ $transport->width }} /
                        {{ $transport->height }}
                    </td>
                    <td>
                        <p class="mobile-order-head">МАРШРУТ</p>
                        <strong>{{ $transport->country }}</strong><br> - <strong>{{ $transport->final_country }}</strong><br>
                        <br><i><strong>готов {{ $transport->ready_date?->format('d.m.Y') }}</strong></i>
                    </td>
                    <td>
                        <p class="mobile-order-head">СТАВКА</p>
                        @if($transport->payment_type == 'payment_request')
                        <span>Скрыто</span>
                        @else
                            @if($transport->with_vat_cashless)
                                <p><strong>{{ $transport->with_vat_cashless }}</strong> {{ $transport->currency }} С НДС, безнал</p>
                            @endif
                            @if($transport->without_vat_cashless)
                                <p><strong>{{ $transport->without_vat_cashless }}</strong> {{ $transport->currency }} Без НДС, безнал</p>
                            @endif
                            @if($transport->cash)
                                <p><strong>{{ $article->cash }}</strong> {{ $transport->currency }} Наличными</p>
                            @endif
                        @endif
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">показать контакты</button>

                        <div class="show-info-contacts">
                            @if($transport->user?->company?->name)
                            <p>{{ $transport->user?->company?->name }}</p>
                            @else
                            <p>{{ $transport->user?->full_name }}</p>
                            @endif
                            <p>
                                @if($transport->user?->company?->phones)
                                    @foreach($transport->user->company->phones as $item)
                                        <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $item->phone) }}">{{ $item->phone }}</a>
                                    @endforeach
                                @else
                                    <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $transport->user->phone) }}">{{ $transport->user->phone }}</a>
                                @endif
                            </p>
                        </div>
                    </th>
                    <th>
{{--                        <p>доступно бесплатно после первой регистраци</p>--}}
                    </th>

                    <th></th>
                    <th></th>

                    <th class="table-footer__buttons">
                        <div class="order-icons">
                            <button class="chat-message" data-modal-target="dropdown-chat1">
                                <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                            </button>

                            <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat1">
                                <button class="order-close-btn" data-modal-close="dropdown-chat1"></button>
                                <div class="tr">
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                    </svg>
                                </div>
                                <b>Отправить сообщение</b>
                                <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" id="chatForm">
                                    @csrf
                                    <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $transport->user->id }}">
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