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

            <main class="profile-content">
                <div class="notifications-head">
                    <button class="form-btn" data-modal-target="add-ts">Добавить</button>
                </div>



                <div class="drivers__list">
                    <div class="drivers-content">
                        <h5>Автопроезд (сцепка)</h5>

                        <div class="drivers-card ts-card">
                            <picture>
                                <source srcset="{{ asset('assets/images/driver-card.avif') }}">
                                <img src="{{ asset('assets/images/driver-card.png') }}" alt="водитель" width="90" height="90">
                            </picture>

                            <div class="ts__info">
                                <b>Ванхул 50 (92 кw) O 000 OO 03 RUS</b>
                                <span>тентованный, 8 т</span>
                            </div>
                            <div class="drivers-card__buttons">
                                <button>Редактировать</button>
                                <button>Удалить</button>
                            </div>
                        </div>

                        <div class="drivers-card ts-card">
                            <picture>
                                <source srcset="{{ asset('assets/images/driver-card.avif') }}">
                                <img src="{{ asset('assets/images/driver-card.png') }}" alt="водитель" width="90" height="90">
                            </picture>

                            <div class="ts__info">
                                <b>Ванхул 50 (92 кw) O 000 OO 03 RUS</b>
                                <span>тентованный, 8 т</span>
                            </div>

                            <div class="drivers-card__buttons">
                                <button>Редактировать</button>
                                <button>Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>

    </div>
</main>

<div class="modal-overlay" data-modal="add-ts">
    <div class="modal modal-add-ts">
        <b>Добавить грузовик</b>
        <div class="text-head">Подтвердите транспорт и станьте привлекательнее для заказчиков</div>

        <form action="" method="get">
            @csrf
            <div class="add-ts-inputs">
                <label for="mark">
                    *Марка
                    <input type="text" id="mark">
                </label>
                <label for="model">
                    *Модель
                    <input type="text" id="model">
                </label>
                <label for="yearf">
                    *Год выпуска
                    <input type="text" id="year">
                </label>
                <label for="vin">
                    *VIN
                    <input type="text" id="vin">
                </label>
                <label for="ctc">
                    *CTC
                    <input type="text" id="ctc">
                </label>
                <label for="ser">
                    *Серия и номер ПТС
                    <input type="text" id="ser">
                </label>
            </div>

            <label for="avto" class="avto">
                ГОСОНОМЕР
                <input type="text" id="avto" placeholder="M 123 MM 78 UZS">
            </label>

            <div class="choise-cash">
                <input type="radio" name="payment" id="own">
                <label for="own">Собственное</label>

                <input type="radio" name="payment" id="myne">
                <label for="myne">Привлеченное</label>

                <input type="radio" name="payment" id="arenda">
                <label for="arenda">Аренда</label>

                <input type="radio" name="payment" id="lizing">
                <label for="lizing">Лизинг</label>
            </div>

            <div class="driver-input-row ts-info-row">
                <label for="who" class="textarea">
                    <span>Владелец по свидетельству о регистрации ТС</span>
                    <textarea name="" id="who"></textarea>
                </label>
            </div>

            <label for="driver-check" class="driver-check ts-check">
                <input id="driver-check" type="checkbox">
                Показывать в вашем Паспорте участника
            </label>

            <label class="file" for="files">
                <p>Документы на ТС</p>
                <div>
                    <svg width="16" height="18">
                        <use xlink:href="#file"></use>
                    </svg>
                    Загрузить СТС и ПТС
                </div>
                <input type="file" id="files" multiple="multiple">
            </label>

            <div class="descriptions-ts">
                <b>Характеристики</b>
                <span>Тип кузова</span>
                <label>
                    <select name="" id="">
                        <option value="" hidden>Тип кузова</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </label>
            </div>

            <div class="ts-inputs-cards">
                <label for="gruz">
                    Грузоподъемность,т
                    <input type="number" id="gruz">
                </label>
                <label for="L">
                    Обьем, м3
                    <input type="number" id="L">
                </label>
                <label for="length">
                    Длина,м
                    <input type="number" id="length">
                </label>
                <label for="width">
                    Ширина
                    <input type="number" id="width">
                </label>
                <label for="height">
                    Высота,м
                    <input type="number" id="height">
                </label>
            </div>

            <label for="ts-photo" class="file">
                <div>
                    <svg width="16" height="18">
                        <use xlink:href="#file"></use>
                    </svg>
                    Загрузить фотографии ТС
                </div>
                <input type="file" multiple="multiple" id="ts-photo">
            </label>

            <p><strong>Геопозиция</strong></p>
            <span>Датчик GPS/глонасс в тс</span>

            <button class="add-ts-btn">
                <svg width="18" height="14">
                    <use xlink:href="#order-plus"></use>
                </svg>
                Добавить датчик
            </button>

            <button class="add-ts-btn">
                <svg width="18" height="14">
                    <use xlink:href="#order-plus"></use>
                </svg>
                Добавить водителя
            </button>

            <p><strong>Дополнительно</strong></p>
            <label class="dp-check" for="dp-chek1">
                <input type="checkbox" id="dp-chek1">
                можно возить реф-контейнеры
            </label>
            <label class="dp-check" for="dp-chek2">
                <input type="checkbox" id="dp-chek2">
                есть Genset (навесной генератор)
            </label>
            <label class="dp-check" for="dp-chek3">
                можно возить тяжелые контейнеры
                <input type="checkbox" id="dp-chek3">
            </label>

            <button class="add-ts-btn add-ts-dp">
                <svg width="18" height="14">
                    <use xlink:href="#order-plus"></use>
                </svg>
                Добавить прицеп
            </button>

            <button class="form-btn" data-modal-close="add-ts">Добавить</button>
        </form>

        <button class="modal-close" type="button" data-modal-close="add-ts">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>