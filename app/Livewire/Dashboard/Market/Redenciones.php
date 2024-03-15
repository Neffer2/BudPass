<?php

namespace App\Livewire\Dashboard\Market;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Redencion;
use Livewire\WithoutUrlPagination;

class Redenciones extends Component
{
    use WithPagination, WithoutUrlPagination;

    // Filled
    public $user_id;

    public function render()
    {   
        $redenciones = Redencion::select('id', 'premio_id', 'created_at')->where('user_id', $this->user_id)->paginate(15);
        return view('livewire.dashboard.market.redenciones', ['redenciones' => $redenciones]);
    }
}
   