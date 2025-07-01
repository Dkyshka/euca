<section class="search-page">
    <h1 class="title">{{ $section->page->name }}</h1>

    <form action="" class="form-search">

        <div class="form-search-head">
            <div class="form-search-inputs-wrapper">
                <div class="form-search-inputs">
                    <label for="from">
                        <span>{{ __('lang.Откуда') }}</span>
                        <input type="text" id="from" placeholder="{{ __('lang.Например, Узбекистан') }}" class="input-form">
                    </label>
                    <label for="from_to">
{{--                        <span>Радиус</span>--}}
                        <input type="number" id="from_to" placeholder="{{ __('lang.КМ') }}" class="input-form">
                    </label>
                </div>
            </div>

            <svg width="23" height="23">
                <use xlink:href="#search-arrow"></use>
            </svg>

            <div class="form-search-inputs-wrapper">
                <div class="form-search-inputs">
                    <label for="where">
                        <span>{{ __('lang.Куда') }}</span>
                        <input type="text" id="where" placeholder="{{ __('lang.Например, Казахстан') }}" class="input-form">
                    </label>
                    <label for="where_to">
{{--                        <span>Радиус</span>--}}
                        <input type="number" id="where_to" placeholder="{{ __('lang.КМ') }}" class="input-form">
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
                <label for="capacity">
                    <span>{{ __('lang.Грузоподъемность') }}</span>
                    <input type="number" id="capacity" placeholder="{{ __('lang.от (т)') }}" class="input-form">
                </label>
                <label for="capacity_to">
                    <input type="number" id="capacity_to" placeholder="{{ __('lang.до (т)') }}" class="input-form">
                </label>
            </div>

            <div class="form-search-inputs form-search-inputs-small">
                <label for="volume">
                    <span>{{ __('lang.Объем') }}</span>
                    <input type="number" id="volume" placeholder="{{ __('lang.от м3') }}" class="input-form">
                </label>
                <label for="volume_to">
                    <input type="number" id="volume_to" placeholder="{{ __('lang.до м3') }}" class="input-form">
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
{{--                <svg width="15" height="20">--}}
{{--                    <use xlink:href="#download"></use>--}}
{{--                </svg>--}}
{{--                <span>Инструкция по поиску грузов</span>--}}
            </a>

            <button class="form-btn">{{ __('lang.Найти транспорт') }}</button>
        </div>
    </form>

    <div class="banner__mark">
        @if($bannerSection->status)
            <img src="{{ asset($bannerSection->picture()->orig) }}" alt="" width="" height="">
        @endif
    </div>

    <div class="result-goods">
        <div class="result-goods__head">
            <h1 class="title">{{ __('lang.Транспорт') }} ({{ $transports->count() }})</h1>

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
                    <span>{{ __('lang.НАПРАВЛ') }}</span>
                    </th>
                    <th>{{ __('lang.ТРАНСПОРТ') }}</th>
                    <th>{{ __('lang.ОБЪЕМ, М³ Д-Ш-В') }}</th>
                    <th>{{ __('lang.МАРШРУТ') }}</th>
                    <th>{{ __('lang.СТАВКА') }}</th>
                </tr>
                </thead>

                @foreach($transports as $transport)
                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.НАПРАВЛЕНИЕ') }}</p>
                        <span>{{ Str::limit($transport->country, 30) }}-{{ Str::limit($transport->final_country, 30) }}</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.ТРАНСПОРТ') }}</p>
                        <strong>{{ $transport->body_type }}</strong><br>
                        <p>{{ __('lang.Грузоподъёмность') }} - {{ $transport->capacity }} T</p>
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.ОБЪЕМ, М³ ДхШхВ') }}</p>
                        <strong>{{ $transport->volume }}  М³</strong> /
                        {{ $transport->length }} /
                        {{ $transport->width }} /
                        {{ $transport->height }}
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.МАРШРУТ') }}</p>
                        <strong>{{ $transport->country }}</strong><br> - <strong>{{ $transport->final_country }}</strong><br>
                        @if($transport->ready_date)
                        <br><i><strong>{{ __('lang.готов') }} {{ $transport->ready_date?->format('d.m.Y') }}</strong></i>
                        @else
                        <br><i><strong>{{ $transport->availability_mode == 'daily' ? __('lang.Ежедневно') : __('lang.По рабочим дням') }}</strong></i>
                        @endif
                    </td>
                    <td>
                        <p class="mobile-order-head">{{ __('lang.СТАВКА') }}</p>
                        @if($transport->payment_type == 'payment_request')
                        <span>{{ __('lang.Скрыто') }}</span>
                        @else
                            @if($transport->with_vat_cashless)
                                <p><strong>{{ $transport->with_vat_cashless }}</strong> {{ $transport->currency }} {{ __('lang.С НДС, безнал') }}</p>
                            @endif
                            @if($transport->without_vat_cashless)
                                <p><strong>{{ $transport->without_vat_cashless }}</strong> {{ $transport->currency }} {{ __('lang.Без НДС, безнал') }}</p>
                            @endif
                            @if($transport->cash)
                                <p><strong>{{ $transport->cash }}</strong> {{ $transport->currency }} {{ __('lang.Наличными') }}</p>
                            @endif
                        @endif
                        <br><br>
                        <a href="javascript:;" class="send_transport_request" data-modal-target="send-offer-{{ $transport->id }}">{{ __('lang.Отправить предложение') }}</a>
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">{{ __('lang.показать контакты') }}</button>

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
                                <b>{{ __('lang.Отправить сообщение') }}</b>
                                <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}"
                                      method="POST"
                                      enctype="multipart/form-data"
                                      class="chat-form">
                                    @csrf
                                    <input type="hidden" name="recipient_id" value="{{ $transport->user->id }}">
                                    <textarea required name="message" rows="5" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat1">{{ __('lang.Отправить') }}</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">{{ __('lang.Отмена') }}</button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>

                <div class="modal-overlay" data-modal="send-offer-{{ $transport->id }}">
                    <div class="modal modal-send-offer" style="max-height: 90vh;">
                        <div class="send-offer__header">
                            <b>{{ __('lang.Встречное предложение') }}</b>
                        </div>
                        <div class="send-offer__card">
                            <div class="send-offer__row">
                                <div class="send-offer__col1">
                                    <p><strong>{{ __('lang.Транспорт') }}:</strong></p>
                                </div>
                                <div class="send-offer__col2">
                                    <p><strong>{{ __('lang.Кузов') }}:</strong></p>
                                    <strong>{{ $transport->body_type }}</strong><br>
                                    <p>{{ __('lang.Грузоподъёмность') }} - {{ $transport->capacity }} T</p>
                                </div>
                            </div>
                            <div class="send-offer__row">
                                <div class="send-offer__col1">
                                    <p><strong>{{ __('lang.ОБЪЕМ, М³ Д-Ш-В') }}</strong></p>
                                </div>
                                <div class="send-offer__col2">
                                    <strong>{{ $transport->volume }}  М³</strong> /
                                    {{ $transport->length }} /
                                    {{ $transport->width }} /
                                    {{ $transport->height }}
                                </div>
                            </div>
                            <div class="send-offer__row">
                                <div class="send-offer__col1">
                                    <p><strong>{{ __('lang.Ставка:') }}</strong></p>
                                </div>
                                <div class="send-offer__col2">
                                    <p class="mobile-order-head">{{ __('lang.СТАВКА') }}</p>
                                    @if($transport->payment_type == 'payment_request')
                                        <p>{{ __('lang.Скрыто') }}</p>
                                    @else
                                        @if($transport->with_vat_cashless)
                                            <p><strong>{{ $transport->with_vat_cashless }}</strong> {{ $transport->currency }} {{ __('lang.С НДС, безнал') }}</p>
                                        @endif
                                        @if($transport->without_vat_cashless)
                                            <p><strong>{{ $transport->without_vat_cashless }}</strong> {{ $transport->currency }} {{ __('lang.Без НДС, безнал') }}</p>
                                        @endif
                                        @if($transport->cash)
                                            <p><strong>{{ $transport->cash }}</strong> {{ $transport->currency }} {{ __('lang.Наличными') }}</p>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="send-offer__header">
                            <b>{{ __('lang.Ваше предложение') }}</b>
                        </div>
                        <form action="{{ route('transport.counter-offer', [app()->getLocale(), $transport->id]) }}" method="POST" class="transport-request">
                            @csrf
                            <div class="send-offer__card">
                                <div class="send-offer__row">
                                    <div class="send-offer__col1">
                                        <p><strong>{{ __('lang.Груз') }}:</strong></p>
                                    </div>

                                    <div class="send-offer__col2 send-offer__flex">
                                            <label for="cargo_loading_id-{{ $transport->id }}">
                                                <select name="cargo_loading_id" id="cargo_loading_id-{{ $transport->id }}" required>
                                                    <option value="" selected>{{ __('lang.Выберете груз') }}</option>
                                                    @foreach($cargoLoadings as $item)
                                                    <option value="{{ $item->id }}">{{ $item->cargo->title }}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                    </div>
                                </div>

                                <div class="send-offer__row">
                                    <div class="send-offer__col1">
                                        <p><strong>{{ __('lang.Дополнительно:') }}</strong></p>
                                    </div>
                                    <div class="send-offer__col2 send-offer__flex">
                                        <label for="without_vat_cashless-{{ $transport->id }}">
                                            <input type="number" name="with_vat_cashless">
                                            <p>{{ __('lang.С НДС, безнал') }}</p>
                                        </label>
                                        <label for="without_vat_cashless-{{ $transport->id }}">
                                            <input type="number" name="without_vat_cashless">
                                            <p>{{ __('lang.Без НДС, безнал') }}</p>
                                        </label>
                                        <label for="cash-{{ $transport->id }}">
                                            <input type="number" name="cash">
                                            <p>{{ __('lang.наличными') }}</p>
                                        </label>
                                    </div>
                                </div>

                                <div class="send-offer__row">
                                    <div class="send-offer__col1">
                                        <p><strong>{{ __('lang.Дополнительно:') }}</strong></p>
                                    </div>
                                    <div class="send-offer__col2 send-offer__flex">
                                        <label for="is_prepayment-{{ $transport->id }}" class="label-checkbox">
                                            <input type="checkbox" name="is_prepayment" hidden value="0">
                                            <input type="checkbox" name="is_prepayment" id="is_prepayment-{{ $transport->id }}" value="1">
                                            <span>{{ __('lang.Предоплата') }}</span>
                                        </label>
                                        <label for="prepayment_percent-{{ $transport->id }}">
                                            <input type="number" name="prepayment_percent" id="prepayment_percent-{{ $transport->id }}">
                                            <span>%</span>
                                        </label>
                                        <label for="is_on_unloading-{{ $transport->id }}" class="label-checkbox">
                                            <input type="checkbox" name="is_on_unloading" hidden value="0">
                                            <input type="checkbox" name="is_on_unloading" id="is_on_unloading-{{ $transport->id }}" value="1">
                                            <span>{{ __('lang.На выгрузке') }}</span>
                                        </label>
                                        <label for="is_bank_transfer-{{ $transport->id }}" class="label-checkbox">
                                            <input type="checkbox" name="is_bank_transfer" hidden value="0">
                                            <input type="checkbox" name="is_bank_transfer" id="is_bank_transfer-{{ $transport->id }}" value="1">
                                            <span>{{ __('lang.Через') }}</span>
                                        </label>
                                        <label for="bank_transfer_days-{{ $transport->id }}">
                                            <input type="number" name="bank_transfer_days" id="bank_transfer_days-{{ $transport->id }}">
                                            <span>{{ __('lang.банк дней') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="send-offer__row">
                                    <div class="send-offer__col1">
                                        <p><strong>{{ __('lang.Комментарии:') }}</strong></p>
                                    </div>
                                    <div class="send-offer__col2">
                                        <label for="payment_comment-{{ $transport->id }}" class="commtent-textarea">
                                            <textarea name="payment_comment" id="payment_comment-{{ $transport->id }}"></textarea>
                                        </label>
                                        <p>{{ __('lang.не более 512 символов') }}</p>
                                    </div>
                                </div>

                                <div class="send-offer__row">
                                    <div class="send-offer__col1">
                                        <p><strong>{{ __('lang.Дата:') }}</strong></p>
                                    </div>
                                    <div class="send-offer__col2">
                                        <label for="ready_date-{{ $transport->id }}" class="label-date">
                                            <input type="date" name="ready_date" id="ready_date-{{ $transport->id }}">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="send-offer__bottom">
                                <div class="send-offer__buttons">
                                    <button class="form-btn">{{ __('lang.Отправить') }}</button>
                                    <a href="javascript:;" class="form-btn-gray" data-modal-close="send-offer-{{ $transport->id }}">{{ __('lang.Закрыть') }}</a>
                                </div>
                            </div>

                        </form>
                        <button class="modal-close" type="button" data-modal-close="send-offer-{{ $transport->id }}">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
                @endforeach
            </table>
        </div>
    </div>
</section>

<div class="search-page__mark">
    @if($bannerSideBar->status)
        <img src="{{ asset($bannerSideBar->picture()->orig) }}" alt="" width="" height="">
    @endif
</div>