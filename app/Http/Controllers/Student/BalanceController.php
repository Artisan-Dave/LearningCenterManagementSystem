<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class BalanceController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
            'auth',
            // new Middleware('log', only: ['index']),
            // new Middleware('subscribed', except: ['store']),
            new Middleware('admin'),

        ];
    }

    public function create(Student $student){

        return view('students.create-balance',compact('student'));
    }

    public function update(Request $request, Student $student){

        $data = $request->validate([
            'total_balance' => 'required|numeric'
        ]);

        $student->total_balance = $data['total_balance'];

        $student->save();

        return redirect(route('students.index'))->with('success','Student balance updated');

    }

}
