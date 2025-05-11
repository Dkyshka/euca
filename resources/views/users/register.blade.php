<x-main.assets-header :page="$page"/>

<div class="main-wrapper">
    <!-- header -->
    <header class="header header--mobile-only">
        <div class="header-top">
            <button class="header-opener" type="button" data-modal-open="menu" aria-label="{{ __('lang.Открыть меню') }}">
                <svg width="24" height="24" aria-hidden="true"><use xlink:href="#icon-menu"></use></svg>
            </button>
            <a class="header-logo logo" href="./" aria-label="Перейти к началу">
                <svg width="177" height="32" aria-label="Логотип ANONS.uz"><use xlink:href="#icon-logo"></use></svg>
            </a>
        </div>
    </header>

    <!-- end header -->

    <!-- main -->
    <main class="main" data-main="profile">
        <section class="section section--full">
            <ul class="breadcrumbs breadcrumbs--center">
                <li class="breadcrumbs-item">
                    <a class="breadcrumbs-link" href="{{ url(app()->getLocale()) }}">{{ __('lang.Главная') }}</a>
                    <span class="breadcrumbs-arrow"><svg width="20" height="20" aria-hidden="true"><use xlink:href="#icon-arrow-right"></use></svg></span>
                </li>
                <li class="breadcrumbs-item">
                    <span class="breadcrumbs-link">{{ __('lang.Регистрация нового профиля') }}</span>
                </li>
            </ul>

            <form class="form" action="{{ route('auth_store', app()->getLocale()) }}" method="POST">
                @if($errors->has('error'))
                    <span class="form-text">{{ $errors->first('error') }}</span>
                @endif

                @csrf
                <header class="form-header">
                    <h1 class="section-title title title--m">{{ __('lang.Регистрация') }}</h1>
                </header>
                <div class="form-inner form-inner--m">
                    <label class="form-label">
                        <span class="form-name">{{ __('lang.Имя') }}</span>
                        <input class="form-input" type="text" name="name" placeholder="{{ __('lang.Иван') }}" value="{{ old('name') }}">
                        @if($errors->has('name'))<span class="form-text"> {{ $errors->first('name') }}</span>@endif
                    </label>
                    <label class="form-label">
                        <span class="form-name">E-mail</span>
                        <input class="form-input" type="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                        @if($errors->has('email'))<span class="form-text"> {{ $errors->first('email') }}</span>@endif
                    </label>
                    <div class="form-label">
                        <span class="form-name">{{ __('lang.Пароль:') }}</span>
                        <div class="form-password">
                            <label aria-label="Пароль">
                                <input class="form-input" type="password" name="password" placeholder="{{ __('lang.Придумайте пароль') }}">
                                @if($errors->has('password'))<span class="form-text"> {{ $errors->first('password') }}</span>@endif
                            </label>
                        </div>
                    </div>
                    <div class="form-label">
                        <span class="form-name">{{ __('lang.Подтверждение пароля') }}</span>
                        <div class="form-password">
                            <label aria-label="Пароль">
                                <input class="form-input" type="password" name="password_confirmation" placeholder="{{ __('lang.Подтвердите пароль') }}">
                                @if($errors->has('password_confirmation'))<span class="form-text"> {{ $errors->first('password_confirmation') }}</span>@endif
                            </label>
                        </div>
                    </div>
                </div>
                <footer class="form-footer">
                    <button class="btn" type="submit"><!-- disabled -->
                        <span>{{ __('lang.Регистрация') }}</span>
                    </button>
                </footer>
            </form>

            <div class="auth">
                <div class="auth-head">
                    <b>{{ __('lang.Войти с помощью') }}</b>
                </div>
                <ul class="auth-list">
                    <li class="auth-list__item">
                        <a class="auth-list__link" href="{{ route('facebook.redirect') }}" target="_blank" rel="noopener nofollow" aria-label="{{ __('lang.Войти с помощью Facebook') }}">
                            <svg width="40" height="40" aria-hidden="true"><use xlink:href="#facebook-circle"></use></svg>
                        </a>
                    </li>
                    <li class="auth-list__item">
                        <script async src="https://telegram.org/js/telegram-widget.js?22" data-lang="{{ app()->getLocale() }}" data-telegram-login="anons_auth_bot" data-userpic="false" data-size="large" data-radius="20" data-auth-url="{{ route('telegram.callback') }}"></script>
                    </li>
                    <li class="auth-list__item">
                        <a class="auth-list__link" href="{{ route('google.redirect') }}" target="_blank" rel="noopener nofollow" aria-label="{{ __('lang.Войти с помощью Google') }}">
                            <svg width="40" height="40" aria-hidden="true"><use xlink:href="#google-circle"></use></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </main>
    <!-- end main -->
</div>

<x-main.assets-footer/>