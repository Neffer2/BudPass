<div>
    <div>
        <label for="nombre">Nombre: </label>
        <input id="nombre" type="text" wire:model.change="nombre">
        @error('nombre')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label for="email">Correo: </label>
        <input id="email" type="email" wire:model.change="email">
        @error('email')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div> 

    <div>
        <label for="documento">Documento: </label>
        <input id="documento" type="text" wire:model.change="documento">
        @error('documento')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>
 
    <div> 
        <label for="telefono">Celular: </label>
        <input id="telefono" type="text" wire:model.change="telefono">
        @error('telefono')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label for="departamento">Departamento: </label>
        <select id="departamento" wire:model.live="departamento">
            <option value="">Seleccionar</option>
            @foreach ($departamentos as $depto)
                <option value="{{ $depto->id }}">{{ $depto->descripcion }}</option>
            @endforeach
        </select> 
        @error('departamento')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror   
    </div>
    <div>
        <label for="ciudad">Ciudad</label>
        <select id="ciudad" wire:model.change="ciudad">
            <option value=""></option>
            @if ($departamento)
                @foreach ($departamentos->where('id', $departamento)->first()->ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}">{{ $ciudad->descripcion }}</option>
                @endforeach
            @endif
        </select>
        @error('ciudad')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror   
    </div>
    
    <div>
        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input id="fecha_nacimiento" type="date" wire:model.change="fecha_nacimiento">
        @error('fecha_nacimiento')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label for="password">Contraseña: </label>
        <input id="password" type="password" wire:model.change="password">
        @error('password')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label for="confirm">Confirmar contraseña: </label>
        <input id="confirm" type="password" wire:model.change="confirm">
    </div>

    <div>
        <label for="terminos">T&eacute;rminos</label>
        <input id="terminos" type="checkbox" wire:model.change="terminos">
        @error('terminos')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label for="politicas">Pol&iacute;ticas</label>
        <input id="politicas" type="checkbox" wire:model.change="politicas">
        @error('politicas')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <label for="tratamiento">Tratamiento</label>
        <input id="tratamiento" type="checkbox" wire:model.change="tratamiento">
        @error('tratamiento')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div>
        <button wire:click="store">Registrar</button>
    </div>
</div>
