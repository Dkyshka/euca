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
                    'archive-cargos',
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="18" height="16">
                    <use xlink:href="#cargo"></use>
                </svg>
                <b>{{ __('lang.Грузы и заказы') }}</b>
                <span></span>
            </div>

            <ul class="dropdown-menu {{ request()->routeIs([
                    'cargos',
                    'workCargos',
                    'cargos.create',
                    'archive-cargos',
                ], app()->getLocale()) ? 'open' : '' }}">
                <li><a href="{{ route('cargos', app()->getLocale()) }}">{{ __('lang.Ваши грузы') }}</a></li>
                <li>
                    <a href="{{ route('workCargos', app()->getLocale()) }}">{{ __('lang.Грузы в работе') }}</a>
                </li>
                <li><a href="{{ route('archive-cargos', app()->getLocale()) }}">{{ __('lang.Архив грузов') }}</a></li>
            </ul>
        </li>

        <li>
            <div class="side-bar__menu-row">
                <svg width="18" height="16">
                    <use xlink:href="#search-icon"></use>
                </svg>
                <b>{{ __('lang.Поиск') }}</b>
                <span></span>
            </div>

            <ul class="dropdown-menu">
                <li><a href="{{ url(app()->getLocale(), 'cargo-search') }}">{{ __('lang.Поиск Грузов') }}</a></li>
                <li>
                    <a href="{{ url(app()->getLocale(), 'transport-search') }}">{{ __('lang.Поиск транспорта') }}</a>
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
                <b>{{ __('lang.Заказы от вас') }}</b>
                <span></span>
            </div>
            <ul class="dropdown-menu {{ request()->routeIs([
                    'сoordinations',
                    'execution',
                ], app()->getLocale()) ? 'open' : '' }}">
                <li>
                    <a href="{{ route('сoordinations', app()->getLocale()) }}">{{ __('lang.Согласование') }}</a>
                </li>
                <li><a href="{{ route('execution', app()->getLocale()) }}">{{ __('lang.В исполнении') }}</a></li>
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
                <b>{{ __('lang.Справочники') }}</b>
                <span></span>
            </div>

            <ul class="dropdown-menu {{ request()->routeIs([
                    'auto-park',
                    'drivers',
                ], app()->getLocale()) ? 'open' : '' }}">
                <li>
                    <a href="{{ route('auto-park', app()->getLocale()) }}">{{ __('lang.Автопарк') }}</a>
                </li>
                <li><a href="{{ route('drivers', app()->getLocale()) }}">{{ __('lang.Водители') }}</a></li>
            </ul>
        </li>

        <li>
            <div class="side-bar__menu-row {{ request()->routeIs([
                    'notifications',
                ], app()->getLocale()) ? 'open' : '' }}">
                <svg width="15" height="16">
                    <use xlink:href="#profile-note"></use>
                </svg>
                <a href="{{ route('notifications', app()->getLocale()) }}">{{ __('lang.Уведомления') }}</a>
            </div>
        </li>

        @php
            use Illuminate\Support\Facades\Auth;
            use App\Models\Message;

            $userId = Auth::id();

            $totalUnreadMessages = Message::where('is_read', false)
                ->where('sender_id', '!=', $userId)
                ->whereHas('chat', function ($query) use ($userId) {
                    $query->where('sender_id', $userId)
                          ->orWhere('recipient_id', $userId);
                })
                ->count();
        @endphp
        <li>
            <div class="side-bar__menu-row">
                <svg width="16" height="16">
                    <use xlink:href="#message"></use>
                </svg>
                <a href="{{ route('messages', app()->getLocale()) }}">
                    {{ __('lang.Сообщения') }}
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
                <b>{{ __('lang.Профиль') }}</b>
                <span></span>
            </div>
            <ul class="dropdown-menu {{ request()->routeIs([
                    'settings',
                    'companies',
                    'tariffs',
                    'subscribes'
                ], app()->getLocale()) ? 'open' : '' }}">
                <li><a href="{{ route('settings', app()->getLocale()) }}">{{ __('lang.Настройки профиля') }}</a></li>
                <li>
                    <a href="{{ route('companies', app()->getLocale()) }}">{{ __('lang.Настройки компании') }}</a>
                </li>
{{--                <li><a href="{{ route('tariffs', app()->getLocale()) }}">{{ __('lang.Тарифы') }}</a></li>--}}
                <li><a href="{{ route('subscribes', app()->getLocale()) }}">{{ __('lang.Управление подпиской') }}</a></li>
            </ul>
        </li>
    </ul>

    <a href="{{ route('auth_logout', app()->getLocale()) }}" class="logout">
        <svg width="14" height="16">
            <use xlink:href="#exit"></use>
        </svg>
        {{ __('lang.Выйти') }}
    </a>
</div>