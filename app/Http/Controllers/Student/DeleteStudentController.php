<?php

namespace App\Http\Controllers\Student;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($student_id)
    {
        $students = Student::findOrFail($student_id)->delete();
        if($students){
            session()->flash('success','Student deleted Successfully');
            return redirect(route('student.main'));
        }else{
            session()->flash('error','Student Deletion Failed');
            return redirect(route('student.main'));
        }
    }
}
