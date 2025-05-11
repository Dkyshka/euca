<section class="reviews">
    @if($reviews->isNotEmpty())
    <div class="reviews-head">
        <h3 class="title">
            {!! str_replace(['[', ']', '\n'], ['<strong>', '</strong>', '<br>'], $section->content->one) !!}
        </h3>

        <div class="reviews__buttons">
            <button type="button" class="reviews__btn reviews__btn-left" aria-label="переключение слайдов в лево">
                <svg width="13" height="12">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </button>

            <button type="button" class="reviews__btn reviews__btn-right" aria-label="переключение слайдов в право">
                <svg width="13" height="12">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </button>

        </div>

    </div>

    <div class="swiper reviews__slider">
        <div class="swiper-wrapper reviews__slider-container">
            @foreach($reviews as $review)
            <div class="swiper-slide reviews__slide">
                <div class="reviews__slide-head">
                    @if($review->picture())
                    <div class="reviews__slide-image">
                        <picture>
                            <source srcset="{{ asset($review->picture()->avif) }}">
                            <img src="{{ asset($review->picture()->orig) }}" alt="отзывы" width="80" height="80">
                        </picture>
                    </div>
                    @endif

                    <div class="reviews__slide-name">
                        <b>{{ $review->name }}</b>
                        @if($review?->country)
                        <div class="reviews-location">
                            <svg width="8" height="15">
                                <use xlink:href="#pick"></use>
                            </svg>
                            {{ $review->country }}
                        </div>
                        @endif
                    </div>

                </div>
                {!! $review->content?->one !!}
            </div>
            @endforeach

        </div>
    </div>
    @endif


    <div class="reviews-start">
        <h3 class="title">
            {!! str_replace(['[', ']', '\n'], ['<strong>', '</strong>', '<br>'], $section->content->two) !!}
        </h3>
        <div class="reviews-col">
            {!! $section->content->three !!}
            @guest
            <div class="reviews-col__links">
                <button type="button" class="reviews-logout" data-modal-target="modal-login">Войти</button>
                <button type="button" class="reviews-register" data-modal-target="modal-register">Зарегистрироваться</button>
            </div>
            @endguest
        </div>
    </div>

</section>
