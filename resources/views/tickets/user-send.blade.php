<div class="msg right-msg mt-3">
    <div class="msg-img" style="background-image: url({{ URL::asset('assets/images/users.png') }})">
    </div>

    <div class="msg-bubble">
        <div class="msg-info">
            <div class="msg-info-name">{{ Auth::user()->name }}</div>
            <div class="msg-info-time">{{ \Carbon\Carbon::parse($last->created_at)->diffForHumans() }}</div>
        </div>
        <div class="msg-text">
            {{ $last->message }}
        </div>
    </div>
</div>