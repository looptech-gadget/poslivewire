<?php

namespace App\Livewire\Pos;

use App\Models\Sale;
use Livewire\Component;

class Receipt extends Component
{
    public $sale;
    
    public function mount(Sale $sale = null)
    {
        $this->sale = $sale;
    }
    
    public function render()
    {
        return view('livewire.pos.receipt');
    }
}
