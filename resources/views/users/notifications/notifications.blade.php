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

                <h1>{{ __('lang.Ваши уведомления') }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">


                <div class="notifications__list">
                    <form>
                        <div class="notifications-head">
                            <button class="delete__btn">
                                <svg width="14" height="17">
                                    <use xlink:href="#delete"></use>
                                </svg>
                            </button>

                            <label for="filter" class="filter-notifications">
                                <select name="filter" id="filter">
                                    <option value="" hidden>{{ __('lang.Все') }}</option>
                                    <option value="1">{{ __('lang.Важные') }}</option>
                                    <option value="2">{{ __('lang.Новые') }}</option>
                                    <option value="3">{{ __('lang.Горящие') }}</option>
                                </select>
                            </label>

                            <button class="form-btn">
                                <svg width="11" height="12">
                                    <use xlink:href="#read"></use>
                                </svg>
                                {{ __('lang.Все прочитано') }}
                            </button>

                            <div class="pagination-notifications">
                                <p>1 - 1</p>
                                <div class="links-pagination">
                                    <button>
                                        <svg width="7" height="12">
                                            <use xlink:href="#pag-left"></use>
                                        </svg>
                                    </button>
                                    <button>
                                        <svg width="7" height="12">
                                            <use xlink:href="#pag-right"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

{{--                        <table class="notifications-table">--}}
{{--                            <thead></thead>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <label class="table-checkbox">--}}
{{--                                        <input type="checkbox">--}}
{{--                                        TS1OOO--}}
{{--                                    </label>--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    <a href="{{ route('notificationsInner', app()->getLocale()) }}"><strong>Встречное предложение на груз:</strong>--}}
{{--                                        IPA2E2473, Автомобиль(ный), Санкт-Петербург - Улан-Удэ, 10т, 10м2, закр., изотерм., реф., боковая--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td><b>1100</b></td>--}}
{{--                            </tr>--}}

{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <label class="table-checkbox">--}}
{{--                                        <input type="checkbox">--}}
{{--                                        TS1OOO--}}
{{--                                    </label>--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    <a href="{{ route('notificationsInner', app()->getLocale()) }}"><strong>Встречное предложение на груз:</strong>--}}
{{--                                        IPA2E2473, Автомобиль(ный), Санкт-Петербург - Улан-Удэ, 10т, 10м2, закр., изотерм., реф., боковая--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td><b>1100</b></td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
                    </form>
                </div>
            </main>
        </div>

    </div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>