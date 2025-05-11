
<footer class="footer">
    <a href="{{ url(app()->getLocale()) }}" aria-label="на главную страннцу" class="nav__logo">
        <picture>
            <source srcset="{{ asset('assets/images/svg/search-logo.svg') }}">
            <img src="{{ asset('assets/images/svg/search-logo.svg') }}" width="230" height="50" alt="логотип компании">
        </picture>
    </a>

    <div class="footer-contacts">
        <b>{{ __('lang.Контакты') }}</b>
        <a href="javascript:;" class="footer-location">{{ $settings->markup['address'][app()->getLocale() ?? 'ru'] ?? '' }}</a>
        @php
            $phones = explode(',', $settings->markup['phones'][0] ?? '');
            $emails = explode(',', $settings->markup['emails'][0] ?? '');
        @endphp
        @foreach($phones as $phone)
            <a href="tel:{{ str_replace(['-', '(', ')', ' '], '', trim($phone)) }}">{{ trim($phone) }}</a>
        @endforeach
        @foreach($emails as $email)
        <a href="mailto:{{ trim($email) }}">{{ trim($email) }}</a>
        @endforeach
    </div>

    <ul class="footer-links">
        @foreach($footer as $item)
        <li>
            <a href="{{ $item->link }}">{{ $item->name }}</a>
        </li>
        @endforeach
    </ul>

    <div class="footer-icons">
        @guest
        <div class="footer-auth">
            <button type="button" class="footer-auth__btn login" data-modal-target="modal-login">Войти</button>
            <button type="button" class="footer-auth__btn register" data-modal-target="modal-register">Регистрация</button>
        </div>
        @endguest

        <ul class="footer-social">
            @foreach($settings->markup['socials'] ?? [] as $key => $social)
            @if ($key == 'instagram')
            <li>
                <a href="{{ $social }}">
                    <svg width="24" height="21" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.9006 0.0999756H7.01648C5.34887 0.101724 3.7501 0.715884 2.57092 1.80772C1.39174 2.89955 0.728451 4.37989 0.726562 5.92398V15.076C0.728451 16.6201 1.39174 18.1004 2.57092 19.1922C3.7501 20.2841 5.34887 20.8982 7.01648 20.9H16.9006C18.5683 20.8982 20.167 20.2841 21.3462 19.1922C22.5254 18.1004 23.1887 16.6201 23.1906 15.076V5.92398C23.1887 4.37989 22.5254 2.89955 21.3462 1.80772C20.167 0.715884 18.5683 0.101724 16.9006 0.0999756ZM11.9586 15.492C10.8923 15.492 9.84989 15.1992 8.96328 14.6507C8.07668 14.1021 7.38566 13.3225 6.9776 12.4103C6.56954 11.4982 6.46277 10.4944 6.6708 9.52608C6.87882 8.55773 7.3923 7.66824 8.1463 6.9701C8.90029 6.27196 9.86094 5.79651 10.9068 5.6039C11.9526 5.41128 13.0366 5.51014 14.0217 5.88797C15.0069 6.2658 15.8489 6.90564 16.4413 7.72657C17.0337 8.5475 17.3499 9.51265 17.3499 10.5C17.3483 11.8235 16.7798 13.0923 15.769 14.0282C14.7583 14.9641 13.3879 15.4905 11.9586 15.492ZM17.7992 6.33998C17.5326 6.33998 17.272 6.26678 17.0504 6.12965C16.8287 5.99252 16.656 5.79761 16.554 5.56956C16.4519 5.34152 16.4253 5.09059 16.4773 4.8485C16.5293 4.60641 16.6576 4.38404 16.8461 4.20951C17.0346 4.03497 17.2748 3.91611 17.5363 3.86796C17.7977 3.8198 18.0687 3.84452 18.315 3.93897C18.5613 4.03343 18.7718 4.19339 18.9199 4.39862C19.068 4.60386 19.147 4.84514 19.147 5.09198C19.147 5.42297 19.005 5.7404 18.7523 5.97445C18.4995 6.20849 18.1567 6.33998 17.7992 6.33998Z"/>
                    </svg>
                </a>
            </li>
            @elseif($key == 'facebook')
            <li>
                <a href="{{ $social }}">
                    <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.9004 2.09998C22.0607 2.09998 23.0528 2.4814 23.8766 3.24425C24.7005 4.00709 25.1124 4.92567 25.1124 5.99998V19C25.1124 20.0743 24.7005 20.9929 23.8766 21.7557C23.0528 22.5186 22.0607 22.9 20.9004 22.9H18.1509V14.8427H21.0613L21.5001 11.701H18.1509V9.69685C18.1509 9.1913 18.2655 8.81213 18.4946 8.55935C18.7238 8.30657 19.1698 8.18018 19.8328 8.18018L21.6171 8.16664V5.36352C21.0028 5.28227 20.1351 5.24164 19.0138 5.24164C17.6878 5.24164 16.6275 5.60275 15.8329 6.32498C15.0383 7.0472 14.6409 8.06734 14.6409 9.38539V11.701H11.7159V14.8427H14.6409V22.9H6.86044C5.70019 22.9 4.70813 22.5186 3.88425 21.7557C3.06038 20.9929 2.64844 20.0743 2.64844 19V5.99998C2.64844 4.92567 3.06038 4.00709 3.88425 3.24425C4.70813 2.4814 5.70019 2.09998 6.86044 2.09998H20.9004Z"/>
                    </svg>
                </a>
            </li>
            @elseif($key == 'youtube')
            <li>
                <a href="{{ $social }}">
                    <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.905 8.07647C24.905 7.88824 24.6111 6.38235 23.9252 5.72353C23.0434 4.78235 22.0637 4.68824 21.5738 4.68824H21.4758C18.4386 4.5 13.9317 4.5 13.8337 4.5C13.8337 4.5 9.22879 4.5 6.19153 4.68824H6.09355C5.60367 4.68824 4.62391 4.78235 3.74212 5.72353C3.05629 6.47647 2.76236 7.98235 2.76236 8.17059C2.76236 8.26471 2.56641 9.95882 2.56641 11.7471V13.3471C2.56641 15.1353 2.76236 16.8294 2.76236 16.9235C2.76236 17.1118 3.05629 18.6176 3.74212 19.2765C4.52593 20.1235 5.50569 20.2176 6.09355 20.3118H6.38748C8.15105 20.5 13.5397 20.5 13.7357 20.5C13.7357 20.5 18.3406 20.5 21.3779 20.3118H21.4758C21.9657 20.2176 22.9455 20.1235 23.8273 19.2765C24.5131 18.5235 24.807 17.0176 24.807 16.8294C24.807 16.7353 25.003 15.0412 25.003 13.2529V11.6529C25.101 9.95882 24.905 8.17059 24.905 8.07647ZM17.6548 12.6882L11.7762 15.7C11.6782 15.7 11.6782 15.7941 11.5802 15.7941C11.4822 15.7941 11.3843 15.7941 11.3843 15.7C11.2863 15.6059 11.1883 15.5118 11.1883 15.3235V9.20588C11.1883 9.01765 11.2863 8.92353 11.3843 8.82941C11.4822 8.73529 11.6782 8.73529 11.8742 8.82941L17.7527 11.8412C17.9487 11.9353 18.0467 12.0294 18.0467 12.2176C18.0467 12.4059 17.8507 12.5941 17.6548 12.6882Z"/>
                    </svg>
                </a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</footer>

<script src="{{ asset('assets/js/main.min.js') }}"></script>



<div class="modal-overlay" data-modal="modal-login">
    <div class="modal modal-login">

        <b>Вход в EUCA Alliance</b>

        <form action="{{ route('auth_login', app()->getLocale()) }}" method="post">
            @csrf
            <div class="input__row">
                <p>Логин</p>

                <label for="auth-login">
                    <input type="text" name="login" id="auth-login" placeholder="Введите логин">
                </label>

            </div>

            <div class="input__row">
                <p>Пароль</p>

                <label for="login-password">
                    <input type="password" name="password" id="login-password" placeholder="Введите пароль">
                    <div class="btn-hide">
                        <svg class="btn-eye" width="20" height="7">
                            <use xlink:href="#eye"></use>
                        </svg>
                        <svg class="btn-eye-close" width="20" height="7">
                            <use xlink:href="#eye-close"></use>
                        </svg>
                    </div>
                </label>

            </div>

            <div class="recovery">
                <input type="checkbox" class="visually-hidden" id="recovery" name="remember">
                <label for="recovery">Запомнить</label>
            </div>

            <button type="submit" class="form-btn">Войти</button>

            <button type="button" class="is-have-auth" data-modal-target="modal-register">
                Нет аккаунта? Зарегестрироваться
            </button>

            <span>Нажимая кнопку «Продолжить», вы принимаете условия</span>
            <a href="#">Пользовательского соглашения</a>
        </form>

        <button class="modal-close" type="button" data-modal-close="modal-login">
            <span></span>
            <span></span>
        </button>

    </div>

</div>

<div class="modal-overlay" data-modal="modal-register">
    <div class="modal modal-register">

        <b>Создать аккаунт на EUCA Alliance</b>

        <form action="{{ route('auth_store', app()->getLocale()) }}" id="register_form">

            <div class="form-head">
                <div class="error_box"></div>
            </div>

            <div class="input__row">
                <p>Укажите ваш профиль деятельности</p>

                <label>
                    <select aria-label="укажите свой профиль" name="role_id" id="role_id">
                        <option value="" hidden>Укажите ваш профиль</option>
                        <option value="4">Перевозчик</option>
                        <option value="5">Грузовладелец</option>
                    </select>

                    <span class="arrow"></span>

                </label>

            </div>

            <div class="input__row">
                <p>Email</p>

                <label for="email">
                    <input type="text" name="email" id="email" placeholder="Введите свой email" >
                </label>

            </div>

            <div class="input__row">
                <p>Логин</p>

                <label for="login">
                    <input type="text" name="login" id="login" placeholder="Введите логин" >
                </label>

            </div>

            <div class="input__row">
                <p>Пароль</p>

                <label for="register-password">
                    <input type="password" name="password" id="register-password" placeholder="Введите пароль" >
                    <div class="btn-hide">
                        <svg class="btn-eye" width="20" height="7">
                            <use xlink:href="#eye"></use>
                        </svg>
                        <svg class="btn-eye-close" width="20" height="7">
                            <use xlink:href="#eye-close"></use>
                        </svg>
                    </div>
                </label>

            </div>

            <div class="input__row">

                <p>Номер телефона</p>

                <div class="iput-row__wrapper">

{{--                    <button type="button" class="input-row__icon">--}}

{{--                        <img src="{{ asset('assets/images/phone-mask.png') }}" alt="mask">--}}

{{--                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path d="M7.33395 1.24661L4.24409 4.33647C4.17253 4.40803 4.09558 4.46305 4.01324 4.50153C3.93091 4.54 3.84049 4.55885 3.742 4.55808C3.64351 4.55731 3.55309 4.53808 3.47076 4.50037C3.38842 4.46267 3.31147 4.40765 3.23991 4.33532L0.150048 1.24546C0.107727 1.20236 0.0719462 1.15273 0.0427059 1.09656C0.014235 1.04039 -1.56405e-07 0.979984 -1.5923e-07 0.915348C-1.64881e-07 0.786074 0.0423211 0.674883 0.126964 0.581776C0.213146 0.488668 0.325876 0.442114 0.465153 0.442114L7.01769 0.442114C7.15774 0.442114 7.27047 0.489823 7.35588 0.585238C7.44129 0.680654 7.484 0.79146 7.484 0.917655C7.484 0.949974 7.43398 1.05924 7.33395 1.24545" fill="#2E3645"/>--}}
{{--                        </svg>--}}

{{--                    </button>--}}

                    <label for="phone">
                        <input type="tel" name="phone" id="phone" placeholder="+998 99 999 99 99">
                    </label>


                </div>
            </div>

            <button type="submit" class="form-btn" id="register_submit">Продолжить</button>

            <button type="button" class="is-have-auth" data-modal-target="modal-login">
                Уже есть аккаунт? войти
            </button>

            <span>Нажимая кнопку «Продолжить», вы принимаете условия</span>
            <a href="#">Пользовательского соглашения</a>

        </form>

        <button class="modal-close" type="button" data-modal-close="modal-register">
            <span></span>
            <span></span>
        </button>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
</body>
</html>