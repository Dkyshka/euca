 <x-main.assets-header :page="$page" :menu="$menu"/>

    <x-menu :page="$page"/>

    <main class="main-wrapper{{ $page->id == '3' || $page->id == '4' ? ' search-page-wrapper' : '' }}">
         @foreach ($page->sections as $key => $section)
             @if($section->status)
                 <x-dynamic-component :component="$section->type" :section="$section"/>
             @endif
         @endforeach
    </main>

 <x-main.assets-footer
     :page="$page"
     :settings="$settings"
     :footer="$footer"
 />