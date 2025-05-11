<section class="advantages">

    @if(!empty($section->content->one) || !empty($section->content->cards))
        <h3 class="title">
            {!! str_replace(['[', ']', '\n'], ['<strong>', '</strong>', '<br>'], $section->content->one) !!}
        </h3>
    @endif

    @if(!empty($section->content->cards))
        <div class="advantages-cards">
            @foreach($section->content->cards as $card)
                <div class="advantages-card">
                    <div class="advantages-card__head">
                        <svg width="151" height="62" style="fill: black; color: black;">
                            <use xlink:href="#{{ !empty($card->icon) ? $card->icon : 'adv' }}"></use>
                        </svg>
                        <b>{{ $card->title }}</b>
                    </div>
                    @if(!empty($card->list))
                    <ul>
                        @foreach ($card->list as $item)
                            <li>
                                <svg width="22" height="22">
                                    <use xlink:href="#check"></use>
                                </svg>
                                <p>{{ $item }}</p>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</section>