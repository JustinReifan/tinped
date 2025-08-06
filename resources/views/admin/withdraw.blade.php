@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Withdraw" data-value2="Riwayat"></div>
    @livewireStyles
    @livewire('admin.withdraw')
    @livewireScripts
@endsection
