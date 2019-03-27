<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Customer;
use App\Attendance;
use App\CustomerSession;
use DB;

class UserAttendancecontroller extends Controller
{
    public function index()
    {
        $data=DB::table('customer_session')
                ->join('sessions','sessions.id','=','customer_session.session_id')
                ->join('customers','customers.id','=','customer_session.customer_id')
                ->join('gyms','gyms.id','=','sessions.gym_id')
                ->join('cities','cities.id','=','gyms.city_id')
                ->select('customers.name as custm_name','customers.email as email',
                'sessions.name as session_name','customer_session.attendance_date as attendanceDate',
                'gyms.name as gym','cities.name as city')
                ->get();
        // dd($data);
        return view('attendance.index', [
            'histories' => $data
        ]);
    }
}
