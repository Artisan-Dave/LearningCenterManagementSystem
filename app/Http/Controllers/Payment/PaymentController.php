<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Payment;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class PaymentController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
            'auth',
            // new Middleware('log', only: ['index']),
            // new Middleware('subscribed', except: ['store']),
            new Middleware('admin'),

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(10);
        return view('payments.index', ['payments' => $payments]);
    }

    public function create(Student $student)
    {
        return view('payments.create-payment', compact('student'));
    }

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
