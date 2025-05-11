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
                    <form class="form-order">
                        <label for="all" class="search-icon">
                            <svg width="12" height="16">
                                <use xlink:href="#search-icon"></use>
                            </svg>
                            <input type="text" id="all" placeholder="Все подразделения" name="all">
                        </label>

                        <label for="name">
                            <select name="name" id="name">
                                <option value="" hidden>Имя</option>
                                <option value="">Имя1</option>
                                <option value="">Имя2</option>
                                <option value="">Имя3</option>
                            </select>
                        </label>

                        <label for="from">
                            <svg width="12" height="16">
                                <use xlink:href="#map"></use>
                            </svg>

                            <input type="text" id="from" placeholder="Откуда" name="from">
                        </label>

                        <label for="to">
                            <svg width="12" height="16">
                                <use xlink:href="#map"></use>
                            </svg>

                            <input type="text" id="to" placeholder="Откуда" name="to">
                        </label>
                    </form>
                    <button class="form-btn">
                        <svg width="14" height="14">
                            <use xlink:href="#plus"></use>
                        </svg>

                        Добавить заявку водителю
                    </button>
                </div>

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
                        <div class="order-info__card order-info-second">
                            <div class="order-info-col">
                                <label for="dir" class="mobile-order-head label-order">
                                    <input type="checkbox" id="dir">
                                    Груз
                                </label>

                                <details>
                                    <summary>RUS</summary>
                                </details>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">загрузка</p>
                                <p class="car-head"><strong>Санкт-Петербург</strong></p>
                                <p>Lorem ipsum dolor sit amet</p>
                                <p><strong>готов 6 сен</strong></p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">разгрузка</p>
                                <p class="car-head"><strong>Улан-удЭ</strong></p>
                                <p>110 квартал, 14</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">ВЕС, Т / ОБЬЕМ, М3 ГРУЗ</p>
                                <p class="car-head"><strong>10/10</strong>автомобиль(ли)</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">Транспорт</p>
                                <p class="car-head"><strong>закр. + терм.</strong></p>
                                <p>загр/выгр: задн, отд.машина</p>
                            </div>

                            <div class="order-info-col">
                                <p class="mobile-order-head">Ставка</p>
                                <p class="car-head"><strong>26 124</strong>руб нал</p>
                                <p class="car-head"><strong>27 166</strong>руб с НДС</p>
                                <p class="car-head"><strong>26 124</strong>руб без НДС торг</p>
                                <div class="order-icons">
                                    <button class="chat-message" data-modal-target="dropdown-chat">
                                        <img src="{{ asset('assets/images/svg/message.svg') }}" alt="meassge" width="30" height="30">
                                    </button>

                                    <div class="order-cansel-modal order-cansel-dropdown" data-modal="dropdown-chat">
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

                                    <button class="chat-message" data-modal-target="dropdown">
                                        <img src="{{ asset('assets/images/svg/order-pen.svg') }}" alt="meassge" width="30" height="30">
                                    </button>

                                    <button class="chat-message" data-modal-target="dropdown-close">
                                        <img src="{{ asset('assets/images/svg/order-close.svg') }}" alt="meassge" width="30" height="30">
                                    </button>

                                    <div class="order-cansel-modal order-cansel-dropdown" data-modal="dropdown-close">
                                        <button class="order-close-btn" data-modal-close="dropdown-close"></button>
                                        <div class="tr">
                                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                                            </svg>
                                        </div>
                                        <b>Отклонить предложение</b>
                                        <p>Укажите причину отмены предложения</p>
                                        <form action="" method="">
                                            <textarea name="" id="" style="height: auto; overflow: hidden"></textarea>
                                            <b>Что сделать с грузом</b>

                                            <label for="save">
                                                Восстановить груз
                                                <input type="radio" name="archiveOption" id="save">
                                            </label>
                                            <label for="stay">
                                                Оставить груз в Архиве
                                                <input type="radio" name="archiveOption" id="stay">
                                            </label>

                                            <button class="form-btn" data-modal-close="dropdown-close">Отклонить
                                                предложение</button>
                                            <button type="button" class="order-cansel" data-modal-close="dropdown-close">Не
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

                        <div class="order-info__card order-info__buttom order-card-border">
                            <div class="order-info-col">
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
{{--                                <p>--}}
{{--                                    Имя--}}
{{--                                    <svg width="19" height="16">--}}
{{--                                        <use xlink:href="#pen-order"></use>--}}
{{--                                    </svg>--}}
{{--                                </p>--}}
                            </div>

{{--                            <div class="order-info-col order-info-m">--}}
{{--                                <p>--}}
{{--                                    <svg width="18" height="14">--}}
{{--                                        <use xlink:href="#dark-car"></use>--}}
{{--                                    </svg>--}}
{{--                                    <span>Добавить данные позже</span>--}}
{{--                                </p>--}}

{{--                                <p>--}}
{{--                                    <svg width="18" height="14">--}}
{{--                                        <use xlink:href="#human"></use>--}}
{{--                                    </svg>--}}
{{--                                    <span>Добавить данные позже</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}

                            <div class="order-info-col order-info-m">
{{--                                <p>TS1, ООО</p>--}}

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

{{--                                <div class="rating">3.67</div>--}}
                            </div>

                            <div class="order-info-col order-info-bottom__end">
                                <div class="order-info-m order-buttons-dosc order-buttons-second">
                                    <span>Заказ</span>
                                    <p>№7777 от 02.09.2022</p>
                                    <p>
                                        <svg width="18" height="14">
                                            <use xlink:href="#order-plus"></use>
                                        </svg>

                                        <button data-modal-target="modal-file">Документы и фото (1)</button>
                                    </p>
                                </div>

                                <div class="order-buttons-second">
                                    <p><a href="#">Заказ</a> в исполнении</p>
                                    <div class="order-buttons">
                                        <button class="form-btn" data-modal-target="modal-create-order">Завершить</button>

                                        <span>сегодня в 11:18</span>
                                    </div>

                                    <div class="order-cansel-modal">
                                        <button class="order-close-btn"></button>
                                        <div class="tr">
                                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <b>Отклонить предложение</b>
                                        <p>Укажите причину отмены предложения</p>
                                        <form action="" method="">
                                            <textarea name="" id=""></textarea>
                                            <b>Что сделать с грузом</b>

                                            <label for="save">
                                                Восстановить груз
                                                <input type="radio" name="archiveOption" id="save">
                                            </label>
                                            <label for="stay">
                                                Оставить груз в Архиве
                                                <input type="radio" name="archiveOption" id="stay">
                                            </label>

                                            <button class="form-btn">Отклонить предложение</button>
                                            <button type="button" class="order-cansel">Не отклонять</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-info__card-search">
                            <label>
                                <select name="" id="">
                                    <option value="" hidden>Нет статуса</option>
                                    <option value="">выгрузился</option>
                                    <option value="">на погрузке</option>
                                    <option value="">Еду на загрузку</option>
                                    <option value="">Загружаюсь</option>
                                    <option value="">Ожидаю выгрузку</option>
                                </select>
                            </label>

                            <label for="">
                                <svg width="20" height="26">
                                    <use xlink:href="#map"></use>
                                </svg>
                                <textarea name="" id="" placeholder="Добавьте водители в заказ и пригласите его, чтобы видеть  грууз на карте"></textarea>

                                <a href="#" class="linkmap">Карта</a>
                            </label>
                        </div>
                    </div>
                </div>

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