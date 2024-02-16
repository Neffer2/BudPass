<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\Mail;

class ShopperController extends Controller
{
    use Mail; 

    public function showRanking(){
        $ranking = User::select('id', 'name', 'email', 'puntos')->where('estado_id', 1)->orderBy('puntos', 'desc')->limit(10)->get();
        $user_rank = User::select('id', 'name', 'email', 'puntos')->where('puntos', '>', Auth::user()->puntos)->count();

        return view('dashboard.ranking', ['ranking' => $ranking, 'user_rank' => $user_rank+=1]);
    }

    public function mail(){
        // $this->sendMail();  
    }
} 
