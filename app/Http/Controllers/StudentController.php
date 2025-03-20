<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $total = Student::count();
        if($search){
            $students = Student::where('firstname', 'LIKE', "%{$search}%")
            ->orWhere('middlename', 'LIKE', "%{$search}%")
            ->orWhere('lastname', 'LIKE', "%{$search}%")
            ->paginate(10);
        }else{
            $students = Student::paginate(10);
        }
        
        return view('students.main', compact("students","total"));
    }

    public function delete($id){
        
        $students = Student::findOrFail($id)->delete();
        if($students){
            session()->flash('success','Student deleted Successfully');
            return redirect(route('student.main'));
        }else{
            session()->flash('error','Student Deletion Failed');
            return redirect(route('student.main'));
        }
    }
}
