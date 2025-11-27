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
    public function __invoke(Request $request, Student $student)
    {
        return view('payments.create-payment',['student'=>$student]);
    }
}
