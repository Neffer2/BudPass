<div class="registro-div-cont">
    <div class="title-registro-cont">
        <h1 class="title-registro">Formulario de Registro</h1>
        <h2 class="sub-title-registro">Completa los siguientes datos</h2>
    </div>
    <div class="input-cont">
        <label for="nombre">Nombre: </label>
        <input id="nombre" type="text" wire:model.change="nombre">
        @error('nombre')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="input-cont">
        <label for="documento">Documento: </label>
        <input id="documento" type="text" wire:model.change="documento">
        @error('documento')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="input-cont">
        <label for="fecha_nacimiento">Fecha de nacimiento: </label>
        <input id="fecha_nacimiento" type="date" wire:model.change="fecha_nacimiento">
        @error('fecha_nacimiento')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="flex-deparamento-ciudad">
        <div class="input-cont">
            <label for="departamento">Departamento: </label>
            <select id="departamento" wire:model.live="departamento" class="select-departamento">
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
        <div class="input-cont">
            <label for="ciudad">Ciudad: </label>
            <select id="ciudad" wire:model.change="ciudad" class="select-ciudad">
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
    </div>

    <div class="input-cont">
        <label for="telefono">Celular: </label>
        <input id="telefono" type="text" wire:model.change="telefono">
        @error('telefono')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="input-cont">
        <label for="email">Correo: </label>
        <input id="email" type="email" wire:model.change="email">
        @error('email')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="input-cont">
        <label for="password">Contraseña: </label>
        <div class="input-contrasena">
            <input id="password" type="password" wire:model.change="password" style="padding-right: 40px;">
            <i onclick="togglePasswordVisibility('password')" class="fas fa-eye-slash toggle-password"
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
        </div>
        @error('password')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="input-cont">
        <label for="confirm">Confirmar contraseña: </label>
        <div class="input-contrasena">
            <input id="confirm" type="password" wire:model.change="confirm" style="padding-right: 40px;">
            <i onclick="togglePasswordVisibility('confirm')" class="fas fa-eye-slash toggle-password"></i>
        </div>
    </div>

    <br>

    <div class="checkbox-cont">
        <input id="terminos" type="checkbox" class="checkbox-item" wire:model.change="terminos">
        <a href="https://www.bavaria.co/t%C3%A9rminos-y-condiciones" target="_blank" rel="noopener noreferrer"><label for=""
                class="checkbox-label">T&eacute;rminos y condiciones</label></a>
        @error('terminos')
            <div class="text-invalid-check">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="checkbox-cont">
        <input id="politicas" type="checkbox" class="checkbox-item" wire:model.change="politicas">
        <a href="https://www.bavaria.co/sites/g/files/seuoyk1666/files/2024-02/Aviso%20de%20Privacidad%20%28V.5%29.pdf"
            target="_blank" rel="noopener noreferrer"><label for="" class="checkbox-label">Pol&iacute;ticas de
                privacidad</label></a>
        @error('politicas')
            <div class="text-invalid-check">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="btn-registrar">
        <button wire:click="store">Registrar</button>
    </div>
</div>
