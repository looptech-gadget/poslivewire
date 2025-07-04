<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $taxRate = 0;
    public $discount = 0;
    public $total = 0;
    
    protected $listeners = [
        'addToCart' => 'addItem',
        'resetCart' => 'resetCart',
    ];
    
    public function mount()
    {
        $this->resetCart();
        // Get tax rate from settings if available
        // $this->taxRate = Setting::where('key', 'tax_rate')->first()->value ?? 0;
        $this->taxRate = 0; // Default to 0 for now
    }
    
    public function addItem($data)
    {
        $product = Product::find($data['product']['id']);
        
        if (!$product) {
            return;
        }
        
        // Check if product already exists in cart
        $existingItem = collect($this->cartItems)->firstWhere('id', $product->id);
        
        if ($existingItem) {
            // Update quantity if product already in cart
            foreach ($this->cartItems as $key => $item) {
                if ($item['id'] == $product->id) {
                    if ($this->cartItems[$key]['quantity'] < $product->stock_quantity) {
                        $this->cartItems[$key]['quantity']++;
                        $this->cartItems[$key]['subtotal'] = $this->cartItems[$key]['quantity'] * $this->cartItems[$key]['price'];
                    } else {
                        $this->dispatch('showAlert', [
                            'type' => 'error',
                            'message' => 'Cannot add more of this product. Stock limit reached.'
                        ]);
                    }
                    break;
                }
            }
        } else {
            // Add new product to cart
            $this->cartItems[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price,
                'max_quantity' => $product->stock_quantity,
            ];
        }
        
        $this->calculateTotals();
    }
    
    public function updateQuantity($index, $quantity)
    {
        if ($quantity > 0 && $quantity <= $this->cartItems[$index]['max_quantity']) {
            $this->cartItems[$index]['quantity'] = $quantity;
            $this->cartItems[$index]['subtotal'] = $this->cartItems[$index]['quantity'] * $this->cartItems[$index]['price'];
            $this->calculateTotals();
        }
    }
    
    public function incrementQuantity($index)
    {
        if ($this->cartItems[$index]['quantity'] < $this->cartItems[$index]['max_quantity']) {
            $this->cartItems[$index]['quantity']++;
            $this->cartItems[$index]['subtotal'] = $this->cartItems[$index]['quantity'] * $this->cartItems[$index]['price'];
            $this->calculateTotals();
        }
    }
    
    public function decrementQuantity($index)
    {
        if ($this->cartItems[$index]['quantity'] > 1) {
            $this->cartItems[$index]['quantity']--;
            $this->cartItems[$index]['subtotal'] = $this->cartItems[$index]['quantity'] * $this->cartItems[$index]['price'];
            $this->calculateTotals();
        }
    }
    
    public function removeItem($index)
    {
        unset($this->cartItems[$index]);
        $this->cartItems = array_values($this->cartItems);
        $this->calculateTotals();
    }
    
    public function applyDiscount($amount)
    {
        $this->discount = $amount;
        $this->calculateTotals();
    }
    
    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)->sum('subtotal');
        $this->tax = $this->subtotal * ($this->taxRate / 100);
        $this->total = $this->subtotal + $this->tax - $this->discount;
    }
    
    public function resetCart()
    {
        $this->cartItems = [];
        $this->subtotal = 0;
        $this->tax = 0;
        $this->discount = 0;
        $this->total = 0;
    }
    
    public function render()
    {
        return view('livewire.pos.cart');
    }
}
