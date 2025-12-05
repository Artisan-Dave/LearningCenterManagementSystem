<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Crypt;
use Illuminate\Http\Request;
use Exception; // Import the Exception class

class SavePaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Student $student)
    {
        try {
            // Decrypt the student ID
            // $decryptedId = Crypt::decrypt($student_id);

            // Validate the request
            $request->validate([
                'full_name' => 'required|string',
                'amount' => 'required|numeric',
            ]);

            // Verify the student exists with matching full_name
            $paidStudent = Student::where('student_id', $student)
                              ->where('full_name', $request->full_name)
                              ->first();

            if (!$paidStudent) {
                session()->flash('error', 'Student not found or name mismatch!');
                return redirect()->back()->withInput();
            }

            // Check if the student has sufficient balance
            if ($paidStudent->total_balance < $request->amount) {
                session()->flash('error', 'Amount insufficient. Check the total balance!');
                return redirect()->back()->withInput();
            }

            // Start a database transaction (optional but recommended)
            \DB::beginTransaction();

            // Update the student's balance
            $paidStudent->total_balance -= $request->amount;
            $paidStudent->save();

            // Create the payment record
            Payment::create([
                'student_id' => $student,
                'full_name' => $request->full_name,
                'amount' => $request->amount,
                'total_balance' => $paidStudent->total_balance,
            ]);

            // Commit the transaction (if using transactions)
            \DB::commit();

            // Flash success message and redirect
            session()->flash('success', 'Payment recorded successfully!');
            return redirect(route('payment.main'));

        } catch (Exception $e) {
            // Roll back the transaction (if using transactions)
            \DB::rollBack();

            // Log the error (optional)
            \Log::error('Payment processing error: ' . $e->getMessage());

            // Flash an error message and redirect back
            session()->flash('error', 'An error occurred while processing the payment. Please try again.');
            return redirect()->back()->withInput();
        }
    }
}