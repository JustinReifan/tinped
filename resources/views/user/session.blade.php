@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Session" data-value2="Account"></div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss"><i class="fab fa-chrome me-1"></i>Sesi Aktif</div>
        <div class="card-body">
            @livewireStyles
            @livewire('user.session')
            @livewireScripts
        </div>
    </div>
@endsection
