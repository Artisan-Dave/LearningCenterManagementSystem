<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function store(Request $request, Student $student)
    {
        try {
            // Validate request
            $request->validate([
                'amount' => 'required|numeric|min:1',
            ]);

            // Check if student has enough balance
            if ($student->total_balance < $request->amount) {
                return back()->with('error', 'Amount exceeds student balance!')->withInput();
            }

            DB::beginTransaction();

            // Deduct balance
            $student->total_balance -= $request->amount;
            $student->save();

            // Create payment (relationship-based)
            $student->payments()->create([
                'full_name' => $student->full_name,   // snapshot of current name
                'amount' => $request->amount,
                'total_balance' => $student->total_balance,
            ]);

            DB::commit();

            return redirect()->route('payment.main')
                ->with('success', 'Payment recorded successfully!');

        } catch (Exception $e) {

            DB::rollBack();
            Log::error("Payment error: " . $e->getMessage());

            return back()->with('error', 'Something went wrong, please try again.')
                ->withInput();
        }
    }
}
