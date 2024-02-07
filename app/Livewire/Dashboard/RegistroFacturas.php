<?php

namespace App\Livewire\Dashboard; 

use Livewire\Component;
use App\Models\Canal;
use App\Models\RegistroFactura;
use App\Models\ProductoFactura;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class RegistroFacturas extends Component
{
    use WithFileUploads;

    // Models
    public $nit, $num_factura, $producto, $cantidad, $puntos = 0, $foto_factura, $selfie_producto;
 
    // Useful vars
    public $canal, $productos;

    public function render()
    {
        $this->getPuntos();
        return view('livewire.dashboard.registro-facturas');
    }

    public function mount(){
        $this->productos = collect();
    }

    /*
        |---------------------------------------
        | Store products on $this->productos
        |---------------------------------------
    */
    public function addProduct(){
        $this->validate([
            'producto' => 'required|numeric',
            'cantidad' => 'required|numeric|max:20'
        ]);

        $producto = $this->canal->productos->find($this->producto);
        $this->productos->push(['id' => $producto->id, 'descripcion' => $producto->descripcion, 'cantidad' => $this->cantidad]);
    }

    /*
        |---------------------------------------
        | Subtract products from $this->productos
        |---------------------------------------
    */
    public function subsProduct($key){
        $this->productos->forget($key);
    }

    /*
        |---------------------------------------
        | Calculate points from the bill
        |---------------------------------------
    */
    public function getPuntos(){
        if ($this->canal){
            $puntos = 0;
            $this->productos->map(function ($producto) use (&$puntos){
                $puntos += ($this->canal->productos->find($producto['id'])->referencia->puntos) * $producto['cantidad'];
            });
            $this->puntos = $puntos; 
        }
    }

    public function storeFactura(){
        $this->validate([
            'num_factura' => 'required|numeric|unique:registros_factura|max_digits:20', 
            'foto_factura' => 'required|max:20000',
            'selfie_producto' => 'required|max:20000'
        ]);

        if (!(count($this->productos) > 0)){
            $this->addError('productos', 'No puedes registrar una factura sin productos.');
        }

        $registroFactura = new RegistroFactura;
        $registroFactura->num_factura = $this->num_factura;
        $registroFactura->foto_selfie = $this->selfie_producto->store(path: 'selfies');;
        $registroFactura->foto_factura = $this->foto_factura->store(path: 'facturas');;
        $registroFactura->user_id = Auth::user()->id;
        $registroFactura->puntos_sumados = $this->puntos;
        $registroFactura->save();
        $this->resetFields();

        foreach ($this->productos as $producto) {
            $registroProductos = new ProductoFactura;
            $registroProductos->factura_id = $registroFactura;
            $registroProductos->producto_id = $producto->id;
            $registroProductos->cantidad = $producto->cantidad;
            $registroProductos->save();
        }

        return redirect()->back()->with('success', 'Registro de factura exitoso.');
    }
    
    // UPDATES    
    public function updatedNit(){
        $this->resetFields();
        $this->validate([
            'nit' => 'required|alpha_dash'
        ]);
        $this->canal = Canal::where('nit', 'LIKE', "%$this->nit%")->first();
        (!($this->canal)) ? $this->addError('nit', 'Este NIT no coincide con ningún canal.'): null;
    }   

    public function updatedNumFactura(){
        $this->validate([
            'num_factura' => 'required|numeric|unique:registros_factura|max_digits:20'
        ]);
    }

    public function updatedFotoFactura(){
        $this->validate([
            'foto_factura' => 'required|max:20000'
        ]);
    }

    public function updatedSelfieProducto(){
        $this->validate([
            'selfie_producto' => 'required|max:20000'
        ]);
    }

    // RESET
    public function resetFields(){
        if ($this->canal){
            $this->reset(
                'num_factura',
                'producto',
                'cantidad',
                'puntos',
                'foto_factura',
                'selfie_producto',
            );
            $this->productos = collect();
        }
    }

    // VALIDATIONS
    public function messages() 
    {
        return [
            'num_factura.required' => 'El número de factura es obligatorio.',
            'num_factura.numeric' => 'No puedes utilizar letras ni carácteres especiales en el número de factura.',
            'num_factura.unique' => 'Este número de factura ya fué registrado.',

            'foto_factura.required' => 'La foto de factura es obligatoria.',
            'foto_factura.max' => 'El tamaño de la foto no puede ser mayor a 20MB.',
            'selfie_producto.required' => 'La selfie de producto es obligatoria.',
            'selfie_producto.max' => 'El tamaño de la foto no puede ser mayor a 20MB.'
        ];
    }

} 
