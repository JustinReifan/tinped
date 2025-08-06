@extends('templates.main')
@section('content')
    @livewireStyles
    @livewire('chat.user', ['ticket' => $ticket])
    @livewireScripts
@endsection
