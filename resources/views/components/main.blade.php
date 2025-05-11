    <section class="main-head">
        <div class="main-head__desc">

            {!! $section->content?->one !!}

            @guest
            <button type="button" aria-label="странница регистрации" class="main-head__link" data-modal-target="modal-register">
                <b>{{ __('lang.Зарегистрироваться') }}</b>
                <span>
				<svg width="13" height="12">
					<use xlink:href="#arrow-right"></use>
				</svg>
			</span>
            </button>
            @endguest
        </div>

        <div class="main-head__img">
            @if($section->picture())
            <picture>
                <source srcset="{{ asset($section->picture()->orig) }}">
                <img srcset="{{ asset($section->picture()->orig) }}" width="750" height="736">
            </picture>
            @endif
        </div>

    </section>