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
					<div class="tarifs">
						<div class="tarifs-card current">
							<b>Free</b>

							<div class="tarifs-card__count">
								<p>Бесплатный</p>
							</div>

							<ul class="tarifs-card__list">
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Просмотр общей информации о компании.</p>
								</li>
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к новостям компании.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Просмотр каталога компании.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Возможность отправить запрос к базе данных</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Участники скрыты для создания интриги.</p>
								</li>
							</ul>

							<button class="form-btn tarif-btn" data-modal-target="modal-change-tarifs">Подключить</button>
						</div>

						<div class="tarifs-card">
							<b>Elite</b>

							<div class="tarifs-card__count">
								<p>$100</p>
								<div class="tarifs-card__desc">
									<span>30 дней</span>
									<span>тариф включает</span>
								</div>
							</div>

							<ul class="tarifs-card__list">
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к списку участников.</p>
								</li>
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к контактной информации глобальных экспедиторов.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Мгновенный обмен сообщениями.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Приоритетный рейтинг.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Приоритетный рейтинг.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Символ членства (знак участника).</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на участие в конференциях.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на выставки.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на услуги таможенной декларации</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Финансовая защита до $50,000.</p>
								</li>
							</ul>

							<button class="form-btn tarif-btn" data-modal-target="modal-change-tarifs">Подключить</button>
						</div>

						<div class="tarifs-card">
							<b>Premium</b>
							<div class="tarifs-card__count">
								<p>$150</p>
								<div class="tarifs-card__desc">
									<span>30 дней</span>
									<span>тариф включает</span>
								</div>
							</div>

							<ul class="tarifs-card__list">
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к списку участников.</p>
								</li>
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к контактной информации глобальных экспедиторов.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Мгновенный обмен сообщениями.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Приоритетный рейтинг.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Символ членства (знак участника).</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на участие в конференциях.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на выставки.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на услуги таможенной декларации</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Круглосуточная помощь бизнесу.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Услуга индивидуального членства.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Маркетинг в социальных сетях.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Маркетинг по электронной почте.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Финансовая защита до $100,000.</p>
								</li>
							</ul>

							<button class="form-btn tarif-btn" data-modal-target="modal-change-tarifs">Подключить</button>
						</div>

						<div class="tarifs-card">
							<b>VIP</b>
							<div class="tarifs-card__count">
								<p>$200</p>
								<div class="tarifs-card__desc">
									<span>30 дней</span>
									<span>тариф включает</span>
								</div>
							</div>

							<ul class="tarifs-card__list">
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к списку участников.</p>
								</li>
								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Доступ к контактной информации глобальных экспедиторов.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Мгновенный обмен сообщениями.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Приоритетный рейтинг.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Символ членства (знак участника).</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на участие в конференциях.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на выставки.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Скидка на услуги таможенной декларации</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Круглосуточная помощь бизнесу.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Услуга индивидуального членства.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Маркетинг в социальных сетях.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Маркетинг по электронной почте.</p>
								</li>

								<li>
							<span>
								<svg width="8" height="8">
									<use xlink:href="#tarif"></use>
								</svg>
							</span>
									<p>Финансовая защита до $150,000.</p>
								</li>
							</ul>

							<button class="form-btn tarif-btn" data-modal-target="modal-change-tarifs">Подключить</button>
						</div>
					</div>
				</div>
			</main>
		</div>

	</div>
</main>

<div class="modal-overlay" data-modal="modal-change-tarifs">
	<div class="modal modal-change-tarifs">
		<b>Смена тарифа</b>

		<p>
			Lorem ipsum dolor sit amet consectetur. Sagittis metus aenean convallis nulla accumsan tortor est est ornare. Pretium ornare
			congue at egestas tellus amet arcu.
		</p>

		<button class="form-btn">Подвердить</button>
		<button class="tarifs-change-btn" data-modal-close="modal-change-tarifs">Отмена</button>
	</div>
</div>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>