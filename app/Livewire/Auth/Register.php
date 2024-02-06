<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Departamento;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class Register extends Component
{
    // Models 
    public $nombre, $email, $documento, $telefono, $ciudad,
            $fecha_nacimiento, $terminos, $politicas, $tratamiento,
            $departamento, $password, $confirm;

    // Useful vars
    public $ciudades = [], $departamentos = [];

    public function render()
    {
        return view('livewire.auth.register');
    } 

    public function mount(){
        $this->getDepartamentos();
    }

    public function getDepartamentos(){
        $this->departamentos = Departamento::all();
    }

    public function store(){
        $this->validate([
            'nombre' => 'required|string|max:250',
            'documento' => 'required|numeric|max_digits:10|unique:users',
            'telefono' => 'required|numeric|max_digits:10|unique:users',
            'ciudad' => 'required|numeric',
            'email' => 'required|email|max:250|unique:users',
            'fecha_nacimiento' => 'required|date',
            'terminos' => 'required|accepted',
            'politicas' => 'required|accepted',
            'tratamiento' => 'required|accepted',
            'password' => ['required', 'same:confirm', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'name' => $this->nombre,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'ciudad_id' => $this->ciudad,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'email' => $this->email,
            'terminos' => $this->terminos,
            'politicas' => $this->politicas,
            'tratamiento' => $this->tratamiento,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    // UPDATES
    public function updatedNombre(){
        $this->validate([
            'nombre' => 'required|string|max:250'
        ]);
    }

    public function updatedEmail(){
        $this->validate([
            'email' => 'required|email|max:250|unique:users'
        ]);
    }

    public function updatedDocumento(){
        $this->validate([
            'documento' => 'required|numeric|max_digits:10|unique:users'
        ]);
    }

    public function updatedTelefono(){
        $this->validate([
            'telefono' => 'required|numeric|max_digits:10|unique:users'
        ]);
    }

    public function updatedCiudad(){
        $this->validate([ 
            'ciudad' => 'required|numeric'
        ]); 
    } 

    public function updatedFechaNacimiento(){
        $this->validate([
            'fecha_nacimiento' => 'required|date'
        ]);
    }

    public function updatedTerminos(){
        $this->validate([
            'terminos' => 'required|accepted'
        ]);
    }

    public function updatedPoliticas(){
        $this->validate([
            'politicas' => 'required|accepted'
        ]);
    }

    public function updatedTratamiento(){
        $this->validate([
            'tratamiento' => 'required|accepted'
        ]);
    }

    public function updatedPassword(){
        $this->validate([
            'password' => ['required', 'same:confirm', Rules\Password::defaults()]
        ]);
    }

    public function updatedConfirm(){
        $this->validate([
            'password' => ['required', 'same:confirm', Rules\Password::defaults()]
        ]);
    }
} 

