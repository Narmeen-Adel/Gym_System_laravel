<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Customer;
use App\Attendance;
use App\CustomerSession;
use Auth;
use DB;

class UserAttendancecontroller extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $role = $user->roles->first()->name;

        if ($role === 'admin') {
            $data = DB::table('customer_session')
                ->join('sessions', 'sessions.id', '=', 'customer_session.session_id')
                ->join('customers', 'customers.id', '=', 'customer_session.customer_id')
                ->join('gyms', 'gyms.id', '=', 'sessions.gym_id')
                ->join('cities', 'cities.id', '=', 'gyms.city_id')
                ->select(
                    'customers.name as custm_name',
                    'customers.email as email',
                    'sessions.name as session_name',
                    'sessions.starts_at as attendanceDate',
                    // 'customer_session.attendance_date as attendanceDate',
                    'gyms.name as gym',
                    'cities.name as city'
                )
                ->get();

            return view('attendance.index', [
                'histories' => $data
            ]);
        } elseif ($role === 'city_manager') {
            $id = Auth::user()->id;
            $city_id = DB::table('cities')
                ->select('cities.id')
                ->where('cities.city_manager_id', '=', $id)
                ->value('id');

            $data = DB::table('customer_session')
                ->join('sessions', 'sessions.id', '=', 'customer_session.session_id')
                ->join('customers', 'customers.id', '=', 'customer_session.customer_id')
                ->join('gyms', 'gyms.id', '=', 'sessions.gym_id')
                ->select(
                    'customers.name as custm_name',
                    'customers.email as email',
                    'sessions.name as session_name',
                    'sessions.starts_at as attendanceDate',
                    // 'customer_session.attendance_date as attendanceDate',
                    'gyms.name as gym'
                )->where('gyms.city_id', '=', $city_id)->get();



            return view('attendance.index', [
                'histories' => $data
            ]);
        } elseif ($role === 'gym_manager') {
            $id = Auth::user()->id;
            $gym_id = DB::table('users')
                ->select('users.gym_id')
                ->where('users.id', '=', $id)
                ->value('id');
                // dd($gym_id);
            $data = DB::table('customer_session')
                ->join('sessions', 'sessions.id', '=', 'customer_session.session_id')
                ->join('customers', 'customers.id', '=', 'customer_session.customer_id')
                ->join('gyms', 'gyms.id', '=', 'sessions.gym_id')
                ->select(
                    'customers.name as custm_name',
                    'customers.email as email',
                    'sessions.name as session_name',
                    'sessions.starts_at as attendanceDate'
                    // 'customer_session.attendance_date as attendanceDate',
                )->where('gyms.id', '=', $gym_id)
                ->get();

            return view('attendance.index', [
                'histories' => $data
            ]);
        }
    }
}
