@extends('layouts.app')
@section('content')
    <div class="page-forms-cont">

        <div class="main-forms-cont">
            <div class="main-forms-logo">
                <div class="big-logo-cont">
                    <img src="{{ asset('assets/budweiser/logo-budweiser.svg') }}" alt="Logo Budweiser" class=""
                        srcset="">
                </div>
            </div>
            <div class="regs-form-cont">
                <div class="form-btn">
                    <button id="show-login-btn" class="regs-btn ">Iniciar sesión</button>
                    <button id="show-register-btn" class="regs-btn secundario-btn">Registro</button>
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
