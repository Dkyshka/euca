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

                        @foreach($drivers as $driver)
                        <div class="drivers-card" style="margin-bottom: 20px;">
                            <picture>
                                <source srcset="{{ asset('assets/images/driver-card.avif') }}">
                                <img src="{{ asset('assets/images/driver-card.png') }}" alt="водитель" width="90" height="90">
                            </picture>

                            <div class="drivers-card__info">
                                <div class="drivers-card__head">
                                    <p><strong>{{ $driver->last_name }} {{ $driver->first_name }} {{ $driver->middle_name }}</strong></p>
{{--                                    <div class="drivers-card__buttons">--}}
{{--                                        <a href="">Удалить</a>--}}
{{--                                    </div>--}}
                                </div>

                                <div class="drivers-card__bottom">
                                    <div>
                                        <a href="tel:{{ str_replace(['(', ')', ' ', '-'], '', $driver->phone) }}">{{ $driver->phone }}</a>
                                        <p>{{ $driver->birth_date?->format('d.m.Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach



                    </div>
                </div>
            </main>
        </div>

    </div>
</main>

<div class="modal-overlay" data-modal="add-driver">
    <div class="modal modal-add-driver">
        <b>Добавить водителя</b>

        <form action="{{ route('drivers.store', app()->getLocale()) }}" id="add-driver-form" method="POST">
            @csrf
            <div class="driver-input-row">
                <p><strong>* Фамилия</strong></p>
                <label for="last_name">
                    <input id="last_name" name="last_name" type="text" placeholder="Иванов" required>
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>* Имя</strong></p>
                <label for="first_name">
                    <input id="first_name" name="first_name" type="text" placeholder="Иван" required>
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>Отчество</strong></p>
                <label for="middle_name">
                    <input id="middle_name" name="middle_name" type="text" placeholder="Иванович">
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>* Телефон</strong></p>
                <label for="phone">
                    <input id="phone" name="phone" type="tel" placeholder="+998 90 000 00 00" required>
                </label>
            </div>

            <div class="driver-input-row">
                <p><strong>* Дата рождения</strong></p>
                <label for="birth_date" class="date-driver">
                    <svg width="12" height="12"><use xlink:href="#calendar"></use></svg>
                    <input id="birth_date" name="birth_date" type="date" required>
                </label>
            </div>

            <button type="submit" class="form-btn">Добавить</button>
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