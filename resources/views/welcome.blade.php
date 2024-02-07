@extends('layouts.app')
@section('content')
    <div class="">
        <img src="{{ asset('assets/budweiser/bud-logo.png') }}" style="width: 100px" alt="Logo">
        <h1>Your Brand Name</h1>
    </div>

    <button id="show-login-btn">Login</button>
    <button id="show-register-btn">Register</button>

    <div id="login-component">
        <livewire:auth.login />
    </div>

    <div id="register-component" style="">
        <livewire:auth.register />
    </div>
    passss
@endsection
