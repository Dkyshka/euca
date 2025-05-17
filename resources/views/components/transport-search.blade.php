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
                        <input type="text" id="from" placeholder="Напрмиер, Москва" class="input-form">
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
        <img src="{{ asset('assets/images/rek.jpg') }}" alt="" width="" height="">
    </div>

    <div class="result-goods">
        <div class="result-goods__head">
            <h1 class="title">573 машины найдено</h1>
            <div class="result-pagination">
                <button type="button">
                    <svg width="14" height="7">
                        <use xlink:href="#pag-left"></use>
                    </svg>
                </button>

                <a class="current" href="#" aria-label="следущая странница">1</a>
                <a href="#" aria-label="следущая странница">2</a>
                <a href="#" aria-label="следущая странница">3</a>
                <a href="#" aria-label="следущая странница">4</a>
                <a href="#" aria-label="следущая странница">5</a>
                <span>из 11</span>
                <button type="button">
                    <svg width="14" height="7">
                        <use xlink:href="#pag-right"></use>
                    </svg>
                </button>
            </div>
        </div>

        <div class="resilts-goods__cards">
            <table class="result-goods__card">
                <thead>
                <tr>
                    <th>
                        <label class="label-table">
                            <input type="checkbox">
                            <span>НАПРАВЛ</span>
                        </label>
                    </th>
                    <th>ТРАНСПОРТ</th>
                    <th>ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</th>
                    <th>МАРШРУТ</th>
                    <th>СТАВКА</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">НАПРАВЛЕНИЕ</p>
                        <label class="label-table">
                            <input type="checkbox">
                            <span>UZB-TKM</span>
                        </label>
                        <br><span class="color-greed-table">1295 км</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">ТРАНСПОРТ</p>
                        <strong>негаб.</strong><br><span>загрузка/выгр</span> верх.<br>отд. машина
                    </td>
                    <td>
                        <p class="mobile-order-head">ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</p>
                        <strong>63</strong> / - ТНП
                    </td>
                    <td>
                        <p class="mobile-order-head">МАРШРУТ</p>
                        <strong>Каракуль</strong><br><span>Бухарская область</span><br><i><strong>готов 13-17 января</strong></i>
                    </td>
                    <td>
                        <p class="mobile-order-head">СТАВКА</p>
                        <span>Скрыто</span>
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">показать контакты и справку</button>

                        <div class="show-info-contacts">
                            <p>Самком-Логистика, ООО</p>
                            <p>
                                <a href="tel:+7777777777">+7 777 77 77 77</a>
                                Алина Богомолова
                            </p>
                        </div>
                    </th>
                    <th>
                        <p>доступно бесплатно после первой регистраци</p>
                    </th>

                    <th></th>
                    <th></th>

                    <th class="table-footer__buttons">
                        <div class="order-icons">
                            <button class="chat-message" data-modal-target="dropdown-chat1">
                                <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                            </button>

{{--                            <button class="chat-message" data-modal-target="dropdown-close">--}}
{{--                                <img src="{{ asset('assets/images/svg/order-close.svg') }}" alt="meassge" width="30" height="30">--}}
{{--                            </button>--}}

                            <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat1">
                                <button class="order-close-btn" data-modal-close="dropdown-chat1"></button>
                                <div class="tr">
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                    </svg>
                                </div>
                                <b>Отправить сообщение</b>
                                <form action="" method="">
                                    <textarea name="" id="" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat1">Отправить</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">
                                        Не отклонять
                                    </button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>

                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">НАПРАВЛЕНИЕ</p>
                        <label class="label-table">
                            <input type="checkbox">
                            <span>UZB-TKM</span>
                        </label>
                        <br><span class="color-greed-table">1295 км</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">ТРАНСПОРТ</p>
                        <strong>негаб.</strong><br><span>загрузка/выгр</span> верх.<br>отд. машина
                    </td>
                    <td>
                        <p class="mobile-order-head">ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</p>
                        <strong>63</strong> / - ТНП
                    </td>
                    <td>
                        <p class="mobile-order-head">МАРШРУТ</p>
                        <strong>Каракуль</strong><br><span>Бухарская область</span><br><i><strong>готов 13-17 января</strong></i>
                    </td>
                    <td>
                        <p class="mobile-order-head">СТАВКА</p>
                        <span>Скрыто</span>
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">показать контакты и справку</button>

                        <div class="show-info-contacts">
                            <p>Самком-Логистика, ООО</p>
                            <p>
                                <a href="tel:+7777777777">+7 777 77 77 77</a>
                                Алина Богомолова
                            </p>
                        </div>
                    </th>
                    <th>
                        <p>доступно бесплатно после первой регистраци</p>
                    </th>

                    <th></th>
                    <th></th>

                    <th class="table-footer__buttons">
                        <div class="order-icons">
                            <button class="chat-message" data-modal-target="dropdown-chat2">
                                <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                            </button>


{{--                            <button class="chat-message" data-modal-target="dropdown-close">--}}
{{--                                <img src="{{ asset('assets/images/svg/order-close.svg') }}" alt="meassge" width="30" height="30">--}}
{{--                            </button>--}}

                            <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat2">
                                <button class="order-close-btn" data-modal-close="dropdown-chat2"></button>
                                <div class="tr">
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                    </svg>
                                </div>
                                <b>Отправить сообщение</b>
                                <form action="" method="">
                                    <textarea name="" id="" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat2">Отправить</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat2">
                                        Не отклонять
                                    </button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>

                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">НАПРАВЛЕНИЕ</p>
                        <label class="label-table">
                            <input type="checkbox">
                            <span>UZB-TKM</span>
                        </label>
                        <br><span class="color-greed-table">1295 км</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">ТРАНСПОРТ</p>
                        <strong>негаб.</strong><br><span>загрузка/выгр</span> верх.<br>отд. машина
                    </td>
                    <td>
                        <p class="mobile-order-head">ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</p>
                        <strong>63</strong> / - ТНП
                    </td>
                    <td>
                        <p class="mobile-order-head">МАРШРУТ</p>
                        <strong>Каракуль</strong><br><span>Бухарская область</span><br><i><strong>готов 13-17 января</strong></i>
                    </td>
                    <td>
                        <p class="mobile-order-head">СТАВКА</p>
                        <span>Скрыто</span>
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">показать контакты и справку</button>

                        <div class="show-info-contacts">
                            <p>Самком-Логистика, ООО</p>
                            <p>
                                <a href="tel:+7777777777">+7 777 77 77 77</a>
                                Алина Богомолова
                            </p>
                        </div>
                    </th>
                    <th>
                        <p>доступно бесплатно после первой регистраци</p>
                    </th>

                    <th></th>
                    <th></th>

                    <th class="table-footer__buttons">
                        <div class="order-icons">
                            <button class="chat-message" data-modal-target="dropdown-chat2">
                                <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                            </button>

{{--                            <button class="chat-message" data-modal-target="dropdown-close">--}}
{{--                                <img src="{{ asset('assets/images/svg/order-close.svg') }}" alt="meassge" width="30" height="30">--}}
{{--                            </button>--}}

                            <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat3">
                                <button class="order-close-btn" data-modal-close="dropdown-chat3"></button>
                                <div class="tr">
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                    </svg>
                                </div>
                                <b>Отправить сообщение</b>
                                <form action="" method="">
                                    <textarea name="" id="" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat3">Отправить</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat3">
                                        Не отклонять
                                    </button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>

                <tbody>
                <tr>
                    <td>
                        <p class="mobile-order-head">НАПРАВЛЕНИЕ</p>
                        <label class="label-table">
                            <input type="checkbox">
                            <span>UZB-TKM</span>
                        </label>
                        <br><span class="color-greed-table">1295 км</span>
                    </td>
                    <td>
                        <p class="mobile-order-head">ТРАНСПОРТ</p>
                        <strong>негаб.</strong><br><span>загрузка/выгр</span> верх.<br>отд. машина
                    </td>
                    <td>
                        <p class="mobile-order-head">ВЕС, Т/ ОБЪЕМ, М³ ГРУЗ</p>
                        <strong>63</strong> / - ТНП
                    </td>
                    <td>
                        <p class="mobile-order-head">МАРШРУТ</p>
                        <strong>Каракуль</strong><br><span>Бухарская область</span><br><i><strong>готов 13-17 января</strong></i>
                    </td>
                    <td>
                        <p class="mobile-order-head">СТАВКА</p>
                        <span>Скрыто</span>
                    </td>
                </tr>
                <tr class="table-footer">
                    <th class="row-flex">
                        <button type="button" class="show-contacts_btn">показать контакты и справку</button>

                        <div class="show-info-contacts">
                            <p>Самком-Логистика, ООО</p>
                            <p>
                                <a href="tel:+7777777777">+7 777 77 77 77</a>
                                Алина Богомолова
                            </p>
                        </div>
                    </th>
                    <th>
                        <p>доступно бесплатно после первой регистраци</p>
                    </th>

                    <th></th>
                    <th></th>

                    <th class="table-footer__buttons">
                        <div class="order-icons">
                            <button class="chat-message" data-modal-target="dropdown-chat2">
                                <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                            </button>

{{--                            <button class="chat-message" data-modal-target="dropdown-close">--}}
{{--                                <img src="{{ asset('assets/images/svg/order-close.svg') }}" alt="meassge" width="30" height="30">--}}
{{--                            </button>--}}

                            <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat4">
                                <button class="order-close-btn" data-modal-close="dropdown-chat4"></button>
                                <div class="tr">
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                    </svg>
                                </div>
                                <b>Отправить сообщение</b>
                                <form action="" method="">
                                    <textarea name="" id="" style="height: auto; overflow: hidden"></textarea>

                                    <button class="form-btn" data-modal-close="dropdown-chat4">Отправить</button>
                                    <button type="button" class="order-cansel" data-modal-close="dropdown-chat4">
                                        Не отклонять
                                    </button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="search-page__mark">
    <img src="{{ asset('assets/images/about-info.jpg') }}" alt="" width="" height="">
</div>