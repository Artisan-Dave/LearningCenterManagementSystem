<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Student;
use Pest\Plugins\Only;

class StudentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            // new Middleware('log', only: ['index']),
            // new Middleware('subscribed', except: ['store']),
            new Middleware('admin', only: ['edit', 'update', 'destroy']),

        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Student::count();
        $students = Student::orderBy('created_at', 'desc')->paginate(10);
        return view('students.index', ['students' => $students, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            return redirect(route('students.index'));
        }

        $newStudent = Student::create($data);
        session()->flash('success', 'Student enrolled successfully!');
        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $students = Student::findOrFail($id);
        $full_name = $request->full_name;
        
        $students->full_name = $full_name;
       
        $data = $students->save();

        if ($data) {
            session()->flash('success', 'Student updated successfully!');
            return redirect(route('students.index'));
        } else {
            session()->flast('error', 'Some problem occured');
            return redirect()->back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
