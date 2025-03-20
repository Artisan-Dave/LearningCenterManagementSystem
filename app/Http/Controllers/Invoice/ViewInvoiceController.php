<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;


class ViewInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $payment_id)
    {
        $payment = Payment::where('payment_id', $payment_id)->first();

        $full_name = $payment->full_name;
        $amount = $payment->amount;
        $total_balance = $payment->total_balance;
        $created_at = $payment->created_at;

        $invoice = (object) [
            'id' => $payment_id,
            'items' => [
                ['full_name' => $full_name, 'amount' => $amount, 'total_balance' => $total_balance, 'date_of_payment' => $created_at],
            ],
        ];
    
        return view('invoices.invoice', compact('invoice'));
    }
}
