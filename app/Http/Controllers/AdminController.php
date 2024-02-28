<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroFactura;
use App\Models\Redencion;

class AdminController extends Controller
{
    public function index(){
        $registrosFactura = RegistroFactura::select('id', 'num_factura', 'puntos_sumados', 'canal_id', 'user_id', 'created_at')->where('estado_id', 2)->orderby('id','desc')->paginate(15);
        $redenciones = Redencion::select('id', 'premio_id', 'user_id', 'estado_id', 'created_at')->orderby('id','asc')->paginate(15);
        return view('admin.index', ['registrosFactura' => $registrosFactura, 'redenciones' => $redenciones]);
    }

    public function factura($id){
        $registroFactura = RegistroFactura::find($id);
        return view('admin.factura', ['registroFactura' => $registroFactura]);
    } 

    public function redencion($id){
        $redencion = Redencion::find($id);
        $redencion->estado_id = 0;
        $redencion->update();

        return redirect()->route('facturas')->with('success', 'Redención aprobada');
    }
}

 