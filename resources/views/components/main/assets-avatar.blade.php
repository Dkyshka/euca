<a class="profile" href="javascript:;">
    @if(auth()->user()->avatar)
        <picture>
            <source srcset="{{ asset(auth()->user()->avatar) }}">
            <img src="{{ asset(asset(auth()->user()->avatar)) }}" width="90" height="90" alt="avatar">
        </picture>
    @else
        <picture>
            <source srcset="{{ asset('assets/images/avatar.avif') }}">
            <img src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
        </picture>
    @endif
    <div class="profile__info">
        <b>{{ Str::limit(auth()->user()->login, 20) }}</b>
        <span>{{ auth()->user()->role->alias }}</span>
    </div>
</a>