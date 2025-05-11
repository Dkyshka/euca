<ul class="breadcrumbs">
    <li class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ url(app()->getLocale()) }}">{{ __('lang.Главная') }}</a>
    </li>
    <li class="breadcrumbs__item">
        <span class="breadcrumbs__link">{{ $section?->page?->name }}</span>
    </li>
</ul>

