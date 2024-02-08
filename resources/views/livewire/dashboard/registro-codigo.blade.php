<div>
    <div>
        <label for="">CODIGO</label>
        <input type="text">
        {{-- @error('nit')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror --}} 
    </div> 
    <div>
        <button>Canjear</button>
    </div>
    @if (session('success'))
        <b>{{ session('success') }}</b>
    @endif
</div>
