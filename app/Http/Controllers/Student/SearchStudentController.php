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
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        // Use null coalescing to avoid "undefined index" error
        $search = trim($validated['search'] ?? '');

        if ($search !== '') {
            $students = Student::where('full_name', 'LIKE', "%{$search}%")
                ->orWhere('total_balance', 'LIKE', "%{$search}%")
                ->paginate(10);
        } else {
            $students = Student::paginate(10);
        }

        return view('students.index', ['students'=>$students]);
    }
}
