@extends('layouts.app')

@section('title', 'Point of Sale')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Point of Sale</h1>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="toggleFullscreen()">
                        <i class="fas fa-expand"></i> Fullscreen
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
            
            @livewire('pos.pos-page')
        </div>
    </div>
</div>

<!-- Alert Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalTitle">Alert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <!-- Alert message will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .pos-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background: white;
        overflow: auto;
    }
    
    .pos-fullscreen .container-fluid {
        height: 100vh;
        padding: 20px;
    }
    
    @media print {
        body * {
            visibility: hidden;
        }
        
        .receipt, .receipt * {
            visibility: visible;
        }
        
        .receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Fullscreen toggle
    function toggleFullscreen() {
        const container = document.querySelector('.container-fluid').parentElement;
        if (container.classList.contains('pos-fullscreen')) {
            container.classList.remove('pos-fullscreen');
        } else {
            container.classList.add('pos-fullscreen');
        }
    }
    
    // Listen for Livewire events
    document.addEventListener('livewire:init', () => {
        Livewire.on('showAlert', (data) => {
            const modal = new bootstrap.Modal(document.getElementById('alertModal'));
            const title = document.getElementById('alertModalTitle');
            const body = document.getElementById('alertModalBody');
            
            title.textContent = data.type === 'error' ? 'Error' : 'Success';
            body.textContent = data.message;
            
            modal.show();
        });
        
        Livewire.on('printReceipt', (data) => {
            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Receipt</title>
                    <style>
                        body { font-family: 'Courier New', Courier, monospace; margin: 0; padding: 20px; }
                        .receipt { max-width: 400px; margin: 0 auto; }
                        .receipt-header { text-align: center; margin-bottom: 10px; }
                        .receipt-header h2 { margin: 0; font-size: 18px; }
                        .receipt-header h3 { margin: 5px 0; }
                        .receipt-header p { margin: 3px 0; font-size: 12px; }
                        .receipt-divider { border-top: 1px dashed #000; margin: 10px 0; }
                        .receipt-table { width: 100%; border-collapse: collapse; font-size: 12px; }
                        .receipt-table th, .receipt-table td { padding: 3px 0; }
                        .receipt-summary { width: 100%; font-size: 12px; margin-top: 5px; }
                        .receipt-summary td { padding: 2px 0; }
                        .total-row { font-weight: bold; }
                        .text-center { text-align: center; }
                        .text-end { text-align: right; }
                        .receipt-footer { text-align: center; margin-top: 10px; font-size: 12px; border-top: 1px dashed #000; padding-top: 10px; }
                    </style>
                </head>
                <body>
                    ${data.receiptContent}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        });
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // F11 for fullscreen
        if (e.key === 'F11') {
            e.preventDefault();
            toggleFullscreen();
        }
        
        // Escape to exit fullscreen
        if (e.key === 'Escape') {
            const container = document.querySelector('.container-fluid').parentElement;
            if (container.classList.contains('pos-fullscreen')) {
                container.classList.remove('pos-fullscreen');
            }
        }
    });
</script>
@endpush