<?php

namespace App\Http\Controllers\Payment;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;

class CreatePaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$student_id)
    {
        $decryptedId = Crypt::decrypt($student_id);

        $students = Student::findOrFail($decryptedId);
        return view('payments.create-payment',['students'=>$students]);
    }
}
