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
				<form action="{{ route('update_company', app()->getLocale()) }}" method="post" class="profile-content__form" enctype="multipart/form-data">
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
								@if(auth()->user()?->company?->avatar)
									<picture>
										<source id="avatar-source" srcset="{{ asset(auth()->user()?->company?->avatar) }}">
										<img id="avatar-preview" src="{{ asset(auth()->user()?->company?->avatar) }}" width="90" height="90" alt="avatar">
									</picture>
								@else
									<picture>
										<source id="avatar-source" srcset="{{ asset('assets/images/avatar.avif') }}">
										<img id="avatar-preview" src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
									</picture>
								@endif
							</div>
							<div class="profile-content__info">
								<b>{{ auth()->user()?->company->name ?? auth()->user()->login }}</b>
								<div class="profile-content__form">
									<label for="upload" class="upload">Загрузить фото</label>
									<input type="file" id="upload" name="file" accept="image/*">
								</div>
							</div>
						</div>

							<div class="form-wrapper">
								<div class="left-col">
									<div class="input__row-profile">
										<label for="role">Название компании</label>
										<input type="text" id="role" placeholder="Компания" name="name" required value="{{ old('name', auth()->user()?->company?->name ?? '') }}">
									</div>
									<div class="input__row-profile">
										<label for="description">Описание компании</label>
										<textarea type="text" id="description" name="description" rows="5" placeholder="Описание компании" required>{{ old('description', auth()->user()?->company?->description ?? '') }}</textarea>
									</div>
									<div class="input__row-profile">
										<label for="address">Адрес компании</label>
										<input type="text" id="address" name="address" placeholder="...." required value="{{ old('address', auth()->user()?->company?->address ?? '') }}">
									</div>
									@php
										$workStartDate = auth()->user()?->company?->work_start_date;
                                        $formattedDate = \Carbon\Carbon::parse($workStartDate)?->format('Y-m-d');
									@endphp
									<div class="input__row-profile">
										<label for="work_start_date">Начало работы компании</label>
										<input type="date" id="work_start_date" name="work_start_date" placeholder="2002" required value="{{ old('work_start_date', $formattedDate ?? '') }}">
									</div>

									<div class="input__row-profile">
										<label for="employees_count">Количество сотрудников</label>
										<input type="number" id="employees_count" name="employees_count" placeholder="101-500" required value="{{ old('employees_count', auth()->user()?->company?->employees_count ?? '') }}">
									</div>

									<div class="profile-content__info">
										<div class="profile-content__form">
											<label for="upload-certificates" class="upload">Сертификаты</label>
											<input type="file" id="upload-certificates" name="certificates[]" accept="image/*" multiple>
										</div>
									</div>

									<div id="uploaded-images" class="image-container">
										@if(auth()->user()?->company?->certificates)
											@foreach(auth()->user()?->company?->certificates as $certificate)
												<div class="image-wrapper" data-certificate-id="{{ $certificate->id }}">
													<img src="{{ asset($certificate->image_path) }}">
													<button type="button" class="delete-btn">×</button>
												</div>
											@endforeach
										@endif
									</div>

								</div>
								<div class="right-col">
									<div class="input__row-profile">
										<label for="country">Страна компании</label>
										<input type="text" id="country" name="country" placeholder="Страна" required value="{{ old('country', auth()->user()?->company?->country ?? '') }}">
									</div>

									<div class="input__row-profile">
										<label for="city">Город компании</label>
										<input type="text" id="city" name="city" placeholder="Страна" required value="{{ old('city', auth()->user()?->company?->city ?? '') }}">
									</div>

									<div class="input__row-profile">
										<label for="website">Ссылка на сайт</label>
										<input type="text" id="website" name="website" placeholder="https://website.org" value="{{ old('website', auth()->user()?->company?->website ?? '') }}">
									</div>

									<div class="input__row-profile">
										<p>Направления</p>
										<select class="js-example-basic-multiple" name="directions[]" multiple="multiple">
											@foreach($directions as $direction)
											<option value="{{ $direction->id }}"
											@if(auth()->user()->company?->directions && in_array($direction->id, auth()->user()->company?->directions?->pluck('id')->toArray())) selected @endif
											>{{ $direction->name }}</option>
											@endforeach
										</select>
									</div>

									<div class="input__row-profile">
										<label for="email">Email</label>
										<div id="email-fields">
											@if(auth()->user()?->company?->emails)
											@foreach(auth()->user()?->company?->emails as $email)
											<div class="email-wrapper">
												<input type="email" name="emails[]" placeholder="euca@euca.com" class="input-email" value="{{ old('emails.' . $loop->index, $email->email) }}" required>
												<button type="button" class="delete-email">Удалить</button>
											</div>
											@endforeach
											@endif
										</div>
										<button type="button" class="add-field" id="add-email">
											<svg width="12" height="12">
												<use xlink:href="#plus"></use>
											</svg>
										</button>
									</div>

									<div class="input__row-profile">
										<label for="phone">Номер телефона</label>
										<div id="phone-fields">
											@if(auth()->user()?->company?->phones)
											@foreach(auth()->user()?->company?->phones as $phone)
											<div class="phone-wrapper">
												<input type="tel" name="phones[]" placeholder="+000 00 000 00 00" class="input-phone" value="{{ old('phones.' . $loop->index, $phone->phone) }}" required>
												<button type="button" class="delete-phone">Удалить</button>
											</div>
											@endforeach
											@endif
										</div>
										<button type="button" class="add-field" id="add-phone">
											<svg width="12" height="12">
												<use xlink:href="#plus"></use>
											</svg>
										</button>
									</div>

								</div>
							</div>
							<div class="form-buttons">
								<button type="submit" class="form-btn">Сохранить</button>
							</div>
					</div>
				</form>
			</main>
		</div>

	</div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>
<!-- Подключаем JavaScript для Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>

	document.querySelectorAll('.delete-email').forEach(button => {
		button.addEventListener('click', function() {
			this.parentElement.remove(); // Удаляем родительский элемент кнопки (email)
		});
	});

	document.querySelectorAll('.delete-phone').forEach(button => {
		button.addEventListener('click', function() {
			this.parentElement.remove(); // Удаляем родительский элемент кнопки (email)
		});
	});

	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});


	document.getElementById('upload').addEventListener('change', function(event) {
		const file = event.target.files[0];
		const reader = new FileReader();

		reader.onload = function(e) {
			document.getElementById('avatar-source').srcset = e.target.result;

			document.getElementById('avatar-preview').src = e.target.result;
		}

		if (file) {
			reader.readAsDataURL(file);
		}
	});

	document.getElementById('add-email').addEventListener('click', function() {
		const emailWrapper = document.createElement('div');
		emailWrapper.classList.add('email-wrapper');

		// Создаем новое поле для email
		const emailField = document.createElement('input');
		emailField.classList.add('input-email');
		emailField.setAttribute('type', 'email');
		emailField.setAttribute('name', 'emails[]');
		emailField.setAttribute('placeholder', 'euca@euca.com');
		emailField.setAttribute('required', 'required');

		const deleteButton = document.createElement('button');
		deleteButton.classList.add('delete-email');
		deleteButton.innerText = 'Удалить';

		deleteButton.addEventListener('click', function() {
			emailWrapper.remove();
		});

		emailWrapper.appendChild(emailField);
		emailWrapper.appendChild(deleteButton);

		document.getElementById('email-fields').appendChild(emailWrapper);
	});

	document.getElementById('add-phone').addEventListener('click', function() {
		const phoneWrapper = document.createElement('div');
		phoneWrapper.classList.add('phone-wrapper');

		const phoneField = document.createElement('input');
		phoneField.classList.add('input-phone');
		phoneField.setAttribute('type', 'tel');
		phoneField.setAttribute('name', 'phones[]');
		phoneField.setAttribute('placeholder', '+000 00 000 00 00');
		phoneField.setAttribute('required', 'required');

		// Создаем кнопку для удаления телефона
		const deleteButton = document.createElement('button');
		deleteButton.classList.add('delete-phone');
		deleteButton.innerText = 'Удалить';

		deleteButton.addEventListener('click', function() {
			phoneWrapper.remove();
		});

		// Добавляем поле и кнопку в контейнер
		phoneWrapper.appendChild(phoneField);
		phoneWrapper.appendChild(deleteButton);


		document.getElementById('phone-fields').appendChild(phoneWrapper);
	});

	document.getElementById('upload-certificates').addEventListener('change', function(event) {
		const fileInput = event.target;
		const files = fileInput.files;
		const imageContainer = document.getElementById('uploaded-images');

		// Очищаем контейнер перед добавлением новых изображений
		imageContainer.innerHTML = '';

		// Для каждого выбранного файла добавляем его в контейнер
		for (let i = 0; i < files.length; i++) {
			const file = files[i];

			// Создаем элемент для обертки изображения
			const imageWrapper = document.createElement('div');
			imageWrapper.classList.add('image-wrapper');

			// Создаем элемент img для изображения
			const img = document.createElement('img');
			img.src = URL.createObjectURL(file); // Используем объект URL для отображения изображения

			// Создаем кнопку удаления
			const deleteButton = document.createElement('button');
			deleteButton.textContent = '×'; // Символ для кнопки удаления
			deleteButton.type = 'button';
			deleteButton.classList.add('delete-btn');

			// Удаление изображения по кнопке
			deleteButton.addEventListener('click', function() {
				imageWrapper.remove(); // Удаляем элемент изображения из DOM
				fileInput.value = ''; // Очищаем input file
			});

			// Добавляем изображение и кнопку в контейнер
			imageWrapper.appendChild(img);
			imageWrapper.appendChild(deleteButton);
			imageContainer.appendChild(imageWrapper);
		}
	});

	document.querySelectorAll('.delete-btn').forEach(button => {
		button.addEventListener('click', function(event) {
			event.preventDefault();

			const certificateId = this.closest('.image-wrapper').dataset.certificateId;

			fetch(`certificate/${certificateId}`, {
				method: 'DELETE',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				}
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					this.closest('.image-wrapper').remove();
					alert(data.message);
				} else {
					alert('Ошибка при удалении сертификата');
				}
			})
			.catch(error => {
				console.error('Ошибка:', error);
				alert('Ошибка при удалении сертификата');
			});
		});
	});
</script>
</body>
</html>