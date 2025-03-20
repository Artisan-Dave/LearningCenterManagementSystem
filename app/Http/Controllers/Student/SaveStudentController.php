<?php

namespace App\Http\Controllers\Student;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'full_name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/']
        ]);

        $existingStudent = Student::where('full_name', $data['full_name'])
            ->first();

        $restoreStudent = Student::onlyTrashed()
            ->where('full_name', $data['full_name'])
            ->first();

        if ($existingStudent) {
            session()->flash('error', 'Student Already Enrolled');
            return redirect()->back()->withInput();
        }
        if ($restoreStudent) {
            $restoreStudent->restore();
            session()->flash('success', 'Student enrolled successfully!');
            return redirect(route('student.main'));
        }

        $newStudent = Student::create($data);
        session()->flash('success', 'Student enrolled successfully!');
        return redirect(route('student.main'));

    }
}
