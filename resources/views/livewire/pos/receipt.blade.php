<div class="receipt">
    <div class="receipt-header">
        <h2>{{ config('app.name', 'POS System') }}</h2>
        <p>123 Business Street, City</p>
        <p>Phone: +123 456 7890</p>
        <p>Email: info@example.com</p>
        <div class="receipt-divider"></div>
        <h3>RECEIPT</h3>
        <p><strong>Invoice #:</strong> {{ $sale->invoice_number }}</p>
        <p><strong>Date:</strong> {{ $sale->created_at->format('d/m/Y h:i A') }}</p>
        <p><strong>Cashier:</strong> {{ $sale->user->name ?? 'Admin' }}</p>
        @if($sale->customer)
            <p><strong>Customer:</strong> {{ $sale->customer->name }}</p>
            @if($sale->customer->phone)
                <p><strong>Phone:</strong> {{ $sale->customer->phone }}</p>
            @endif
        @else
            <p><strong>Customer:</strong> Walk-in Customer</p>
        @endif
        <div class="receipt-divider"></div>
    </div>
    
    <div class="receipt-body">
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-end">{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="receipt-divider"></div>
        
        <table class="receipt-summary">
            <tr>
                <td>Subtotal:</td>
                <td class="text-end">{{ number_format($sale->subtotal, 2) }}</td>
            </tr>
            @if($sale->tax > 0)
                <tr>
                    <td>Tax:</td>
                    <td class="text-end">{{ number_format($sale->tax, 2) }}</td>
                </tr>
            @endif
            @if($sale->discount > 0)
                <tr>
                    <td>Discount:</td>
                    <td class="text-end">{{ number_format($sale->discount, 2) }}</td>
                </tr>
            @endif
            <tr class="total-row">
                <td>Total:</td>
                <td class="text-end">{{ number_format($sale->total, 2) }}</td>
            </tr>
            <tr>
                <td>Amount Paid:</td>
                <td class="text-end">{{ number_format($sale->amount_paid, 2) }}</td>
            </tr>
            <tr>
                <td>Change:</td>
                <td class="text-end">{{ number_format($sale->change, 2) }}</td>
            </tr>
            <tr>
                <td>Payment Method:</td>
                <td class="text-end">{{ ucfirst($sale->payment_method) }}</td>
            </tr>
        </table>
    </div>
    
    <div class="receipt-footer">
        <p>Thank you for your purchase!</p>
        <p>Please come again</p>
        <p>{{ now()->format('d/m/Y h:i A') }}</p>
    </div>
    
    <style>
        .receipt {
            font-family: 'Courier New', Courier, monospace;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: white;
        }
        
        .receipt-header {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .receipt-header h2 {
            margin: 0;
            font-size: 18px;
        }
        
        .receipt-header h3 {
            margin: 5px 0;
        }
        
        .receipt-header p {
            margin: 3px 0;
            font-size: 12px;
        }
        
        .receipt-divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        
        .receipt-body {
            margin-bottom: 10px;
        }
        
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        
        .receipt-table th, .receipt-table td {
            padding: 3px 0;
        }
        
        .receipt-summary {
            width: 100%;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .receipt-summary td {
            padding: 2px 0;
        }
        
        .total-row {
            font-weight: bold;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-end {
            text-align: right;
        }
        
        .receipt-footer {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
    </style>
</div>
