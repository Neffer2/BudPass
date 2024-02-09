@extends('layouts.app')
@section('content')
    <div class="forms-container">

        <div class="main-forms-container">
                <div class="main-forms-img"></div>    
                <div class="regs-container">
                    <div class="form-btn">
                        <button id="show-login-btn" class="regs-btn ">Iniciar sesión</button>
                        <button id="show-register-btn" class="regs-btn inactive">Registro</button>
                    </div>
                    <div id="login-component">
                        <livewire:auth.login />
                    </div>
                    <div id="register-component" style="display: none;">
                        <livewire:auth.register />
                    </div>
                </div>
        </div>
    </div>
@endsection
