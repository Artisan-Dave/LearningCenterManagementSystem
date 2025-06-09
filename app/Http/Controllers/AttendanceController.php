<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $date = $request->input("date");
        
        foreach($request->attendances as $userId => $status){
            Attendance::updateOrCreate(
                ['user_id' => $userId, 'date' => $date],
                ['status' => $status]
            );
        }

        return redirect()->back()->with('success','Attendance marked successfully.');
    }
}
