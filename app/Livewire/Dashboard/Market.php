<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Premio;
use App\Models\Redencion;
use App\Models\bbdd_marketplace_general;
 
class Market extends Component
{
    // Useful vars 
    public $premios, $puntosUser, $user, $destacados;

    public function render()
    {
        return view('livewire.dashboard.market');
    }

    public function mount(){
        $this->user = Auth::user(); 
        $this->puntosUser = $this->user->puntos; 

        $this->premios = Premio::select('id', 'nombre', 'descripcion', 'stock', 'puntos', 'foto')->where([
            ['stock', '>', 0],
            ['tipo', 1]
        ])->get();

        $this->destacados = Premio::select('id', 'nombre', 'descripcion', 'stock', 'puntos', 'foto')->where([
            ['stock', '>', 0],
            ['tipo', 0]
        ])->get();
    }

    public function redimir($premio){ 
        $modelPremio = $this->premios->where('id', $premio)->first();        
        if ($this->user->puntos < $modelPremio->puntos){
            return $this->addError('redencion', 'Oops, no tienes suficientes puntos para realizar esta redención.');
        }

        // Redencion
        $redencion = new Redencion;
        $redencion->premio_id = $modelPremio->id;
        $redencion->user_id = $this->user->id;
        $redencion->save();

        // Puntos user
        $this->user->puntos -= $modelPremio->puntos;
        $this->user->update();

        // Stock premio 
        $modelPremio->stock -= 1;
        $modelPremio->update();

        // registro_budpass
        $marketplace_general = new bbdd_marketplace_general;
        $marketplace_general->nombre = $this->user->name;
        $marketplace_general->correo = $this->user->email;
        $marketplace_general->posicion_ranking = $this->user->rank($this->user->id);
        $marketplace_general->save();

        $fecha_nacimiento = $this->user->fecha_nacimiento;
        $fecha = \DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
        
        $tdstatus = $this->__sendTD(array(
            "abi_name" => $this->user->name,
            "abi_cpf" => $this->user->documento,
            "abi_email" => $this->user->email,
            "abi_city" => $this->user->ciudad->descripcion,
            "abi_phone" => $this->user->telefono,
            "abi_dayofbirth" => $fecha->format('d'),
            "abi_monthofbirth" => $fecha->format('m'),
            "abi_yearofbirth" => $fecha->format('Y'),
            "abpurposei_interests" => ''), 'col', 'Budweiser', 'BUDWEISER_BUDPASS_02_24', 'BUDWEISER_BUDPASS_02_24', false, false);

        return redirect()->route('market')->with([
            'title' => 'Redención exitosa.',
            'success-redencion' => '¡Felicidades! haz redimido el premio: '.$this->premios->where('id', $premio)->first()->nombre.', pronto nos contactaremos contigo.'
        ]);
    } 

    private function __sendTD($form_data, $country, $brand, $campaign, $form, $unify, $production){
        $td_env = $production ? 'prod' : 'dev';
        $http_protocol = isset($_SERVER['https']) ? 'https://' : 'http://';
            
        $form_data['abi_brand'] = $brand;
        $form_data['abi_campaign'] = $campaign;
        $form_data['abi_form'] = $form;
        $form_data['td_unify'] = $unify;
        $form_data['td_import_method'] = 'postback-api-1.2';
        $form_data['td_client_id'] = request()->cookie('_td');
        $form_data['td_url'] = $http_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $form_data['td_host'] = $_SERVER['HTTP_HOST'];
            
        $td_country = $country;
        $td_apikey = $td_env !== 'prod' ? '9648/41e45454b77308046627548e0b4fe2ddbc0893d2' : '10086/9c06ed6fa48e0fb6952ed42773cca1cc1d43684e';
            
        $country_zone_mapping = array("nga"=>"africa", "zwe"=>"africa", "zaf"=>"africa", "aus"=>"apac", "chn"=>"apac", "ind"=>"apac", "jpn"=>"apac", "kor"=>"apac", "tha"=>"apac", "vnm"=>"apac", "bel"=>"eur", "fra"=>"eur", "deu"=>"eur", "ita"=>"eur", "nld"=>"eur", "rus"=>"eur", "esp"=>"eur", "ukr"=>"eur", "gbr"=>"eur", "col"=>"midam", "dom"=>"midam", "ecu"=>"midam", "slv"=>"midam", "gtm"=>"midam", "hnd"=>"midam", "mex"=>"midam", "pan"=>"midam", "per"=>"midam", "can"=>"naz", "usa"=>"naz", "arg"=>"saz", "bol"=>"saz", "bra"=>"saz", "chl"=>"saz", "ury"=>"saz");
            
        $td_zone = $country_zone_mapping[$td_country];
        $curl = curl_init();
        
        $curl_opts = array(
            CURLOPT_URL => "https://in.treasuredata.com/postback/v3/event/{$td_zone}_source/{$td_country}_web_form",
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "X-TD-Write-Key: {$td_apikey}"
            ),
            CURLOPT_POSTFIELDS => json_encode($form_data)
        );
        
        curl_setopt_array($curl, $curl_opts);
        
        $response = @curl_exec($curl);
        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        return $response_code;
    }
}
