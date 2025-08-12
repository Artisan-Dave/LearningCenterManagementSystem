<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;

class CreateBalanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$student_id)
    {
      
            $students = Student::findOrFail($student_id);
            return view('students.create-balance',['students' => $students]);
        
    }
}
