<x-main.assets-header :menu="$menu"/>

<x-menu :page="$page"/>

<main class="main-wrapper">
    <section class="main-head">

        <div class="main-head__desc main-head__desc-inner">

            <div class="navigations">
                <a href="{{ url(app()->getLocale()) }}">{{ __('Главная') }}</a>/<a href="{{ url($page->link) }}">{{ $page->name }}</a>/<a class="active" href="javascript:;">{{ Str::limit($article->name, 20) }}</a>
            </div>


            <div class="main__inner-cards">
                <div class="main__inner-card">
                    <div class="main-inner-card__title number">{{ $article->id }}</div>
                    <div class="main-inner-card__desc">{{ __('lang.Номер ID') }}</div>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    @if($article->status_id == 3)
                        <img src="{{ asset('assets/images/statuses/Untitled-3V.png') }}" style="height: 40px; width: auto;">
                    @endif
                    @if($article->status_id == 4)
                        <img src="{{ asset('assets/images/statuses/Start green.png') }}" style="height: 40px; width: auto;">
                    @endif
                    @if($article->status_id == 2)
                        <img src="{{ asset('assets/images/statuses/Pro green.png') }}" style="height: 40px; width: auto;">
                    @endif
                    @if($article->is_partner)
                        <img src="{{ asset('assets/images/statuses/Partner.png') }}" style="height: 40px; width: auto;">
                    @else
                        <img src="{{ asset('assets/images/statuses/Member.png') }}" style="height: 40px; width: auto;">
                    @endif
                </div>
            </div>
            <div class="main__inner-image">
                @if($article->avatar)
                <picture>
                    <source srcset="{{ asset($article->avatar) }}">
                    <img src="{{ asset($article->avatar) }}" width="267" height="62">
                </picture>
                @endif
            </div>

            <h1><span class="count"></span>{{ $article->name }}</h1>

            @if($article->directions->isNotEmpty())
            <div class="catalog-card__tags">
                @foreach($article->directions as $direction)
                <span>{{ $direction->name }}</span>
                @endforeach
            </div>
            @endif

            @auth

                <div class="order-icons">
                <a class="catalog-inner__link" href="javascript:;" data-modal-target="dropdown-chat1">{{ __('lang.Связаться') }}</a>

                    <div class="order-cansel-dropdown order-cansel-modal" data-modal="dropdown-chat1" style="top: -100%;left: 0;">
                        <button class="order-close-btn" data-modal-close="dropdown-chat1"></button>
                        <div class="tr">
                            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"></path>
                            </svg>
                        </div>
                        <b>{{ __('lang.Отправить сообщение') }}</b>
                        <form action="{{ route('chats.getOrCreatePrivate', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" class="chat-form">
                            @csrf
                            <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $article->user->id }}">
                            <textarea required name="message" style="height: auto; overflow: hidden"></textarea>

                            <button class="form-btn" data-modal-close="dropdown-chat1">{{ __('lang.Отправить') }}</button>
                            <button type="button" class="order-cansel" data-modal-close="dropdown-chat1">{{ __('lang.Отмена') }}</button>
                        </form>

                    </div>
                </div>
            @else
                <a class="catalog-inner__link" data-modal-target="modal-login" href="javascript:;">{{ __('lang.связаться') }}</a>
            @endauth
        </div>

        <div class="main-head__img main-head__img-inner">
            <picture>
                <source srcset="{{ asset('assets/images/main-head-2.avif') }}">
                <img srcset="{{ asset('assets/images/main-head-2.png') }}" width="750" height="736">
            </picture>
        </div>

    </section>

    <section class="catalog-inner__info">

        <div class="catalog-inner__left">
            <h3 class="catalog-inner__title title">{{ __('lang.Подробная информация') }}</h3>

            <div class="catalog-inner__card">
                <div class="catalog-card__desc">
                    <svg width="15" height="15">
                        <use xlink:href="#planet"></use>
                    </svg>
                    <b>{{ __('lang.Местоположение:') }}</b>
                </div>
                <p>{{ $article?->country }}</p>
            </div>

            <div class="catalog-inner__card">

                <div class="catalog-card__desc">
                    <svg width="12" height="15">
                        <use xlink:href="#location"></use>
                    </svg>
                    <b>{{ __('lang.Адрес:') }}</b>

                </div>
                <p>{{ $article->address }}</p>
            </div>

            <div class="catalog-inner__card">

                <div class="catalog-card__desc">
                    <svg width="15" height="15">
                        <use xlink:href="#time"></use>
                    </svg>
                    <b>{{ __('lang.Начало работы компании:') }}</b>

                </div>
                <p>{{ $article->work_start_date?->format('Y') }}</p>
            </div>

            <div class="catalog-inner__card">
                <div class="catalog-card__desc">
                    <svg width="30" height="14">
                        <use xlink:href="#people"></use>
                    </svg>
                    <b>{{ __('lang.Количество сотрудников:') }}</b>

                </div>
                <p>{{ $article?->employees_count }}</p>
            </div>

            <div class="catalog-inner__card">

                <div class="catalog-card__desc">
                    <svg width="15" height="15">
                        <use xlink:href="#world"></use>
                    </svg>
                    <b>{{ __('lang.Ссылка на сайт:') }}</b>
                </div>

                <a href="{{ $article->website }}" target="_blank">{{ $article->website }}</a>
            </div>

        </div>

        <div class="catalog-inner__right">

            <div class="swiper catalog-inner__slider">


                <button class="catalog-inner__btn catalog-btn-left" aria-label="переключение слайдов в лево">
                    <svg width="15" height="15">
                        <use xlink:href="#arrow-left"></use>
                    </svg>
                </button>
                <button class="catalog-inner__btn catalog-btn-right" aria-label="переключение слайдов в право">
                    <svg width="12" height="12">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </button>

                @php
                    $certificates = $article->certificates;
                    $count = $certificates->count();
                @endphp
                @if($count > 0)
                <div class="swiper-wrapper catalog-inner__container">
                        @foreach($certificates as $certificate)
                            <div class="swiper-slide catalog-inner__slide">
                                <picture>
                                    <source srcset="{{ asset($certificate->image_path) }}">
                                    <img srcset="{{ asset($certificate->image_path) }}" width="997" height="503" alt="сертификат" loading="lazy">
                                </picture>
                            </div>
                        @endforeach

                        @if($count === 1)
                            {{-- дублируем тот же слайд ещё 2 раза --}}
                            @for($i = 0; $i < 2; $i++)
                                <div class="swiper-slide catalog-inner__slide">
                                    <picture>
                                        <source srcset="{{ asset($certificates[0]->image_path) }}">
                                        <img srcset="{{ asset($certificates[0]->image_path) }}" width="997" height="503" alt="сертификат" loading="lazy">
                                    </picture>
                                </div>
                            @endfor
                        @elseif($count === 2)
                            {{-- дублируем первый слайд один раз --}}
                            <div class="swiper-slide catalog-inner__slide">
                                <picture>
                                    <source srcset="{{ asset($certificates[0]->image_path) }}">
                                    <img srcset="{{ asset($certificates[0]->image_path) }}" width="997" height="503" alt="сертификат" loading="lazy">
                                </picture>
                            </div>
                        @endif
                </div>
                @endif

            </div>

        </div>

    </section>

    <section class="catalog-profile">
        <div class="catalog-profile__info">
            <h3>{{ __('lang.Профиль компании') }}</h3>
            {{ $article->description }}
        </div>

    </section>


    <section class="contacts-info">
        <h3>{{ __('lang.Контакты') }}</h3>
        <div class="contacts-card">
            <b>{{ __('lang.Номер телефона:') }}</b>
            @if($article->phones->isNotEmpty())
            @foreach($article->phones as $phone)
            <a href="tel:{{ trim(str_replace([' ', '-', '(', ')'], '',$phone->phone)) }}">{{ $phone->phone }}</a>
            @endforeach
            @endif
        </div>
        <div class="contacts-card">
            <b>Email</b>
            @if($article->emails->isNotEmpty())
            @foreach($article->emails as $email)
            <a href="mailto:{{ $email->email }}">{{ $email->email }}</a>
            @endforeach
            @endif
        </div>
    </section>

    <x-main.assets-footer :footer="$footer" :settings="$settings"/>

</main>
