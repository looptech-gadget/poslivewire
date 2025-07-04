<?php

namespace App\Livewire\Pos;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $discount = 0;
    public $total = 0;
    
    public $paymentMethod = 'cash';
    public $amountPaid = 0;
    public $change = 0;
    
    public $customerId = null;
    public $customers = [];
    public $showAddCustomer = false;
    
    public $newCustomer = [
        'name' => '',
        'email' => '',
        'phone' => '',
    ];
    
    public $showReceipt = false;
    public $currentSale = null;
    
    protected $listeners = [
        'checkoutCompleted' => 'resetCheckout',
    ];
    
    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->loadCartData();
    }
    
    public function loadCartData()
    {
        // Get cart data from session or parent component
        // For now, we'll use dummy data - this should be passed from parent
        $this->cartItems = session('cart_items', []);
        $this->subtotal = session('cart_subtotal', 0);
        $this->tax = session('cart_tax', 0);
        $this->discount = session('cart_discount', 0);
        $this->total = session('cart_total', 0);
        
        // Set default amount paid to total
        $this->amountPaid = $this->total;
        $this->calculateChange();
    }
    
    public function updatedAmountPaid()
    {
        $this->calculateChange();
    }
    
    public function calculateChange()
    {
        $this->change = max(0, $this->amountPaid - $this->total);
    }
    
    public function toggleAddCustomer()
    {
        $this->showAddCustomer = !$this->showAddCustomer;
    }
    
    public function saveCustomer()
    {
        $this->validate([
            'newCustomer.name' => 'required|string|max:255',
            'newCustomer.email' => 'nullable|email|max:255',
            'newCustomer.phone' => 'nullable|string|max:20',
        ]);
        
        $customer = Customer::create([
            'name' => $this->newCustomer['name'],
            'email' => $this->newCustomer['email'],
            'phone' => $this->newCustomer['phone'],
        ]);
        
        $this->customers = Customer::orderBy('name')->get();
        $this->customerId = $customer->id;
        $this->showAddCustomer = false;
        $this->newCustomer = [
            'name' => '',
            'email' => '',
            'phone' => '',
        ];
    }
    
    public function processPayment()
    {
        if (empty($this->cartItems)) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Cart is empty. Cannot process payment.'
            ]);
            return;
        }
        
        if ($this->amountPaid < $this->total) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Amount paid is less than total amount.'
            ]);
            return;
        }
        
        try {
            DB::beginTransaction();
            
            // Create sale record
            $sale = Sale::create([
                'invoice_number' => Sale::generateInvoiceNumber(),
                'customer_id' => $this->customerId,
                'user_id' => auth()->id(),
                'subtotal' => $this->subtotal,
                'tax' => $this->tax,
                'discount' => $this->discount,
                'total' => $this->total,
                'amount_paid' => $this->amountPaid,
                'change' => $this->change,
                'payment_method' => $this->paymentMethod,
                'status' => 'completed',
            ]);
            
            // Create sale items and update product stock
            foreach ($this->cartItems as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);
                
                // Update product stock
                $product = Product::find($item['id']);
                $product->stock_quantity -= $item['quantity'];
                $product->save();
            }
            
            DB::commit();
            
            // Show receipt
            $this->currentSale = $sale->load(['saleItems.product', 'customer']);
            $this->showReceipt = true;
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Error processing payment: ' . $e->getMessage()
            ]);
        }
    }
    
    public function printReceipt()
    {
        $this->dispatch('printReceipt', [
            'receiptContent' => $this->getReceiptHtml()
        ]);
    }
    
    public function getReceiptHtml()
    {
        // This will be rendered in the view and passed to the print function
        return view('livewire.pos.receipt', [
            'sale' => $this->currentSale
        ])->render();
    }
    
    public function finishSale()
    {
        $this->dispatch('checkoutCompleted');
    }
    
    public function cancelCheckout()
    {
        $this->dispatch('cancelCheckout');
    }
    
    public function resetCheckout()
    {
        $this->cartItems = [];
        $this->subtotal = 0;
        $this->tax = 0;
        $this->discount = 0;
        $this->total = 0;
        $this->paymentMethod = 'cash';
        $this->amountPaid = 0;
        $this->change = 0;
        $this->customerId = null;
        $this->showReceipt = false;
        $this->currentSale = null;
    }
    
    public function render()
    {
        return view('livewire.pos.checkout');
    }
}
