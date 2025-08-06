@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="List" style="padding-top:24px;" data-value2="Referral"></div>
    @livewireStyles
    @livewire('admin.referral.list-referral')
    @livewireScripts
@endsection
