@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Referral" style="padding-top:24px;" data-value2="Konfigurasi"></div>

    @livewireStyles
    @livewire('admin.referral.konfigurasi')
    @livewireScripts
@endsection
