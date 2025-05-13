<x-main.assets-header-profile :page="$page"/>

<main class="main-wrapper">
    <div class="profile-page">

        <x-main.assets-sidebar/>

        <x-main.assets-mobile-nav :menu="$menu" :page="$page"/>

        <div class="profile-settings">
            <header class="profile-header">
                <button class="nav__btn-header" aria-label="навигационное меню">
			    <span>
				<span></span>
			    </span>
                </button>

                <button class="go-back">
                    <svg width="20" height="20">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                </button>

                <h1>{{ $page->name }}</h1>

                <x-main.assets-notification/>

                <x-main.assets-avatar/>
            </header>

            <main class="profile-content">
                <div class="profile-content__messages">
                    <div class="{{ $activeChat ? 'chat-mobile__hide ' : '' }}users-messages">
                        @forelse($chats as $chat)
                            @php
                                $lastMessage = $chat->messages->first();
                                $otherUser = $chat->users->first();
                            @endphp
                            <a href="{{ route('messages', [app()->getLocale(), $chat]) }}" class="user-message {{ optional($activeChat)->id === $chat->id ? 'active' : '' }}">
                                @if($otherUser->avatar)
                                <div class="user-message__image">
                                    <picture>
                                        <source srcset="{{ asset($otherUser->avatar) }}">
                                        <img src="{{ asset($otherUser->avatar) }}" width="90" height="90" alt="avatar">
                                    </picture>
                                </div>
                                @else
                                <div class="user-message__image">
                                    <picture>
                                        <source srcset="{{ asset('assets/images/avatar.avif') }}">
                                        <img src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
                                    </picture>
                                </div>
                                @endif
                                <div class="user-message__info">
                                    <b>{{ $otherUser->name ?? 'Неизвестный пользователь' }}</b>
                                    <p>{{ Str::limit($lastMessage?->message, 35) ?? 'Нет сообщений' }}</p>
                                </div>
                                <div class="user-message__date">
                                    <span>{{ optional($lastMessage?->created_at)->format('d.m.Y') }}</span>
                                    @if($chat->unread_count > 0 && (!isset($activeChat) || $activeChat->id !== $chat->id))
                                        <div class="menu-count">{{ $chat->unread_count }}</div>
                                    @endif
                                </div>
                            </a>
                        @empty

                        @endforelse
                    </div>

                    @if($activeChat)
                        <div class="chat chat-window">
                            @foreach($activeChat->messages->sortBy('created_at') as $message)
                                @php
                                    $isMe = $message->user_id === auth()->id();
                                    $class = $isMe ? 'request' : 'response';
                                @endphp

                                <div class="{{ $class }}">
                                    <p>{{ $message->message }}</p>

                                    @foreach($message->attachments as $file)
                                        <a href="{{ Storage::url($file->path) }}" target="_blank" class="message_file">
                                            {{ $file->original_name }}
                                        </a>
                                    @endforeach

                                    <br><br>
                                    <small>{{ $message->created_at->format('H:i') .' / '. $message->created_at->format('d.m.Y') }}</small>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('messages.send', [app()->getLocale(), $activeChat->id]) }}" id="chatForm" class="chat-bottom" enctype="multipart/form-data">
                            @csrf
                            <div class="input-chat">
                                <div class="chat-typing">
                                    <label for="uploaded" class="download">
                                        <svg width="17" height="16"><use xlink:href="#add"></use></svg>
                                    </label>
                                    <input type="file" name="files[]" id="uploaded" class="input-file" multiple>

                                    <label for="chat_text" class="chat-send">
                                        <textarea name="message" id="chat_text" placeholder="Напишите сообщение" cols="1" rows="1"></textarea>
                                    </label>
                                </div>
                                <button class="chat-btn" type="submit">
                                    <svg width="20" height="20"><use xlink:href="#chat"></use></svg>
                                </button>
                            </div>
                            <div id="filePreview" class="file-preview"></div>

                        </form>

                    @else
                        <div class="chat chat-mobile__hide">
                            <div class="chat-empty">
                                <svg width="85" height="85">
                                    <use xlink:href="#message"></use>
                                </svg>
                                <p>Выберите чат и начните общение с грузоперевозчиком или предпринимателем</p>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>

    </div>
</main>

<script src="{{ asset('assets/js/main.min.js') }}"></script>

</body>
</html>