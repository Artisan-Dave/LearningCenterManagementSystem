<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;

class DownloadInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Payment $payment)
    {

        $full_name = $payment->full_name;
        $amount = $payment->amount;
        $total_balance = $payment->total_balance;
        $created_at = $payment->created_at->format('F j, Y g:i A');

        $invoice = (object) [
            'id' => $payment->id,
            'items' => [
                ['full_name' => $full_name, 'amount' => $amount, 'total_balance' => $total_balance, 'date_of_payment' => $created_at],
            ],
        ];

        // Clean up the full_name to make it safe for file names (remove spaces, special characters)
        $file_name = preg_replace('/[^a-zA-Z0-9_ -]/', '', $full_name);  // Remove special characters
        $file_name = str_replace(' ', '_', $file_name);  // Replace spaces with underscores

        $pdf = Pdf::loadView('invoices.invoice', compact('invoice'));
        return $pdf->download('invoice_' . $file_name . '' . '.pdf');

    }
}
