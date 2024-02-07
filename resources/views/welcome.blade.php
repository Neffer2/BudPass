@extends('layouts.app')
@section('content')
    <div class="formularios-container" >
        
        <div>
            <button id="show-login-btn">Login</button>
            <button id="show-register-btn">Register</button>
        </div>

        <div id="login-component">
            <livewire:auth.login />
        </div>

        <div id="register-component" style="display: none;">
            <livewire:auth.register />
        </div>

    </div>
@endsection
