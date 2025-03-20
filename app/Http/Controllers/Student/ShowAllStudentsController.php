<?php

namespace App\Http\Controllers\Student;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowAllStudentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $total = Student::count();
        $students = Student::orderBy('created_at', 'desc')->paginate(10);
        return view('students.main',['students'=>$students,'total'=>$total]);
    }
}
