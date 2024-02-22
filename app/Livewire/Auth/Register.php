<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Departamento;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Traits\Mail;

class Register extends Component
{
    use Mail;

    // Models 
    public $nombre, $email, $documento, $telefono, $ciudad,
            $fecha_nacimiento, $terminos, $politicas,
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
            'fecha_nacimiento' => 'required|date|before:2006-01-01',
            'terminos' => 'required|accepted',
            'politicas' => 'required|accepted',
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
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME)->with([
            'title' => 'Bienvenido',
            'register-success' => 'Ahora podrás acumular puntos con tus compras de Budweiser y redimirlos por entradas para experiencias, festivales, conciertos, producto o accesorios de la cerveza que enciende la noche y la fiesta en el mundo.'
        ]);
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
            'fecha_nacimiento' => 'required|date|before:2006-01-01'
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

    // VALIDATIONS
    public function messages() 
    {
        return [
            'nombre.required' => "Oops, tu nombre es obligatorio.",
            'nombre.string' => "Formato no valido.",
            'nombre.max' => "Oops, excediste el límite máximo de caracteres.",

            'email.required' => "Oops, tu correo es obligatorio.",
            'email.email' => "Escribe un correo electrónico valido.",
            'email.max' => "Oops, excediste el límite máximo de caracteres.",
            'email.unique' => "Oops, este correo ya fué registrado.",

            'documento.required' => "Oops, tu documento es obligatorio.",
            'documento.numeric' => "Oops, tu documento no puede tener letras.",
            'documento.max_digits' => "Oops, excediste el límite máximo de caracteres.",
            'documento.unique' => "Oops, este documento ya fué registrado.",

            'telefono.required' => "Oops, tu teléfono es obligatorio.",
            'telefono.numeric' => "Oops, tu teléfono no puede tener letras.",
            'telefono.max_digits' => "Oops, excediste el límite máximo de caracteres.",
            'telefono.unique' => "Oops, este teléfono ya fué registrado.",

            'ciudad.required' => "Oops, tu ciudad es obligatoria.",
            'ciudad.numeric' => "Formato no valido.",

            'fecha_nacimiento.required' => "Oops, tu fecha de nacimiento es obligatoria.",
            'fecha_nacimiento.date' => "Formato no valido.",
            'fecha_nacimiento.before' => "Opps, no puedes participar si eres menor de edad.",

            'terminos.required' => "Debes aceptar los términos y condiciones.",
            'terminos.accepted' => "Debes aceptar los términos y condiciones.",

            'politicas.required' => "Debes aceptar las políticas de privacidad.",
            'politicas.accepted' => "Debes aceptar las políticas de privacidad.",

            'password.required' => "Oops, no olvides tu contraseña.",
            'password.same' => "Las contraseñas no coinciden.",
            'password.min' => "Oops, tu contraseña debe tener al menos 8 caracteres."
        ];
    }
}

