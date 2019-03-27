<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Customer;
use App\Attendance;
use App\CustomerSession;

class UserAttendancecontroller extends Controller
{
    public function index()
    {
        // $customerSessions=CustomerSession::all();
        // dd($customerSessions);
        return view('attendance.index', [
            'attendances' => CustomerSession::all()
        ]);
    }
}
