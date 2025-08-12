<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;

class UpdateBalanceController extends Controller
{
    /**
     * Handle the incoming request.
     */


    public function __invoke(Request $request, $student_id)
    {

        $data = $request->validate([
            'full_name' => ['string', 'regex:/^[a-zA-Z\s]+$/'],
            'total_balance' => 'required|numeric'
        ]);
        

        $students = Student::findOrFail($student_id);
        $total_balance = $request->total_balance;

        $students->total_balance = $total_balance;

        $data = $students->save();

        if ($data) {
            session()->flash('success', 'Balance Updated Successfully!');
            return redirect(route('student.main'));
        } else {
            session()->flash('error', 'Something went wrong');
            return redirect()->back()->withInput();
        }
    }
}
