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
                <div class="drivers__list">
                    <div class="drivers-head">
                        <a class="current" href="{{ route('drivers', app()->getLocale()) }}">Активные</a>
                        <button class="form-btn" data-modal-target="add-driver">Добавить</button>
                    </div>

                    <div class="drivers-content">
                        <b>Ваши водители</b>
                        <div class="drivers-card">
                            <picture>
                                <source srcset="{{ asset('assets/images/driver-card.avif') }}">
                                <img src="{{ asset('assets/images/driver-card.png') }}" alt="водитель" width="90" height="90">
                            </picture>

                            <div class="drivers-card__info">
                                <div class="drivers-card__head">
                                    <p><strong>Иванов Иван Иванович</strong></p>
                                    <div class="drivers-card__buttons">
                                        <a href="#">Отправить закза</a>
                                        <a href="#">Еще</a>
                                    </div>
                                </div>

                                <div class="drivers-card__bottom">
                                    <div>
                                        <a href="tel:+998900000000">+ 998 90 000 00 00</a>
                                        <a href="#">пасспорт</a>
                                    </div>
                                    <p><strong>EUCA Alliance уствновлен,</strong> активность 1 день назад</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
</main>

<div class="modal-overlay" data-modal="add-driver">
    <div class="modal modal-add-driver">
        <b>Добавить водителя</b>

        <form action="" method="get">
            @csrf
            <div class="driver-input-row">
                <p><strong>* Фамилия</strong></p>

                <label for="name">
                    <input id="name" name="" type="text" placeholder="Иванов">
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>* Имя</strong></p>

                <label for="lastname">
                    <input id="lastname" name="" type="text" placeholder="Иван">
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>Отчество</strong></p>

                <label for="middlename">
                    <input id="middlename" name="" type="text" placeholder="Иванович">
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>* Телефон</strong></p>

                <label for="tel">
                    <input id="middlename" name="" type="tel" placeholder="+998 90 000 00 00">
                </label>
            </div>
            <label for="driver-check" class="driver-check">
                <input id="driver-check" type="checkbox">
                Привлеченный сотрудник
            </label>

            <div class="driver-input-row driver-input-row__m">
                <p></p>

                <label for="ser">
                    <input id="ser" name="" type="text" placeholder="Серия, если есть">
                </label>

                <label for="number">
                    <input id="number" name="" type="number" placeholder="Номер">
                </label>

                <label for="date" class="date-driver">
                    <svg width="12" height="12">
                        <use xlink:href="#calendar"></use>
                    </svg>
                    <input id="date" name="" type="number" placeholder="Дата выдачи">
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>* Кем выдан</strong></p>

                <label for="who" class="textarea">
                    <textarea name="" id="who"></textarea>
                </label>
            </div>

            <div class="drivers-tags">
                <button>
                    <svg width="12" height="12">
                        <use xlink:href="#plus"></use>
                    </svg>
                    Код подразделения
                </button>
                <button>
                    <svg width="12" height="12">
                        <use xlink:href="#plus"></use>
                    </svg>
                    Дата рождения
                </button>
                <button>
                    <svg width="12" height="12">
                        <use xlink:href="#plus"></use>
                    </svg>
                    Прописка
                </button>
                <button>
                    <svg width="12" height="12">
                        <use xlink:href="#plus"></use>
                    </svg>
                    Скан паспорта
                </button>
                <button>
                    <svg width="12" height="12">
                        <use xlink:href="#plus"></use>
                    </svg>
                    Водительское удостоверение
                </button>
                <button>
                    <svg width="12" height="12">
                        <use xlink:href="#plus"></use>
                    </svg>
                    ИНН
                </button>
            </div>

            <button class="form-btn" data-modal-close="add-driver">Добавить</button>
        </form>

        <button class="modal-close" type="button" data-modal-close="add-driver">
            <span></span>
            <span></span>
        </button>
    </div>
</div>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>