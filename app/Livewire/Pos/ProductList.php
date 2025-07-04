<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $categoryId;
    public $searchTerm = '';
    
    public function mount($categoryId = null, $searchTerm = '')
    {
        $this->categoryId = $categoryId;
        $this->searchTerm = $searchTerm;
    }
    
    public function addToCart(Product $product)
    {
        if ($product->stock_quantity <= 0) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Product out of stock!'
            ]);
            return;
        }
        
        $this->dispatch('addToCart', [
            'product' => $product
        ]);
        
        $this->dispatch('productSelected');
    }
    
    public function render()
    {
        $query = Product::query()->where('active', true);
        
        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }
        
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('sku', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('barcode', 'like', '%' . $this->searchTerm . '%');
            });
        }
        
        $products = $query->get();
        
        return view('livewire.pos.product-list', [
            'products' => $products
        ]);
    }
}
