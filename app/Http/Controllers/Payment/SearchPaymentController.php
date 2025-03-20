<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class SearchPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->input('search');
        $total = Payment::count();
        try {
            if ($search) {
                $payments = Payment::where('full_name', 'LIKE', "%{$search}%")
                    ->orWhere('amount', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->paginate(10);
            } else {
                $payments = Payment::paginate(10);
            }
        } catch (Exception $e) {
            session()->flash('error', 'Something went wrong!');
            return redirect(route('payment.main'));
        }

        return view('payments.main', compact("payments", "total"));
    }
}

