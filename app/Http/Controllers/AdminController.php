<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegistroFactura;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $registrosFactura = RegistroFactura::select('id', 'num_factura', 'puntos_sumados', 'canal_id', 'user_id', 'created_at')->where('estado_id', 2)->orderby('id','desc')->get();
        $user = Auth::user();
        return view('admin.index', ['registrosFactura' => $registrosFactura, 'user' => $user]);
    }

    public function factura($id){
        $registroFactura = RegistroFactura::find($id);
        $user = Auth::user();
        return view('admin.factura', ['registroFactura' => $registroFactura, 'user' => $user]);
    }
}

