@php
    $isMe = $message->sender_id == auth()->user()->id;
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
