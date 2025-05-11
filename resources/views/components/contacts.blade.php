<section class="contacts">

    <div class="contacts__info">
        <div class="navigations">
            <a href="{{ url(app()->getLocale()) }}">{{ __('lang.Главная') }}</a>
            /<a class="active" href="{{ $section->page->link }}">{{ $section->page->name }}</a>
        </div>
        <h1 class="title">{{ $section->page->name }}</h1>
        {!! str_replace(['<strong>', '</strong>'], ['<b>', '</b>'], $section->content?->one) !!}

        @php
            $phones = explode(',', $settings->markup['phones'][0] ?? '');
            $emails = explode(',', $settings->markup['emails'][0] ?? '');
        @endphp

        <div class="contacts__cards">
            <div class="welcome-card">
				<span class="weelcome-card__icon">
					<svg width="16" height="16">
						<use xlink:href="#tel"></use>
					</svg>
				</span>
                <div class="welcome-card__info">
                    <b>{{ __('lang.Наши телефоны') }}</b>
                    @foreach($phones as $phone)
                    <a href="tel:{{ str_replace(['-', '(', ')', ' '], '', trim($phone)) }}">{{ trim($phone) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="welcome-card">
				<span class="weelcome-card__icon">
					<svg width="18" height="12">
						<use xlink:href="#email"></use>
					</svg>
				</span>
                <div class="welcome-card__info">
                    <b>{{ __('lang.Наши адреса электронной почты') }}</b>
                    @foreach($emails as $email)
                    <a href="mailto:{{ trim($email) }}">{{ trim($email) }}</a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="map" id="myMap">
        <picture>
            <source srcset="{{ asset('assets/images/map.avif') }}">
            <img src="{{ asset('assets/images/map.jpg') }}" alt="карты" width="900" height="670">
        </picture>
    </div>
</section>
<script async src="https://api-maps.yandex.ru/v3/?apikey=49817d12-35af-402e-82b9-91b83b18ac74&lang=ru_RU"></script>
<script>
    let urlPin = "{{ asset('assets/images/svg/map-pin.svg') }}";

    const COORDINATES = [{{ $settings->markup['coordinates']['lat'] ?? '' }}, {{ $settings->markup['coordinates']['long'] ?? '' }}];

</script>
