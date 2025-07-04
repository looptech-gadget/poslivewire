<?php

namespace App\Services;

use App\Models\Sale;

class ThermalPrintService
{
    /**
     * Generate thermal receipt content
     */
    public function generateReceipt(Sale $sale): string
    {
        $receipt = $this->getReceiptHeader();
        $receipt .= $this->getSaleDetails($sale);
        $receipt .= $this->getReceiptFooter();
        
        return $receipt;
    }
    
    /**
     * Get receipt header
     */
    private function getReceiptHeader(): string
    {
        $businessName = config('app.name', 'POS System');
        $businessAddress = config('pos.business_address', '123 Business Street, City');
        $businessPhone = config('pos.business_phone', '+123 456 7890');
        $businessEmail = config('pos.business_email', 'info@example.com');
        
        return "
{$this->centerText($businessName, 32)}
{$this->centerText($businessAddress, 32)}
{$this->centerText($businessPhone, 32)}
{$this->centerText($businessEmail, 32)}
{$this->getDivider()}
{$this->centerText('RECEIPT', 32)}
";
    }
    
    /**
     * Get sale details
     */
    private function getSaleDetails(Sale $sale): string
    {
        $details = "";
        
        // Sale info
        $details .= "Invoice #: {$sale->invoice_number}\n";
        $details .= "Date: {$sale->created_at->format('d/m/Y h:i A')}\n";
        $details .= "Cashier: " . ($sale->user->name ?? 'Admin') . "\n";
        
        if ($sale->customer) {
            $details .= "Customer: {$sale->customer->name}\n";
            if ($sale->customer->phone) {
                $details .= "Phone: {$sale->customer->phone}\n";
            }
        } else {
            $details .= "Customer: Walk-in Customer\n";
        }
        
        $details .= $this->getDivider();
        
        // Items header
        $details .= $this->formatLine('Item', 'Qty', 'Price', 'Total');
        $details .= $this->getDivider();
        
        // Items
        foreach ($sale->saleItems as $item) {
            $details .= $this->formatItemLine(
                $item->product->name,
                $item->quantity,
                number_format($item->unit_price, 2),
                number_format($item->subtotal, 2)
            );
        }
        
        $details .= $this->getDivider();
        
        // Totals
        $details .= $this->formatTotalLine('Subtotal:', number_format($sale->subtotal, 2));
        
        if ($sale->tax > 0) {
            $details .= $this->formatTotalLine('Tax:', number_format($sale->tax, 2));
        }
        
        if ($sale->discount > 0) {
            $details .= $this->formatTotalLine('Discount:', number_format($sale->discount, 2));
        }
        
        $details .= $this->formatTotalLine('TOTAL:', number_format($sale->total, 2), true);
        $details .= $this->formatTotalLine('Amount Paid:', number_format($sale->amount_paid, 2));
        $details .= $this->formatTotalLine('Change:', number_format($sale->change, 2));
        $details .= $this->formatTotalLine('Payment:', ucfirst($sale->payment_method));
        
        return $details;
    }
    
    /**
     * Get receipt footer
     */
    private function getReceiptFooter(): string
    {
        return "
{$this->getDivider()}
{$this->centerText('Thank you for your purchase!', 32)}
{$this->centerText('Please come again', 32)}
{$this->centerText(now()->format('d/m/Y h:i A'), 32)}
";
    }
    
    /**
     * Center text within given width
     */
    private function centerText(string $text, int $width): string
    {
        $padding = max(0, ($width - strlen($text)) / 2);
        return str_repeat(' ', (int)$padding) . $text;
    }
    
    /**
     * Get divider line
     */
    private function getDivider(): string
    {
        return str_repeat('-', 32) . "\n";
    }
    
    /**
     * Format item line
     */
    private function formatLine(string $item, string $qty, string $price, string $total): string
    {
        return sprintf("%-16s %3s %6s %6s\n", 
            substr($item, 0, 16), 
            $qty, 
            $price, 
            $total
        );
    }
    
    /**
     * Format item line with product details
     */
    private function formatItemLine(string $name, int $qty, string $price, string $total): string
    {
        $line = "";
        
        // Product name (can span multiple lines if long)
        if (strlen($name) > 32) {
            $line .= substr($name, 0, 32) . "\n";
            $remaining = substr($name, 32);
            while (strlen($remaining) > 32) {
                $line .= substr($remaining, 0, 32) . "\n";
                $remaining = substr($remaining, 32);
            }
            if ($remaining) {
                $line .= $remaining . "\n";
            }
        } else {
            $line .= $name . "\n";
        }
        
        // Quantity, price, total line
        $line .= sprintf("%3d x %6s = %8s\n", $qty, $price, $total);
        
        return $line;
    }
    
    /**
     * Format total line
     */
    private function formatTotalLine(string $label, string $amount, bool $bold = false): string
    {
        $line = sprintf("%20s %10s\n", $label, $amount);
        
        if ($bold) {
            return strtoupper($line);
        }
        
        return $line;
    }
    
    /**
     * Generate ESC/POS commands for thermal printer
     */
    public function generateEscPosCommands(Sale $sale): string
    {
        $commands = "";
        
        // Initialize printer
        $commands .= "\x1B\x40"; // ESC @ - Initialize printer
        
        // Set character set
        $commands .= "\x1B\x74\x00"; // ESC t 0 - Select character table
        
        // Center alignment
        $commands .= "\x1B\x61\x01"; // ESC a 1 - Center alignment
        
        // Business name (double height)
        $commands .= "\x1B\x21\x30"; // ESC ! 48 - Double height and width
        $commands .= config('app.name', 'POS System') . "\n";
        
        // Normal size
        $commands .= "\x1B\x21\x00"; // ESC ! 0 - Normal size
        
        // Business details
        $commands .= config('pos.business_address', '123 Business Street, City') . "\n";
        $commands .= config('pos.business_phone', '+123 456 7890') . "\n";
        $commands .= config('pos.business_email', 'info@example.com') . "\n\n";
        
        // Receipt title
        $commands .= "\x1B\x21\x08"; // ESC ! 8 - Emphasized
        $commands .= "RECEIPT\n";
        $commands .= "\x1B\x21\x00"; // ESC ! 0 - Normal
        
        // Left alignment
        $commands .= "\x1B\x61\x00"; // ESC a 0 - Left alignment
        
        // Sale details
        $commands .= "Invoice #: {$sale->invoice_number}\n";
        $commands .= "Date: {$sale->created_at->format('d/m/Y h:i A')}\n";
        $commands .= "Cashier: " . ($sale->user->name ?? 'Admin') . "\n";
        
        if ($sale->customer) {
            $commands .= "Customer: {$sale->customer->name}\n";
        }
        
        $commands .= str_repeat('-', 32) . "\n";
        
        // Items
        foreach ($sale->saleItems as $item) {
            $commands .= $item->product->name . "\n";
            $commands .= sprintf("%d x %.2f = %.2f\n", 
                $item->quantity, 
                $item->unit_price, 
                $item->subtotal
            );
        }
        
        $commands .= str_repeat('-', 32) . "\n";
        
        // Totals
        $commands .= sprintf("Subtotal: %20.2f\n", $sale->subtotal);
        if ($sale->tax > 0) {
            $commands .= sprintf("Tax: %25.2f\n", $sale->tax);
        }
        if ($sale->discount > 0) {
            $commands .= sprintf("Discount: %21.2f\n", $sale->discount);
        }
        
        // Total (emphasized)
        $commands .= "\x1B\x21\x08"; // ESC ! 8 - Emphasized
        $commands .= sprintf("TOTAL: %23.2f\n", $sale->total);
        $commands .= "\x1B\x21\x00"; // ESC ! 0 - Normal
        
        $commands .= sprintf("Amount Paid: %16.2f\n", $sale->amount_paid);
        $commands .= sprintf("Change: %23.2f\n", $sale->change);
        $commands .= "Payment: " . ucfirst($sale->payment_method) . "\n";
        
        // Footer
        $commands .= "\n";
        $commands .= "\x1B\x61\x01"; // ESC a 1 - Center alignment
        $commands .= "Thank you for your purchase!\n";
        $commands .= "Please come again\n\n";
        
        // Cut paper
        $commands .= "\x1D\x56\x41\x10"; // GS V A 16 - Partial cut
        
        return $commands;
    }
}