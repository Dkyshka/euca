@if($section->picture())
<div class="about-image">
    <picture>
        <source srcset="{{ asset($section->picture()->orig) }}">
        <img src="{{ asset($section->picture()->orig) }}" alt="О нас" width="400" height="318">
    </picture>
</div>
@endif

<section class="about">
    @php
    $content = $section?->content?->one;

    $content = str_replace(['<ul>', '</ul>'], '', $content);

    $content = preg_replace_callback(
        '/<li>(.*?)<\/li>/',
        function ($matches) {
            return '
                <div class="about__desc">
                    <svg width="21" height="21">
                        <use xlink:href="#success"></use>
                    </svg>
                    <p>' . $matches[1] . '</p>
                </div>';
        },
        $content
    );
    @endphp
    {!! str_replace(['<strong>', '</strong>', '<h2', '<h3', '<h4'], ['<span>', '</span>', '<h2 style="margin-bottom: max(calc(1.25 * 1vw), 15px); margin-top: max(calc(1.25 * 1vw), 15px);"',
'<h2 style="margin-bottom: max(calc(1.25 * 1vw), 15px); margin-top: max(calc(1.25 * 1vw), 15px);"', '<h2 style="margin-bottom: max(calc(1.25 * 1vw), 15px); margin-top: max(calc(1.25 * 1vw), 15px);"'], $content) !!}
</section>