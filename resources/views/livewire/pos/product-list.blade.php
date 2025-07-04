<div class="product-grid">
    @if($products->isEmpty())
        <div class="alert alert-info">
            No products found. Try a different category or search term.
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="card product-card h-100 {{ $product->stock_quantity <= 0 ? 'out-of-stock' : '' }}" 
                         wire:click="addToCart({{ $product->id }})">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                            @else
                                <div class="no-image">
                                    <i class="fas fa-box fa-3x"></i>
                                </div>
                            @endif
                            @if($product->stock_quantity <= 0)
                                <div class="out-of-stock-label">
                                    Out of Stock
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h6 class="card-title mb-1">{{ $product->name }}</h6>
                            <p class="card-text mb-0 text-primary fw-bold">{{ number_format($product->price, 2) }}</p>
                            <small class="text-muted">SKU: {{ $product->sku }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .product-card {
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid #ddd;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .product-image {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        background-color: #f8f9fa;
    }
    
    .product-image img {
        max-height: 100%;
        object-fit: contain;
    }
    
    .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
        color: #adb5bd;
    }
    
    .out-of-stock {
        opacity: 0.6;
    }
    
    .out-of-stock-label {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>
