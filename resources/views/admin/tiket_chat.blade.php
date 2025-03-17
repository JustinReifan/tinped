@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Chat" style="padding-top:24px;" data-value2="Tiket"></div>
    @livewireStyles
    @livewire('admin.tiket-chat', ['ticket' => $ticket])
    @livewireScripts
@endsection
