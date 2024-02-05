<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Departamento;

class Register extends Component
{
    // Models 
    public $nombre, $email, $documento, $celular, $ciudad,
            $fecha_nacimiento, $terminos, $politicas, $tratamiento, $departamento;

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
            'email' => 'required|email|max:250|unique:users',
            'documento' => 'required|numeric|max:10|unique:users',
            'celular' => 'required|numeric|max:11|unique:users',
            'ciudad' => 'required|numeric',
            'fecha_nacimiento' => 'required|numeric',
            'terminos' => 'required|accepted',
            'politicas' => 'required|accepted',
            'tratamiento' => 'required|accepted',
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
            'documento' => 'required|numeric|max:10|unique:users'
        ]);
    }

    public function updatedCelular(){
        $this->validate([
            'celular' => 'required|numeric|max:11|unique:users'
        ]);
    }

    public function updatedCiudad(){
        $this->validate([
            'ciudad' => 'required|numeric'
        ]);
    }

    public function updatedFechaNacimiento(){
        $this->validate([
            'fecha_nacimiento' => 'required|numeric'
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
} 

