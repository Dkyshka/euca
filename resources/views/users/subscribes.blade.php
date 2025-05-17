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
				<div class="profile-content__wrapper">
					<div class="subscribe-card">
						<p>Ваш ID: {{ auth()->user()->id }}</p>
						<p>На вашем балансе: 0</p>
						<p>Расход: 0</p>
						<div class="subscribe-card__images">
							<div class="card-pay">
								<picture>
									<source srcset="{{ asset('assets/images/visa.avif') }}">
									<img src="{{ asset('assets/images/visa.png') }}" alt="карта" width="90" height="50">
								</picture>
							</div>
							<div class="card-pay">
								<picture>
									<source srcset="{{ asset('assets/images/master-card.avif') }}">
									<img src="{{ asset('assets/images/master-card.png') }}" alt="карта" width="90" height="50">
								</picture>
							</div>
						</div>

						<form action="" method="GET">
							<label for="sum">
								<input type="number" name="sum" id="sum" placeholder="Введите сумму">
							</label>
							<button class="form-btn">Пополнить баланс</button>
						</form>
					</div>
				</div>
			</main>
		</div>

	</div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>