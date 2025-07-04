<?php

namespace App\Livewire\Pos;

use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use Livewire\Component;

class PosPage extends Component
{
    public $categories = [];
    public $selectedCategory = null;
    public $searchTerm = '';
    public $showCheckout = false;
    
    protected $listeners = [
        'productSelected' => 'handleProductSelected',
        'checkoutCompleted' => 'handleCheckoutCompleted',
        'cancelCheckout' => 'handleCancelCheckout',
    ];
    
    public function mount()
    {
        $this->categories = Category::where('active', true)->get();
        if ($this->categories->isNotEmpty()) {
            $this->selectedCategory = $this->categories->first()->id;
        }
    }
    
    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }
    
    public function handleProductSelected()
    {
        // This is handled by the ProductList component
    }
    
    public function proceedToCheckout()
    {
        // Get cart data from the cart component
        $this->dispatch('getCartData');
        $this->showCheckout = true;
    }
    
    public function handleCheckoutCompleted()
    {
        $this->showCheckout = false;
        $this->dispatch('resetCart');
    }
    
    public function handleCancelCheckout()
    {
        $this->showCheckout = false;
    }
    
    public function render()
    {
        return view('livewire.pos.pos-page');
    }
}
