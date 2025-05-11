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

                <h1>{{ $page->name }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">


                <div class="notifications__list">
                    <div class="goods-head notifications-head">
                        <a href="./add-goods.html" class="form-btn">
                            <svg width="11" height="12">
                                <use xlink:href="#plus"></use>
                            </svg>
                            Добавить груз
                        </a>
                    </div>
                </div>

                <div class="goods-empty notifications-empty">
                    <picture>
                        <source srcset="./images/goods.avif">
                        <img src="./images/goods.png" alt="empty" width="85" height="85">
                    </picture>
                    <p>Здесь будут ваши грузы</p>
                    <a href="./add-goods.html" class="form-btn">
                        Добавить груз
                    </a>
                </div>


            </main>
        </div>

    </div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>