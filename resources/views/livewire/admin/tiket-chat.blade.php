<div>

    <style>
        .chat-message .message-in,
        .chat-message .message-out {
            margin-bottom: 5px !important;
        }

        .msg-content {
            position: relative;
            /* Ensure that the time can be positioned absolutely within this container */
            padding-right: 50px;
            /* Add some padding to the right to make space for the time */
        }

        .message-time {
            display: flex;
            justify-content: flex-end;
            position: relative;
            font-size: 10px;
            color: #ffffff80;
            background-color: transparent;
            border-radius: 3px;
            padding: 2px 4px;
        }

        .cs .message-time {
            display: flex;
            justify-content: flex-end;
            position: relative;
            font-size: 10px;
            color: #00000080;
            background-color: transparent;
            border-radius: 3px;
            padding: 2px 4px;
        }

        .message-input-group {
            display: flex;
            align-items: center;
        }

        #message-input {
            flex: 1;
            margin-right: 10px;
            /* Adjust the value to your preference */
        }
    </style>
    <div id="title-page" data-value="Live Chat" data-value2="Ticket"></div>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <div class="row" style="margin-bottom:30px;"><!-- [ sample-page ] start -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header fw-bold p-3 text-xss"><i class="fas fa-info-circle me-1"></i>Informasi</div>
                <div class="card-body p-0" style="margin-bottom: -16px;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Ticket ID</span><br>
                                        {{ $ticket->ticket_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Subjek</span><br>
                                        {{ $ticket->subject }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Tipe</span><br>
                                        {{ ucfirst($ticket->type_ticket) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Status</span><br>
                                        @if ($ticket->status == 'open')
                                            <span class="btn btn-light-success btn-sm font-size-13">OPEN</span>
                                        @else
                                            <span class="btn btn-light-danger btn-sm font-size-13">CLOSE</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Pembaruan Terakhir</span><br>
                                        @php
                                            $respon = App\Models\TicketChat::where('ticket_id', $ticket->ticket_id)
                                                ->latest()
                                                ->first();
                                        @endphp

                                        @if ($respon)
                                            {{ $respon->updated_at->diffForHumans() }}
                                        @else
                                            {{ $ticket->created_at->diffForHumans() }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('ticket/list') }}"
                        class="btn btn-primary btn-sm waves-effect waves-light float-end"><i
                            class="mdi mdi-arrow-left-circle-outline me-1"></i>Kembali</a>
                </div>
            </div>
        </div>
        @php
            $user = App\Models\User::find($ticket->user_id);
        @endphp
        <div class="col-md-8">
            <div class="chat-wrapper">
                <div class="chat-content">
                    <div class="card mb-0">
                        <div class="card-header p-3">
                            <div class="d-flex align-items-center">
                                <ul class="list-inline me-auto mb-0">
                                    <li class="list-inline-item align-bottom"><a href="javascript:void(0)" <li
                                            class="list-inline-item">
                                            <div class="d-flex align-items-center">
                                                <div class="chat-avtar"><img class="rounded-circle img-fluid wid-40"
                                                        src="{{ asset('assets/images/users.png') }}" alt="User image">
                                                    <i class="chat-badge bg-success"></i>
                                                </div>
                                                <div class="flex-grow-1 mx-3  d-sm-inline-block">
                                                    <h6 class="mb-0">{{ $user->name }}</h6><span
                                                        class="text-sm text-muted">MEMBER
                                                        {{ strtoupper($user->level) }}</span>
                                                </div>
                                            </div>
                                    </li>
                                </ul>
                                <ul class="list-inline ms-auto mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="d-xxl-none avtar avtar-s btn-link-secondary"
                                            data-bs-toggle="offcanvas" data-bs-target="#"><i
                                                class="ti ti-info-circle f-18"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-none d-xxl-inline-flex avtar avtar-s btn-link-secondary"
                                            data-bs-toggle="collapse" data-bs-target="#chat-"><i
                                                class="ti ti-info-circle f-18"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="scroll-block chat-message simplebar-scrollable-y" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content"
                                            style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <div class="card-body">
                                                    @php
                                                        $chat = App\Models\TicketChat::where(
                                                            'ticket_id',
                                                            $ticket->ticket_id,
                                                        )->get();
                                                        $id_user = '';
                                                        $id_admin = '';
                                                    @endphp
                                                    @foreach ($chat as $row)
                                                        @php
                                                            $message = $row->message;
                                                            $maxLength = 50;
                                                            while (strlen($message) > 0) {
                                                                if (strlen($message) > $maxLength) {
                                                                    // Find the position to split the message
                                                                    $splitPos = strpos(
                                                                        substr($message, 0, $maxLength),
                                                                        ' ',
                                                                        $maxLength - 10,
                                                                    );
                                                                    if ($splitPos === false) {
                                                                        // If no space is found, split at maxLength
                                                                        $splitPos = $maxLength;
                                                                    }
                                                                    // Print the part of the message and continue
                                                                    $row->message = substr($message, 0, $splitPos);
                                                                    // Remove the printed part from the message
                                                                    $message = substr($message, $splitPos);
                                                                } else {
                                                                    // Print the remaining part of the message
                                                                    $row->message = $message;
                                                                    $message = '';
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($row->type == 'admin')
                                                            <div class="message-out">
                                                                <div class="d-flex align-items-end flex-column">
                                                                    <div
                                                                        class="message d-flex align-items-end flex-column">
                                                                        <div
                                                                            class="d-flex align-items-center mb-1 chat-msg">
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <div class="msg-content bg-primary">
                                                                                    <p class="mb-0">
                                                                                        {{ $row->message }}
                                                                                    </p>
                                                                                    <span class="message-time">
                                                                                        @if ($row->created_at->format('Y-m-d') == now()->format('Y-m-d'))
                                                                                            {{ $row->created_at->diffForHumans() }}
                                                                                        @else
                                                                                            {{ $row->created_at->format('d M Y H:i:s') }}
                                                                                        @endif
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="message-in">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="chat-avtar"><img
                                                                                class="rounded-circle img-fluid wid-40"
                                                                                src="{{ asset('assets/images/users.png') }}"
                                                                                alt="User image"> <i
                                                                                class="chat-badge bg-success"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 mx-3">
                                                                        <div
                                                                            class="d-flex align-items-start flex-column">
                                                                            <p class="mb-1 text-muted">
                                                                                {{ $user->name }}
                                                                            </p>
                                                                            <div
                                                                                class="message d-flex align-items-start flex-column">
                                                                                <div
                                                                                    class="d-flex align-items-center mb-1 chat-msg">
                                                                                    <div class="flex-grow-1 me-3">
                                                                                        <div
                                                                                            class="msg-content cs card mb-0">
                                                                                            <p class="mb-0">
                                                                                                {{ $row->message }}
                                                                                            </p>

                                                                                            <span class="message-time">
                                                                                                @if ($row->created_at->format('Y-m-d') == now()->format('Y-m-d'))
                                                                                                    {{-- {{ $row->created_at->format('h:i A') }} --}}
                                                                                                    {{ $row->created_at->diffForHumans() }}
                                                                                                @else
                                                                                                    {{ $row->created_at->format('d M Y H:i:s') }}
                                                                                                @endif
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 897px; height: 784px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 187px; transform: translate3d(0px, 196px, 0px); display: block;">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-2 px-3">
                            <div class="message-input-group">
                                <input type="text" class="form-control border-0 shadow-none" id="message-input"
                                    placeholder="Type a Message">
                                <button class="btn btn-primary" id="buttonSend" type="button">
                                    Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-xxl offcanvas-end chat-offcanvas" tabindex="-1" id="offcanvas_User_info">
                    <div class="offcanvas-header"><button class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#offcanvas_User_info" aria-label="Close"></button></div>
                    <div class="offcanvas-body p-0">
                        <div id="chat-user_info" class="collapse collapse-horizontal">
                            <div class="chat-user_info">
                                <div class="card">
                                    <div class="text-center card-body position-relative pb-0">
                                        <h5 class="text-start">Profile View</h5>
                                        <div class="position-absolute end-0 top-0 p-3 d-none d-xxl-inline-flex"><a
                                                href="javascript:void(0)"
                                                class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                data-bs-toggle="collapse" data-bs-target="#chat-user_info"><i
                                                    class="ti ti-x f-16"></i></a></div>
                                        <div class="chat-avtar d-inline-flex mx-auto"><img
                                                class="rounded-circle img-fluid wid-100"
                                                src="{{ asset('assets/images/users.png') }}" alt="User image"></div>
                                        <h5 class="mb-0">Customer Service</h5>
                                        <p class="text-muted text-sm">Sr. Customer Manager</p>
                                        <div class="d-flex align-items-center justify-content-center mb-4"><i
                                                class="chat-badge bg-success me-2"></i> <span
                                                class="badge bg-light-success">Available</span></div>
                                        <ul class="list-inline ms-auto mb-0">
                                            <li class="list-inline-item"><a href="javascript:void(0)"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-phone-call f-18"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-message-circle f-18"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-video f-18"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="scroll-block" data-simplebar="init">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0"
                                                        role="region" aria-label="scrollable content"
                                                        style="height: auto; overflow: hidden;">
                                                        <div class="simplebar-content" style="padding: 0px;">
                                                            <div class="card-body">
                                                                <div
                                                                    class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                                                                    <label class="form-check-label h5 mb-0"
                                                                        for="customSwitchemlnot1">Notification</label>
                                                                    <input
                                                                        class="form-check-input h5 m-0 position-relative"
                                                                        type="checkbox" id="customSwitchemlnot1"
                                                                        checked="">
                                                                </div>
                                                                <hr class="my-3 border border-secondary-subtle"><a
                                                                    class="btn border-0 p-0 text-start w-100"
                                                                    data-bs-toggle="collapse" href="#filtercollapse2">
                                                                    <div class="float-end"><i
                                                                            class="ti ti-chevron-down"></i></div>
                                                                    <h5 class="mb-0">File type</h5>
                                                                </a>
                                                                <div class="collapse show" id="filtercollapse2">
                                                                    <div class="py-3">
                                                                        <div class="d-flex align-items-center mb-2"><a
                                                                                href="javascript:void(0)"
                                                                                class="avtar avtar-s btn-light-success"><i
                                                                                    class="ti ti-file-text f-20"></i></a>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <h6 class="mb-0">Document</h6><span
                                                                                    class="text-muted text-sm">123
                                                                                    files,
                                                                                    193MB</span>
                                                                            </div><a href="javascript:void(0)"
                                                                                class="avtar avtar-xs btn-link-secondary"><i
                                                                                    class="ti ti-chevron-right f-16"></i></a>
                                                                        </div>
                                                                        <div class="d-flex align-items-center mb-2"><a
                                                                                href="javascript:void(0)"
                                                                                class="avtar avtar-s btn-light-warning"><i
                                                                                    class="ti ti-photo f-20"></i></a>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <h6 class="mb-0">Photos</h6><span
                                                                                    class="text-muted text-sm">53
                                                                                    files,
                                                                                    321MB</span>
                                                                            </div><a href="javascript:void(0)"
                                                                                class="avtar avtar-xs btn-link-secondary"><i
                                                                                    class="ti ti-chevron-right f-16"></i></a>
                                                                        </div>
                                                                        <div class="d-flex align-items-center mb-2"><a
                                                                                href="javascript:void(0)"
                                                                                class="avtar avtar-s btn-light-primary"><i
                                                                                    class="ti ti-id f-20"></i></a>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <h6 class="mb-0">Other</h6><span
                                                                                    class="text-muted text-sm">49
                                                                                    files,
                                                                                    193MB</span>
                                                                            </div><a href="javascript:void(0)"
                                                                                class="avtar avtar-xs btn-link-secondary"><i
                                                                                    class="ti ti-chevron-right f-16"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="height: 0px; display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- [ sample-page ] end -->
    </div>
</div>
@script
    <script>
        let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: 'ap1'
        });

        let channel = pusher.subscribe('chat');
        channel.bind('chat-live', function(data) {
            if (data.ticket_id == '{{ $ticket->ticket_id }}') {
                $wire.refresh(data);
            }
        });

        $('#message-input').keypress(function(e) {
            if (e.which == 13) {
                var message = $('#message-input').val();
                if (message != '') {
                    $('#message-input').val('');
                    $wire.sendMessage(message, '{{ $ticket->ticket_id }}');
                }
            }
        });
        $('#buttonSend').click(function() {
            var message = $('#message-input').val();
            if (message != '') {
                $('#message-input').val('');
                $wire.sendMessage(message, '{{ $ticket->ticket_id }}');
            }
        });
        window.addEventListener('scrolldown', event => {

            var tc = document.querySelectorAll('.scroll-block');
            for (var t = 0; t < tc.length; t++) {
                new SimpleBar(tc[t]);
            }
            setTimeout(function() {
                var element = document.querySelector(
                    '.chat-content .scroll-block .simplebar-content-wrapper');
                var elementheight = document.querySelector(
                    '.chat-content .scroll-block .simplebar-content');
                var off = elementheight.getBoundingClientRect();
                var h = off.height;
                element.scrollTop += h;
            }, 100);
        });
    </script>
@endscript
@section('scripts')
    <script>
        // scroll-block
        var tc = document.querySelectorAll('.scroll-block');
        for (var t = 0; t < tc.length; t++) {
            new SimpleBar(tc[t]);
        }
        setTimeout(function() {
            var element = document.querySelector('.chat-content .scroll-block .simplebar-content-wrapper');
            var elementheight = document.querySelector('.chat-content .scroll-block .simplebar-content');
            var off = elementheight.getBoundingClientRect();
            var h = off.height;
            element.scrollTop += h;
        }, 100);
        window.addEventListener('scrolldown', event => {

            var tc = document.querySelectorAll('.scroll-block');
            for (var t = 0; t < tc.length; t++) {
                new SimpleBar(tc[t]);
            }
            setTimeout(function() {
                var element = document.querySelector(
                    '.chat-content .scroll-block .simplebar-content-wrapper');
                var elementheight = document.querySelector(
                    '.chat-content .scroll-block .simplebar-content');
                var off = elementheight.getBoundingClientRect();
                var h = off.height;
                element.scrollTop += h;
            }, 100);
        });
    </script>
@endsection
