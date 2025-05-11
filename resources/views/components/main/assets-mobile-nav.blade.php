<div class="bottom-nav-menu">
    <ul>
        @foreach($menu as $item)
            <li>
                <a href="{{ $item->link }}" class="{{  $page->id == $item->id ? 'current' : '' }}">
                    <svg class="nav-list__icon people" width="20" height="20" aria-hidden="true">
                        @if($item->id == 2)
                            <use xlink:href="#people"></use>
                        @elseif($item->id == 3)
                            <use xlink:href="#create2"></use>
                        @elseif($item->id == 4)
                            <use xlink:href="#icon-menu"></use>
                        @elseif($item->id == 5)
                            <use xlink:href="#tel"></use>
                        @endif
                    </svg>
                    <span>{{ $item->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>