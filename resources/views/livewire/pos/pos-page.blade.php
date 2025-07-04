<div class="pos-container">
    @if($showCheckout)
        <div class="checkout-overlay">
            @livewire('pos.checkout')
        </div>
    @else
        <div class="row">
            <!-- Left Side - Product Selection -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Products</h5>
                        <div class="search-container">
                            <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search products...">
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Categories -->
                        <div class="categories-container mb-3">
                            <div class="d-flex flex-wrap">
                                @foreach($categories as $category)
                                    <button 
                                        wire:click="selectCategory({{ $category->id }})" 
                                        class="btn {{ $selectedCategory == $category->id ? 'btn-primary' : 'btn-outline-primary' }} m-1">
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Products Grid -->
                        <div class="products-container">
                            @livewire('pos.product-list', ['categoryId' => $selectedCategory, 'searchTerm' => $searchTerm])
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Cart -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Cart</h5>
                    </div>
                    <div class="card-body p-0">
                        @livewire('pos.cart')
                    </div>
                    <div class="card-footer">
                        <button wire:click="proceedToCheckout" class="btn btn-success btn-lg btn-block w-100">
                            <i class="fas fa-cash-register"></i> Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .pos-container {
        position: relative;
    }
    
    .checkout-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    
    .products-container {
        max-height: calc(100vh - 250px);
        overflow-y: auto;
    }
    
    .search-container {
        width: 300px;
    }
</style>
