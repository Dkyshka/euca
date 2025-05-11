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
				<form action="{{ route('update_profile', app()->getLocale()) }}" method="post" class="profile-content__form" enctype="multipart/form-data">
				@csrf
				@if($errors->any())
					<div class="alert alert-danger" style="margin-bottom: 20px;">
						<ul>
							@foreach($errors->all() as $error)
								<li style="color: red;">{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="profile-content__wrapper">
					<div class="profile-content__name">
						<div class="profile-content__image" style="width: 90px; height: 90px;">
							@if(auth()->user()->avatar)
							<picture>
								<source id="avatar-source" srcset="{{ asset(auth()->user()->avatar) }}">
								<img id="avatar-preview" src="{{ asset(auth()->user()->avatar) }}" width="90" height="90" alt="avatar">
							</picture>
							@else
							<picture>
								<source id="avatar-source" srcset="{{ asset('assets/images/avatar.avif') }}">
								<img id="avatar-preview" src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
							</picture>
							@endif
						</div>
						<div class="profile-content__info">
							<b>{{ auth()->user()->login }}</b>
							<div class="profile-content__form">
								<label for="upload" class="upload">Загрузить фото</label>
								<input type="file" id="upload" name="file" accept="image/*">
							</div>
						</div>
					</div>

						<div class="form-wrapper">
							<div class="left-col">
								<div class="input__row-profile">
									<label for="name">Фамилия Имя Отчество</label>
									<input type="text" id="name" placeholder="Имя Фамилия" required name="full_name" value="{{ auth()->user()->full_name ?? '' }}">
								</div>
								<div class="input__row-profile">
									<label for="tel">Номер телефона</label>
									<input type="tel" id="tel" placeholder="+7(928) 468-61- 30" required name="tel" value="{{ auth()->user()->phone ?? '' }}">
								</div>

								<div class="input__row-profile">
									<label for="email">Электронная почта</label>
									<input type="email" id="email" placeholder="info@textmail.ru" required name="email" value="{{ auth()->user()->email ?? '' }}">
								</div>

{{--								<button type="button" class="add-field">--}}
{{--									<svg width="12" height="12">--}}
{{--										<use xlink:href="#plus"></use>--}}
{{--									</svg>--}}
{{--								</button>--}}
							</div>
							<div class="right-col">

								<div class="input__row-profile">
									<p>Пароль</p>

									<label for="password">
										<input type="password" name="password" id="register" placeholder="Введите пароль">
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

								<div class="input__row-profile">
									<label for="inn">Инн</label>
									<input type="text" id="inn" placeholder="25294594655" name="inn" value="{{ auth()->user()->inn ?? '' }}">
								</div>
							</div>
						</div>
						<div class="form-buttons">
							<button type="submit" class="form-btn">Сохранить</button>
						</div>
					</form>
				</div>
			</main>
		</div>

	</div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

<script>
	document.getElementById('upload').addEventListener('change', function(event) {
		const file = event.target.files[0]; // Получаем первый файл
		const reader = new FileReader();   // Создаем новый FileReader

		reader.onload = function(e) {
			// Обновляем srcset в <source>
			document.getElementById('avatar-source').srcset = e.target.result;

			// Обновляем src в <img>
			document.getElementById('avatar-preview').src = e.target.result;
		}

		if (file) {
			reader.readAsDataURL(file); // Читаем файл как URL данных
		}
	});
</script>
</body>
</html>

{{--<x-main.assets-footer :footer="$footer" :settings="$setting"/>--}}