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
    public function __invoke(Request $request, Payment $payment)
    {
        $invoice = (object) [
            'id' => $payment->id,
            'items' => [
                [
                    'full_name' => $payment->full_name,
                    'amount' => $payment->amount,
                    'total_balance' => $payment->total_balance,
                    'date_of_payment' => $payment->created_at->format('F j, Y g:i A'),
                ],
            ],
        ];

        return view('invoices.invoice', compact('invoice'));
    }

}
