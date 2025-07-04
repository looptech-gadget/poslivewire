<div class="checkout-container">
    <div class="card checkout-card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Checkout</h5>
            <button wire:click="cancelCheckout" class="btn btn-sm btn-light">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
        
        @if($showReceipt)
            <div class="card-body">
                <div class="receipt-container">
                    @livewire('pos.receipt', ['sale' => $currentSale])
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button wire:click="printReceipt" class="btn btn-primary">
                            <i class="fas fa-print"></i> Print Receipt
                        </button>
                        <button wire:click="finishSale" class="btn btn-success">
                            <i class="fas fa-check"></i> Finish Sale
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="card-body">
                <div class="row">
                    <!-- Left side - Cart summary -->
                    <div class="col-md-7 border-end">
                        <h6 class="mb-3">Order Summary</h6>
                        
                        <div class="cart-summary-table">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td class="text-center">{{ $item['quantity'] }}</td>
                                            <td class="text-end">{{ number_format($item['price'], 2) }}</td>
                                            <td class="text-end">{{ number_format($item['subtotal'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Subtotal:</td>
                                        <td class="text-end">{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    @if($tax > 0)
                                    <tr>
                                        <td colspan="3" class="text-end">Tax:</td>
                                        <td class="text-end">{{ number_format($tax, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-end">Discount:</td>
                                        <td class="text-end">{{ number_format($discount, 2) }}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="3" class="text-end">Total:</td>
                                        <td class="text-end">{{ number_format($total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <!-- Customer selection -->
                        <div class="customer-selection mt-4">
                            <h6 class="mb-3">Customer Information</h6>
                            
                            <div class="d-flex mb-3">
                                <select wire:model="customerId" class="form-select me-2">
                                    <option value="">Walk-in Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                <button wire:click="toggleAddCustomer" class="btn btn-outline-primary">
                                    <i class="fas fa-plus"></i> New
                                </button>
                            </div>
                            
                            @if($showAddCustomer)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="mb-3">Add New Customer</h6>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" wire:model="newCustomer.name" class="form-control" required>
                                            @error('newCustomer.name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" wire:model="newCustomer.email" class="form-control">
                                            @error('newCustomer.email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" wire:model="newCustomer.phone" class="form-control">
                                            @error('newCustomer.phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="d-flex justify-content-end">
                                            <button wire:click="toggleAddCustomer" class="btn btn-outline-secondary me-2">Cancel</button>
                                            <button wire:click="saveCustomer" class="btn btn-primary">Save Customer</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Right side - Payment -->
                    <div class="col-md-5">
                        <h6 class="mb-3">Payment</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select wire:model="paymentMethod" class="form-select">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="mobile_money">Mobile Money</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="text" class="form-control form-control-lg bg-light" value="{{ number_format($total, 2) }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Amount Paid</label>
                            <input type="number" wire:model="amountPaid" wire:change="calculateChange" class="form-control form-control-lg" step="0.01" min="0">
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Change</label>
                            <input type="text" class="form-control form-control-lg bg-light" value="{{ number_format($change, 2) }}" readonly>
                        </div>
                        
                        <div class="d-grid">
                            <button wire:click="processPayment" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle"></i> Complete Payment
                            </button>
                        </div>
                        
                        @if($paymentMethod === 'cash')
                            <div class="quick-amounts mt-3">
                                <div class="d-flex flex-wrap justify-content-between">
                                    @foreach([500, 1000, 2000, 5000, 10000] as $amount)
                                        <button wire:click="$set('amountPaid', {{ $amount }})" class="btn btn-outline-primary m-1">
                                            {{ number_format($amount, 0) }}
                                        </button>
                                    @endforeach
                                    <button wire:click="$set('amountPaid', {{ $total }})" class="btn btn-outline-success m-1">
                                        Exact
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <style>
        .checkout-container {
            width: 90%;
            max-width: 1000px;
        }
        
        .checkout-card {
            width: 100%;
        }
        
        .cart-summary-table {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</div>
