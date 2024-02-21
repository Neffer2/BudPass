<?php

namespace App\Livewire\Dashboard; 

use Livewire\Component;
use App\Models\Canal;
use App\Models\RegistroFactura;
use App\Models\ProductoFactura;
use App\Models\bbdd_registro_budpass;
use Livewire\WithFileUploads;
use App\Rules\num_factura;
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
        | adds products on $this->productos
        |---------------------------------------
    */
    public function addProduct(){
        $this->validate([
            'producto' => 'required|numeric',
            'cantidad' => 'required|numeric'
        ]);

        $producto = $this->canal->productos->find($this->producto);
        if (!$this->productos->where('id', $this->producto)->first()){
            $this->productos->push(['id' => $producto->id, 'descripcion' => $producto->descripcion, 'cantidad' => $this->cantidad]);            
            $this->reset('producto', 'cantidad');
        }else {
            return $this->addError('producto', 'Oops, ya añadiste este producto.');
        }
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

    /*
        |---------------------------------------
        | Store factura and Productos factura.
        |---------------------------------------
    */
    public function storeFactura(){
        $this->validate([
            'num_factura' => ['required', 'alpha_num', 'max:20', new num_factura],
            'foto_factura' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20000',
            'selfie_producto' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20000'
        ]);

        if (!($this->canal)){$this->addError('nit', 'Este NIT no coincide con ningún canal');}
        
        $this->num_factura = str_replace("-", "", $this->num_factura);
        if (!(count($this->productos) > 0)){    
            $this->addError('productos', 'No puedes registrar una factura sin productos.');
            return redirect()->back();
        }
 
        $registroFactura = new RegistroFactura;
        $registroFactura->num_factura = $this->num_factura;
        $registroFactura->canal_id = $this->canal->id;
        $registroFactura->foto_selfie = $this->selfie_producto->store(path: '/public/selfies');;
        $registroFactura->foto_factura = $this->foto_factura->store(path: '/public/facturas');;
        $registroFactura->user_id = Auth::user()->id;
        $registroFactura->puntos_sumados = $this->puntos;
        $registroFactura->save();
        
        foreach ($this->productos as $producto) {
            $registroProductos = new ProductoFactura;
            $registroProductos->factura_id = $registroFactura->id;
            $registroProductos->producto_id = $producto['id'];
            $registroProductos->cantidad = $producto['cantidad'];
            $registroProductos->save();
        }
        

        // registro_budpass
        $user_budpass = Auth::user();
        $registro_budpass = new bbdd_registro_budpass;
        $registro_budpass->nombre = $user_budpass->name;
        $registro_budpass->correo = $user_budpass->email;
        $registro_budpass->fecha_nacimiento = $user_budpass->fecha_nacimiento;
        $registro_budpass->ciudad = $user_budpass->ciudad->descripcion;
        $registro_budpass->numero_factura = $this->num_factura;
        $registro_budpass->numero_nit = $this->canal->nit;
        $registro_budpass->puntaje_acumulado = $this->puntos;
        $registro_budpass->save();
        
        $this->resetFields();
        return redirect()->route('dashboard')->with([
            'title' => 'Registro exitoso.',
            'success' => 'Registro de factura exitoso.'
        ]);          
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
        if (strpos($this->num_factura, '-')){
            $this->num_factura = str_replace("-", "", $this->num_factura);
        }

        $this->validate([
            'num_factura' => ['required', 'alpha_num', 'max:20', new num_factura]
        ]);        
    }

    public function updatedFotoFactura(){
        $this->validate([
            'foto_factura' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20000'
        ]);
    }

    public function updatedSelfieProducto(){
        $this->validate([
            'selfie_producto' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20000'
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

    // private function __sendTD($form_data, $country, $brand, $campaign, $form, $unify, $production){
    //     $td_env = $production ? 'prod' : 'dev';
    //     $http_protocol = isset($_SERVER['https']) ? 'https://' : 'http://';
            
    //     $form_data['abi_brand'] = $brand;
    //     $form_data['abi_campaign'] = $campaign;
    //     $form_data['abi_form'] = $form;
    //     $form_data['td_unify'] = $unify;
    //     $form_data['td_import_method'] = 'postback-api-1.2';
    //     $form_data['td_client_id'] = $_COOKIE['_td'];
    //     $form_data['td_url'] = $http_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //     $form_data['td_host'] = $_SERVER['HTTP_HOST'];
            
    //     $td_country = $country;
    //     $td_apikey = $td_env !== 'prod' ? '9648/41e45454b77308046627548e0b4fe2ddbc0893d2' : '10086/9c06ed6fa48e0fb6952ed42773cca1cc1d43684e';
            
    //     $country_zone_mapping = array("nga"=>"africa", "zwe"=>"africa", "zaf"=>"africa", "aus"=>"apac", "chn"=>"apac", "ind"=>"apac", "jpn"=>"apac", "kor"=>"apac", "tha"=>"apac", "vnm"=>"apac", "bel"=>"eur", "fra"=>"eur", "deu"=>"eur", "ita"=>"eur", "nld"=>"eur", "rus"=>"eur", "esp"=>"eur", "ukr"=>"eur", "gbr"=>"eur", "col"=>"midam", "dom"=>"midam", "ecu"=>"midam", "slv"=>"midam", "gtm"=>"midam", "hnd"=>"midam", "mex"=>"midam", "pan"=>"midam", "per"=>"midam", "can"=>"naz", "usa"=>"naz", "arg"=>"saz", "bol"=>"saz", "bra"=>"saz", "chl"=>"saz", "ury"=>"saz");
            
    //     $td_zone = $country_zone_mapping[$td_country];
    //     $curl = curl_init();
        
    //     $curl_opts = array(
    //         CURLOPT_URL => "https://in.treasuredata.com/postback/v3/event/{$td_zone}_source/{$td_country}_web_form",
    //         CURLOPT_POST => true,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json',
    //             "X-TD-Write-Key: {$td_apikey}"
    //         ),
    //         CURLOPT_POSTFIELDS => json_encode($form_data)
    //     );
        
    //     curl_setopt_array($curl, $curl_opts);
        
    //     $response = @curl_exec($curl);
    //     $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
    //     curl_close($curl);
    //     return $response_code;
    // }
       
    /*
        // define variable that will be used to tell the __sendTD method if it should send to the production database
        $is_production = false;
        
            // define the purpose variable as an empty array
        $purposes = array();
        
            // check whether the TC-PP checkbox is checked, and if it is, then adds it to the purpose array - informed
        if($tcpp) $purposes[] = 'TC-PP';
        
            // check whether the MARKETING-ACTIVATION checkbox is checked, and if it is, then adds it to the purpose array
        if($marketing) $purposes[] = 'MARKETING-ACTIVATION';
        
            // here it's possible to add additional purposes to the purpose array
        
            // runs the __sendTD method with parameters got from the request, it should be changed based on your form fields, country, brand, campaign, form, and whether if it's running in the production environment or not
        $tdstatus = $this->__sendTD(
                array(
                "abi_name" => $name,
                "abi_cpf" => $cpf,
                "abi_email" => $email,
                "abi_city" => $city,
                "abi_dayofbirth" => $dayofbirth,
                "abi_monthofbirth" => $monthofbirth,
                "abi_yearofbirth" => $yearofbirth,
                "abpurposei_interests" => '',
            "_name" => $purposes,
                ), // form data & purposes
            'col', // country
            'Budweiser', // brand
            "BUDWEISER_BUDPASS_02_24", // campaign
            "BUDWEISER_BUDPASS_02_24", // form
            false, // unify
            $is_production // production flag
        );
    */

    // VALIDATIONS
    public function messages() 
    {
        return [
            'nit.required' => 'El número NIT es obligatorio.',

            'num_factura.required' => 'El número de factura es obligatorio.',
            'num_factura.numeric' => 'No puedes utilizar letras ni carácteres especiales en el número de factura.',        
            
            'foto_factura.required' => 'La foto de factura es obligatoria.',
            'foto_factura.max' => 'Oops, exediste el tamaño límite de fotos.',
            'foto_factura.mimes' => 'Formato de foto inválido.',
            'selfie_producto.required' => 'La selfie de producto es obligatoria.',
            'selfie_producto.max' => 'Oops, exediste el tamaño límite de fotos.',
            'selfie_producto.mimes' => 'Formato de foto inválido.',

            'producto.required' => 'Selecciona un producto.',
            'producto.numeric' => 'Producto inválido',

            'cantidad.required' => 'Indica la cantidad de producto que compraste.',
            'cantidad.numeric' => 'Cantidad de producto inválida',
            // 'cantidad.max' => 'Oops, exediste la cantidad máxima de producto por factura.',
        ];
    }
} 
