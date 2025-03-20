<?php

namespace App\Http\Controllers\Student;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class SearchStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->input('search');
        $total = Student::count();
        try{
            if($search){
                $students = Student::where('full_name', 'LIKE', "%{$search}%")
                // ->orWhere('middlename', 'LIKE', "%{$search}%")
                // ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('total_balance','LIKE',"%{$search}%")
                ->paginate(10);
            }else{
                $students = Student::paginate(10);
            }
        }
        catch(Exception $e){
            session()->flash('error', 'Something went wrong!');
            return redirect(route('students.main'));
        }
        
        return view('students.main', compact("students","total"));
    }
}
