<?php

namespace App\Http\Controllers\Payment;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowAllPaymentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $total = Payment::count();
        $payments = Payment::orderBy('created_at', 'desc')->paginate(10);
        return view('payments.index',['payments'=>$payments,'total'=>$total]);
    }
}
