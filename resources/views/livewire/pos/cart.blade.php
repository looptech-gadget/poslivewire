<div class="cart-container">
    @if(empty($cartItems))
        <div class="empty-cart">
            <div class="text-center p-4">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h5>Your cart is empty</h5>
                <p class="text-muted">Add products to begin</p>
            </div>
        </div>
    @else
        <div class="cart-items">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $index => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td class="text-center">
                                <div class="quantity-control">
                                    <button wire:click="decrementQuantity({{ $index }})" class="btn btn-sm btn-outline-secondary">-</button>
                                    <input type="number" wire:model.blur="cartItems.{{ $index }}.quantity" 
                                           wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                           min="1" max="{{ $item['max_quantity'] }}" class="form-control form-control-sm quantity-input">
                                    <button wire:click="incrementQuantity({{ $index }})" class="btn btn-sm btn-outline-secondary">+</button>
                                </div>
                            </td>
                            <td class="text-end">{{ number_format($item['price'], 2) }}</td>
                            <td class="text-end">{{ number_format($item['subtotal'], 2) }}</td>
                            <td class="text-end">
                                <button wire:click="removeItem({{ $index }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="cart-summary">
            <table class="table table-sm">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-end">{{ number_format($subtotal, 2) }}</td>
                </tr>
                @if($tax > 0)
                <tr>
                    <td>Tax ({{ $taxRate }}%)</td>
                    <td class="text-end">{{ number_format($tax, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span>Discount</span>
                            <input type="number" wire:model.blur="discount" wire:change="calculateTotals" 
                                   class="form-control form-control-sm ms-2" placeholder="0.00">
                        </div>
                    </td>
                    <td class="text-end">{{ number_format($discount, 2) }}</td>
                </tr>
                <tr class="fw-bold">
                    <td>Total</td>
                    <td class="text-end">{{ number_format($total, 2) }}</td>
                </tr>
            </table>
            
            <div class="d-grid gap-2 mt-3">
                <button wire:click="resetCart" class="btn btn-outline-danger">
                    <i class="fas fa-trash"></i> Clear Cart
                </button>
            </div>
        </div>
    @endif
</div>

<style>
    .cart-container {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 250px);
    }
    
    .empty-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    
    .cart-items {
        flex: 1;
        overflow-y: auto;
        border-bottom: 1px solid #dee2e6;
    }
    
    .cart-summary {
        padding: 15px;
        background-color: #f8f9fa;
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        margin: 0 5px;
    }
</style>
