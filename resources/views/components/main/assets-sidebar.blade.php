<div class="side-bar">
    <button class="nav__btn-profile" aria-label="навигационное меню">
		<span>
			<span></span>
		</span>
    </button>

    <a href="{{ url(app()->getLocale()) }}" aria-label="на главную страннцу" class="nav__logo">
        <picture>
            <source srcset="{{ asset('assets/images/svg/logo.svg') }}">
            <img src="{{ asset('assets/images/svg/logo.svg') }}" width="230" height="50" alt="логотип компании">
        </picture>
    </a>

    <ul class="side-bar__menu">
        <li>
            <div class="side-bar__menu-row {{ request()->routeIs([
                    'cargos',
                    'workCargos',
                    'cargos.create',
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="18" height="16">
                    <use xlink:href="#cargo"></use>
                </svg>
                <b>Грузы и заказы</b>
                <span></span>
            </div>

            <ul class="dropdown-menu {{ request()->routeIs([
                    'cargos',
                    'workCargos',
                    'cargos.create',
                ], app()->getLocale()) ? 'open' : '' }}">
                <li><a href="{{ route('cargos', app()->getLocale()) }}">Ваши грузы</a></li>
                <li>
                    <a href="{{ route('workCargos', app()->getLocale()) }}">Грузы в работе</a>
                </li>
{{--                <li><a href="#">Архив грузов</a></li>--}}
            </ul>
        </li>

        <li>
            <div class="side-bar__menu-row">
                <svg width="18" height="16">
                    <use xlink:href="#search-icon"></use>
                </svg>
                <b>Поиск</b>
                <span></span>
            </div>

            <ul class="dropdown-menu">
                <li><a href="{{ url(app()->getLocale(), 'cargo-search') }}">Поиск Грузов</a></li>
                <li>
                    <a href="{{ url(app()->getLocale(), 'transport-search') }}">Поиск транспорта</a>
                </li>
            </ul>
        </li>

        <li>
            <div class="side-bar__menu-row {{ request()->routeIs([
                    'сoordinations',
                    'execution',
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="14" height="14">
                    <use xlink:href="#order"></use>
                </svg>
                <b>Заказы от вас</b>
                <span></span>
            </div>
            <ul class="dropdown-menu {{ request()->routeIs([
                    'сoordinations',
                    'execution',
                ], app()->getLocale()) ? 'open' : '' }}">
                <li>
                    <a href="{{ route('сoordinations', app()->getLocale()) }}">Согласование</a>
                </li>
                <li><a href="{{ route('execution', app()->getLocale()) }}">В исполнении</a></li>
{{--                <li><a href="#">Документы и оплата</a></li>--}}
            </ul>
        </li>

        <li>
            <div class="side-bar__menu-row {{ request()->routeIs([
                    'auto-park',
                    'drivers',
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="14" height="14">
                    <use xlink:href="#order"></use>
                </svg>
                <b>Справочники</b>
                <span></span>
            </div>

            <ul class="dropdown-menu {{ request()->routeIs([
                    'auto-park',
                    'drivers',
                ], app()->getLocale()) ? 'open' : '' }}">
                <li>
                    <a href="{{ route('auto-park', app()->getLocale()) }}">Автопарк</a>
                </li>
                <li><a href="{{ route('drivers', app()->getLocale()) }}">Водители</a></li>
            </ul>
        </li>

        <li>
            <div class="side-bar__menu-row {{ request()->routeIs([
                    'notifications',
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="15" height="16">
                    <use xlink:href="#profile-note"></use>
                </svg>
                <a href="{{ route('notifications', app()->getLocale()) }}">Уведомления</a>
            </div>
        </li>

        @php
            use Illuminate\Support\Facades\Auth;

            $totalUnreadMessages = App\Models\Message::whereHas('chat.users', function ($q) {
                $q->where('users.id', Auth::id());
            })
            ->where('is_read', false)
            ->where('user_id', '!=', Auth::id())
            ->count();
        @endphp
        <li>
            <div class="side-bar__menu-row">
                <svg width="16" height="16">
                    <use xlink:href="#message"></use>
                </svg>
                <a href="{{ route('messages', app()->getLocale()) }}">
                    Сообщения
                    @if ($totalUnreadMessages > 0)
                        <div class="menu-count">{{ $totalUnreadMessages }}</div>
                    @endif
                </a>
            </div>
        </li>

        <li>
            <div class="side-bar__menu-row
                {{ request()->routeIs([
                    'settings',
                    'companies',
                    'tariffs',
                    'subscribes'
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="16" height="16">
                    <use xlink:href="#profile"></use>
                </svg>
                <b>Профиль</b>
                <span></span>
            </div>
            <ul class="dropdown-menu {{ request()->routeIs([
                    'settings',
                    'companies',
                    'tariffs',
                    'subscribes'
                ], app()->getLocale()) ? 'open' : '' }}">
                <li><a href="{{ route('settings', app()->getLocale()) }}">Настройки профиля</a></li>
                <li>
                    <a href="{{ route('companies', app()->getLocale()) }}">Настройки компании</a>
                </li>
                <li><a href="{{ route('tariffs', app()->getLocale()) }}">Тарифы</a></li>
                <li><a href="{{ route('subscribes', app()->getLocale()) }}">Управление подпиской</a></li>
            </ul>
        </li>
    </ul>

    <a href="{{ route('auth_logout', app()->getLocale()) }}" class="logout">
        <svg width="14" height="16">
            <use xlink:href="#exit"></use>
        </svg>
        Выйти
    </a>
</div>