<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="{{ csrf_token() }}" name="csrf">
    <title>EUCA - @yield('title')</title>

    {{-- favicon --}}
    <link rel="icon" href="{{ asset('assets/apple-touch-icon.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/ionicons/ionicons.min.css') }}">


    <!-- jQuery -->
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Summernote CSS -->
    <link href="{{ asset('cms/plugins/summernote/summernote-last-version.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.css') }}">

    <!-- Daterangepicker -->
    <script type="text/javascript" src="{{ asset('cms/plugins/moment/moment.min.js') }}"></script>
    <link href="{{ asset('cms/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('cms/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Moment.js -->

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/dist/css/main.css') }}">
    <script src="{{ asset('cms/dist/js/superredactor/sredactor.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/axios/axios.min.js') }}"></script>
    <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('/') }}" target="_blank" title="Перейти на сайт">
                    <i class="fa fa-desktop"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('admin_logout') }}" title="Выход из системы">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="На весь экран">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container  sidebar-dark-primary-->
    <aside class="main-sidebar sidebar-light-cyan elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin_index') }}" class="brand-link">
            <img src="{{ asset('assets/apple-touch-icon.png') }}" width="30" alt="" style="display:block; margin: 0 auto;">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('cms/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('users_edit', auth()->user()->id) }}" class="d-block">{{ auth()->user()->email }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Поиск" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item {{ request()->is('admin') || request()->is('admin/pages*') || request()->is('admin/flights') || request()->is('admin/flights*') || request()->is('admin/orders') || request()->is('admin/orders*') || request()->is('admin/employees') || request()->is('admin/employees*') || request()->is('admin/brands') || request()->is('admin/brands*') || request()->is('admin/services') || request()->is('admin/services*') || request()->is('admin/countries') || request()->is('admin/countries*') || request()->is('admin/tariffs') || request()->is('admin/tariffs*') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin') || request()->is('admin/pages*') || request()->is('admin/flights') || request()->is('admin/flights*') || request()->is('admin/orders') || request()->is('admin/orders*') || request()->is('admin/employees') || request()->is('admin/employees*') || request()->is('admin/brands') || request()->is('admin/brands*') || request()->is('admin/services') || request()->is('admin/services*') || request()->is('admin/countries') || request()->is('admin/countries*') || request()->is('admin/tariffs') || request()->is('admin/tariffs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Структура
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin_index') }}" class="nav-link {{ request()->is('admin') || request()->is('admin/pages*') ? 'active' : '' }}">
                                    <i class="fas fa-outdent nav-icon"></i>
                                    <p>Структура сайта</p>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('countries_admin') }}" class="nav-link {{ request()->is('admin/countries') || request()->is('admin/countries*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-fire nav-icon"></i>--}}
{{--                                    <p>Страны</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('tariff_admin') }}" class="nav-link {{ request()->is('admin/tariffs') || request()->is('admin/tariffs*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-poll-h nav-icon"></i>--}}
{{--                                    <p>Тарифы</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('service_admin') }}" class="nav-link {{ request()->is('admin/services') || request()->is('admin/services*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa fa-cubes nav-icon"></i>--}}
{{--                                    <p>Услуги</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item ">--}}
{{--                                <a href="{{ route('brand_admin') }}" class="nav-link {{ request()->is('admin/brands') || request()->is('admin/brands*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa fa-cart-plus nav-icon"></i>--}}
{{--                                    <p>Бренды</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item ">--}}
{{--                                <a href="{{ route('employees_admin') }}" class="nav-link {{ request()->is('admin/employees') || request()->is('admin/employees*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-user-plus nav-icon"></i>--}}
{{--                                    <p>Сотрудники</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('flight_admin') }}" class="nav-link {{ request()->is('admin/flights') || request()->is('admin/flights*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa fa-fighter-jet nav-icon"></i>--}}
{{--                                    <p>Рейсы</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('orders_admin') }}" class="nav-link {{ request()->is('admin/orders') || request()->is('admin/orders*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-funnel-dollar nav-icon"></i>--}}
{{--                                    <p>Заказы</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                    </li>

                    <li class="nav-item {{ request()->is('admin/review') || request()->is('admin/review*') || request()->is('admin/banners') || request()->is('admin/banners/*') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/review') || request()->is('admin/review*') || request()->is('admin/banners') || request()->is('admin/banners*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Контент
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
{{--                            <li class="nav-item {{ request()->is('admin/review') || request()->is('admin/review*')  ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                                <a href="{{ route('review_admin') }}" class="nav-link {{ request()->is('admin/review') || request()->is('admin/review*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-newspaper nav-icon"></i>--}}
{{--                                    <p>Отзывы</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

                            <li class="nav-item">
                                <a href="{{ route('review_admin') }}" class="nav-link {{ request()->is('admin/review') || request()->is('admin/review*') ? 'active' : '' }}">
                                    <i class="fas fa fa-comments nav-icon"></i>
                                    <p>Отзывы</p>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/reels') || request()->is('admin/reels*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-icons nav-icon"></i>--}}
{{--                                    <p>Reels</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/digest') || request()->is('admin/digest*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-fire nav-icon"></i>--}}
{{--                                    <p>Дайджесты</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/tags') || request()->is('admin/tags*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-poll-h nav-icon"></i>--}}
{{--                                    <p>Тэги</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

                            <li class="nav-item ">
                                <a href="{{ route('banner_admin') }}" class="nav-link {{ request()->is('admin/banners') || request()->is('admin/banners*') ? 'active' : '' }}">
                                    <i class="fas fa-poll-h nav-icon"></i>
                                    <p>Реклама</p>
                                </a>
                            </li>

                        </ul>
                    </li>
{{--                    <li class="nav-item {{ request()->is('admin/cinema') || request()->is('admin/cinema*') || request()->is('admin/cities') || request()->is('admin/cities*') || request()->is('admin/movies') || request()->is('admin/movies*') ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link {{ request()->is('admin/cinema') || request()->is('admin/cinema*') || request()->is('admin/cities') || request()->is('admin/cities*') || request()->is('admin/movies') || request()->is('admin/movies*') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fa fa-film"></i>--}}
{{--                            <p>--}}
{{--                                Киноафиша--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/cities') || request()->is('admin/cities*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-city nav-icon"></i>--}}
{{--                                    <p>Города</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/cinema') || request()->is('admin/cinema*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-desktop nav-icon"></i>--}}
{{--                                    <p>Кинотеатры</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/movies') || request()->is('admin/movies*') ? 'active' : '' }}">--}}
{{--                                    <i class="fas fa-video nav-icon"></i>--}}
{{--                                    <p>Премьеры</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ request()->is('admin/ads') || request()->is('admin/ads*') || request()->is('admin/ad') ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link {{  request()->is('admin/ad') || request()->is('admin/ad*') || request()->is('admin/ad') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fas fa-poll-h"></i>--}}
{{--                            <p>--}}
{{--                                Объявления--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/default/users') || request()->is('admin/default/users*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa fa-object-group nav-icon"></i>--}}
{{--                                    <p>Все объявления</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item {{ request()->is('admin/ads') || request()->is('admin/ads*') || request()->is('admin/ad') ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link {{  request()->is('admin/ad') || request()->is('admin/ad*') || request()->is('admin/ad') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fas fa-comment-alt"></i>--}}
{{--                            <p>--}}
{{--                                Сообщения--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/default/users') || request()->is('admin/default/users*') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-comment-alt nav-icon"></i>--}}
{{--                                    <p>Все сообщения</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item {{ request()->is('admin/default/users') || request()->is('admin/default/users*') || request()->is('admin/default/users') ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link {{  request()->is('admin/default/users') || request()->is('admin/default/users*') || request()->is('admin/default/users') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fa fa-user-plus"></i>--}}
{{--                            <p>--}}
{{--                                Пользователи--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('users_admin') }}" class="nav-link {{ request()->is('admin/default/users') || request()->is('admin/default/users*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa fa-users nav-icon"></i>--}}
{{--                                    <p>Все пользователи</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item {{ request()->is('admin/reviews') || request()->is('admin/reviews*') || request()->is('admin/pending/reviews') || request()->is('admin/pending/reviews*') ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link {{  request()->is('admin/reviews') || request()->is('admin/reviews*') || request()->is('admin/pending/reviews') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fa fa-comment"></i>--}}
{{--                            <p>--}}
{{--                                Отзывы--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('reviews_admin') }}" class="nav-link {{ request()->is('admin/reviews') || request()->is('admin/reviews*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa fa-comments nav-icon"></i>--}}
{{--                                    <p>Все отзывы</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li class="nav-item {{ request()->is('admin/cargo') || request()->is('admin/cargo*') || request()->is('admin/transport')
                || request()->is('admin/transport*') || request()->is('admin/handshake')
                || request()->is('admin/handshake*')  ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Статистика
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('statistic_cargo') }}" class="nav-link {{ request()->is('admin/cargo') || request()->is('admin/telegram/cargo*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-cubes"></i>
                                    <p>Грузы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('statistic_transport') }}" class="nav-link {{ request()->is('admin/transport') || request()->is('admin/transport*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-truck"></i>
                                    <p>Транспорт</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('statistic_drivers') }}" class="nav-link {{ request()->is('admin/drivers') || request()->is('admin/drivers*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-car"></i>
                                    <p>Водители</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users*') || request()->is('admin/users*') || request()->is('admin/settings') || request()->is('admin/settings*') ||  request()->is('admin/telegram/users') || request()->is('admin/telegram/users*') || request()->is('admin/lang*')  ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users*') || request()->is('admin/settings') || request()->is('admin/settings*') ||  request()->is('admin/telegram/users') ||  request()->is('admin/telegram/users*') || request()->is('admin/lang*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Система
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('telegram_users_admin') }}" class="nav-link {{ request()->is('admin/telegram/users') || request()->is('admin/telegram/users*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-user-plus"></i>
                                    <p>Пользователи</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users_admin') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users*') ? 'active' : '' }}">
                                    <i class="fa fa-user-secret nav-icon"></i>
                                    <p>Администраторы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('lang_admin') }}" class="nav-link {{ request()->is('admin/lang') || request()->is('admin/lang*') ? 'active' : '' }}">
                                    <i class="fas fa-language nav-icon"></i>
                                    <p>Переводы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('setting_index') }}" class="nav-link {{ request()->is('admin/settings') || request()->is('admin/settings*') ? 'active' : '' }}">
                                    <i class="fas fa-wrench nav-icon"></i>
                                    <p>Настройки</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item {{ request()->is('admin/logs') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/logs') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-exclamation-triangle"></i>
                            <p>
                                Логи
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('logs') }}" class="nav-link {{ request()->is('admin/logs') ? 'active' : '' }}">
                                    <i class="far fa-calendar-minus nav-icon"></i>
                                    <p>Лог действий</p>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a href="/admin/logerrors" class="nav-link">--}}
{{--                                    <i class="fas fa-bug nav-icon"></i>--}}
{{--                                    <p>Ошибки</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                    </li>

{{--                    <li class="nav-item {{ request()->is('admin/statistics') || request()->is('admin/statistics*') ? 'menu-is-opening menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link {{ request()->is('admin/statistics') || request()->is('admin/statistics*') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fas fa-chart-pie"></i>--}}
{{--                            <p>--}}
{{--                                Статистика--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link {{ request()->is('admin/statistics') || request()->is('admin/statistics*') ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon fas fa-table"></i>--}}
{{--                                    <p>Статистика авторов</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                </ul>
            </nav>

        </div>
    </aside>


    @yield('content')


    <footer class="main-footer">
        <strong>Copyright &copy; 2011-<?= date('Y') ?></strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 2.0.0
        </div>
    </footer>
</div>


<script src="{{ asset('cms/plugins/jquery-ui/jquery-ui.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('cms/dist/js/adminlte.js') }}"></script>


<script src="{{ asset('cms/dist/js/demo.js') }}"></script>
<script src="{{ asset('cms/plugins/select2/js/select2.js') }}"></script>
<script src="{{ asset('cms/plugins/inputmask/inputmask.js') }}"></script>

<script src="{{ asset('cms/dist/js/main.js') }}" id="script"></script>

<script>

    (function( $ ){

        $.fn.filemanager = function(type, options, section = '', gallery = false, slider = false) {
            type = type || 'file';

            this.on('click', function(e) {
                let route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                let target_input = $('#' + $(this).data('input'));
                let target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    let file_path = items.map(function (item) {
                        return item.url;
                    }).join(',');

                    if(section === 'slider') {
                        let countSlider = document.querySelectorAll('.product-img-upload');
                        let lastElement;

                        if (countSlider.length > 0) {
                            lastElement = countSlider[countSlider.length - 1].dataset.id * 1 + 1;

                        } else {
                            lastElement = 0;
                        }

                        items.forEach(function (item, key) {

                            lastElement += key;

                            target_preview.append(`
                            <div class="product-img-upload col-md-3" data-id="${lastElement}" data-orig="${item.thumb_url}">
                                <img src="${item.thumb_url}">
                                <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this, true)"><i class="far fa-trash-alt"></i></button>
                                <button type="button" class="del-img btn btn-app bg-gradient-light" style="right: 46px" data-toggle="modal" data-target="#exampleModalCenter-${lastElement}"><i class="fas fa-pen"></i></button>
                            </div>

                            <div class="modal fade" id="exampleModalCenter-${lastElement}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" style="height: 50vh;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Описание</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="card-header p-0 pt-1 border-bottom-0">
                                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="ru_modal_tab-${lastElement}" data-toggle="pill" href="#ru_modal-${lastElement}" role="tab" aria-controls="ru_modal-${lastElement}" aria-selected="true">RU</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="uz_modal_tab-${lastElement}" data-toggle="pill" href="#uz_modal-${lastElement}" role="tab" aria-controls="uz_modal-${lastElement}" aria-selected="false">UZ</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="en_modal_tab-${lastElement}" data-toggle="pill" href="#en_modal-${lastElement}" role="tab" aria-controls="en_modal-${lastElement}" aria-selected="false">EN</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="card-body">
                                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                                        {{--ru--}}
                                                        <div class="tab-pane fade active show" id="ru_modal-${lastElement}" role="tabpanel" aria-labelledby="ru_modal_tab-${lastElement}">

                                                        <div class="form-group">
                                                            <label for="title_ru" class="col-sm-2 col-form-label">Заголовок</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="markup[images][${lastElement}][ru][title]" class="form-control" id="title_ru">
                                                                </div>
                                                            </div>


                                                        </div>

                                                        {{--uz--}}
                                                        <div class="tab-pane" id="uz_modal-${lastElement}" role="tabpanel" aria-labelledby="uz_modal_tab-${lastElement}">

                                                            <div class="form-group">
                                                                <label for="title_uz" class="col-sm-2 col-form-label">Заголовок</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="markup[images][${lastElement}][uz][title]" class="form-control" id="title_uz">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        {{--en--}}
                                                        <div class="tab-pane" id="en_modal-${lastElement}" role="tabpanel" aria-labelledby="en_modal_tab-${lastElement}">

                                                            <div class="form-group">
                                                                <label for="title_en" class="col-sm-2 col-form-label">Заголовок</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="markup[images][${lastElement}][en][title]" class="form-control" id="title_en">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success" data-dismiss="modal" id="closeTypeBlock">Сохранить</button>
                                                            </div>

                                                        </div>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>

                        `);
                        });

                        let thumbnail = document.getElementById('thumbnail');
                        let images = document.querySelectorAll('.product-img-upload');
                        thumbnail.value = Array.from(images).map(function (item) {
                            return item.dataset.orig;
                        }).join(',');
                    } else if (section === 'gallery') {

                        items.forEach(function (item) {
                            target_preview.append(`
                                <div class="product-img-upload" data-orig="${item.thumb_url}">
                                    <img src="${item.thumb_url}">
                                    <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button>
                                </div>
                            `);
                        });

                        let thumbnail = document.getElementById('thumbnail');
                        let images = document.querySelectorAll('.product-img-upload');
                        thumbnail.value = Array.from(images).map(function (item) {
                            return item.dataset.orig;
                        }).join(',');

                    } else if(section === 'trailer') {

                        let countSlider = document.querySelectorAll('.product-img-upload');
                        let lastElement;

                        if (countSlider.length > 0) {
                            lastElement = countSlider[countSlider.length - 1].dataset.id * 1 + 1;

                        } else {
                            lastElement = 0;
                        }

                        items.forEach(function (item, key) {

                            lastElement += key;

                            target_preview.append(`
                            <div class="product-img-upload col-md-3" data-id="${lastElement}" data-orig="${item.thumb_url}">
                                <img src="${item.thumb_url}">
                                <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this, true)"><i class="far fa-trash-alt"></i></button>
                                <button type="button" class="del-img btn btn-app bg-gradient-light" style="right: 46px" data-toggle="modal" data-target="#exampleModalCenter-${lastElement}"><i class="fas fa-pen"></i></button>
                            </div>

                            <div class="modal fade" id="exampleModalCenter-${lastElement}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" style="height: 50vh;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Описание</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">

                                                        {{--name--}}
                                                        <div class="form-group">
                                                            <label for="name" class="col-sm-2 col-form-label">Название</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="markup[images][${lastElement}][name]" class="form-control" id="name">
                                                            </div>
                                                        </div>

                                                       {{--link--}}
                                                        <div class="form-group">
                                                            <label for="link" class="col-sm-2 col-form-label">Ссылка</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="markup[images][${lastElement}][link]" class="form-control" id="link">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" data-dismiss="modal" id="closeTypeBlock">Сохранить</button>
                                                        </div>

                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>

                        `);
                        });

                        let thumbnail = document.getElementById('thumbnail');
                        let images = document.querySelectorAll('.product-img-upload');
                        thumbnail.value = Array.from(images).map(function (item) {
                            return item.dataset.orig;
                        }).join(',');


                    } else {
                        target_input.val('').val(file_path).trigger('change');
                        target_preview.html('');

                        items.forEach(function (item) {
                            target_preview.append(`
                                <div class="product-img-upload">
                                    <img src="${item.thumb_url}">
                                    <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button>
                                </div>
                            `);
                        });
                    }

                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        }

    })(jQuery);

</script>


<script>

    let route_prefix = '{{ url('admin/filemanager') }}';
    $('#lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm-gallery').filemanager('image', {prefix: route_prefix}, 'gallery');
    $('#lfm-slider').filemanager('image', {prefix: route_prefix}, 'slider');
    $('#lfm-trailer').filemanager('image', {prefix: route_prefix}, 'trailer');

    // Sort sections
    sortElem('#section_list','{{ route('section_update_sort') }}');

    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',']
    })

</script>

@php
    $cargos = \App\Models\CargoLoading::all();
    $transports = \App\Models\Transport::all();
    $drivers = \App\Models\Driver::all();
@endphp

<script>
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartData = {
            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label               : 'Digital Goods',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label               : 'Electronics',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [65, 59, 80, 81, 56, 55, 40]
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        var lineChartData = $.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
            labels: [
                'Грузы в работе',
                'Грузы в согласовании',
                'Грузы в исполнении',
                'Грузы в архиве',
            ],
            datasets: [
                {
                    data: [
                        {{ $cargos->where('status', \App\Models\CargoLoading::IN_PROGRESS)->count() }},
                        {{ $cargos->where('status', \App\Models\CargoLoading::COORDINATION)->count() }},
                        {{ $cargos->where('status', \App\Models\CargoLoading::IN_PERFORMANCE)->count() }},
                        {{ $cargos->where('status', \App\Models\CargoLoading::ARCHIVE)->count() }}],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                }
            ]
        }
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = {
            labels: [
                'Транспорт',
                'Водители',
            ],
            datasets: [
                {
                    data: [
                        {{ $transports->count() }},
                        {{ $drivers->count() }},
                    ],
                    backgroundColor : ['#f56954', '#00a65a'],
                }
            ]
        }

        var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

        //---------------------
        //- STACKED BAR CHART -
        //---------------------
        var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
        var stackedBarChartData = $.extend(true, {}, barChartData)

        var stackedBarChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }

        new Chart(stackedBarChartCanvas, {
            type: 'bar',
            data: stackedBarChartData,
            options: stackedBarChartOptions
        })
    })
</script>

</body>
</html>
