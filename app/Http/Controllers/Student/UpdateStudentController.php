<?php

namespace App\Http\Controllers\Student;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UpdateStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $student_id)
    {
    
        $data = $request->validate([
            'full_name' => ['required','string','regex:/^[a-zA-Z\s]+$/']
        ]); 

        $existingStudent = Student::where('full_name',$data['full_name'])
            ->first();

        $deletedStudent = Student::onlyTrashed()
            ->where('full_name',$data['full_name'])
            ->first();


        if ($existingStudent) {
            session()->flash('error', 'Student already enrolled');
            return redirect()->back()->withInput();
        }elseif($deletedStudent){
            session()->flash('error', 'Something went wrong');
            return redirect()->back()->withInput();
        }

        $students = Student::findOrFail($student_id);
        $full_name = $request->full_name;
        
        $students->full_name = $full_name;
       
        $data = $students->save();

        if ($data) {
            session()->flash('success', 'Student updated successfully!');
            return redirect(route('student.main'));
        } else {
            session()->flast('error', 'Some problem occured');
            return redirect()->back()->withInput();
        }

    }
}
