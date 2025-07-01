@php
    $notification = \App\Models\Notification::where('user_id', auth()->user()->id)->where('is_read', false)->orderBy('id', 'desc')->get();
@endphp
<div class="has-notifications profile-notifications {{ $notification->count() > 0 ? 'has-unread' : '' }}">
    <svg width="16" height="18">
        <use xlink:href="#notifications"></use>
    </svg>

    <div class="notifications-modal">
        <div class="tr">
            <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.8433 1.44929C15.6365 0.276561 17.3635 0.276559 18.1567 1.44929L32.1431 22.1293C33.0414 23.4575 32.0898 25.2498 30.4864 25.2498H2.51359C0.910168 25.2498 -0.041364 23.4575 0.856918 22.1293L14.8433 1.44929Z" fill="white"/>
            </svg>
        </div>

        <div class="notifications-modal__head">


            <a href="#" id="markAllAsRead" data-url="{{ route('allread', app()->getLocale()) }}" class="read">{{ __('lang.Сделать прочитанным') }}</a>

            <div class="notifications-modal__btn">
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="notifications-modal__content">
            @if($notification->isEmpty())
            <div class="notifications-modal__card">
                <p>{{ __('lang.Пусто') }}</p>
            </div>
            @else
            @foreach($notification as $item)
            <div class="notifications-modal__card">
                <b>{{ $item->created_at?->format('d.m.Y H:i') }}</b>
                <b>{{ $item->title }}</b>
                <p>{!! Str::limit($item->body, 500) ?? '' !!}</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>