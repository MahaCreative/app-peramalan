<?php

namespace App\Http\Livewire;

use App\Models\DetailPenjualan;
use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        if (!auth()->user()) {
            abort(403);
        }
        return view('livewire.dashboard');
    }
}