<?php

namespace App\Http\Controllers;

use App\User;
use App\Gym;
use App\City;

use Illuminate\Http\Request;
use Auth;
use DB;


class GymManagersController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $role = $user->roles->first()->name;
        if ($role === 'admin') {
            $data = DB::table('users')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->where('model_has_roles.role_id', '=', 3)
                ->get();

            return view('gymmanagers.index', [
                'gymmanagers' => $data
            ]);
        } elseif ($role === 'city_manager') {
            $id = Auth::user()->id;
            $city_id = DB::table('cities')
                ->select('cities.id')
                ->where('cities.city_manager_id', '=', $id)
                ->value('id');

            $data = DB::table('users')
                ->join('gyms', 'gyms.id', '=', 'users.gym_id')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->select('users.name')
                ->where('model_has_roles.role_id', '=', 3)
                ->where('gyms.city_id', '=', $city_id)
                ->get();
            // dd($data);
            return view('gymmanagers.index', [
                'gymmanagers' => $data
            ]);
        }
    }

    public function create()
    {
        $gyms = Gym::all();
        $cities = City::all();
        return view('gymmanagers.create', [
            'gyms' => $gyms,
            'cities' => $cities,
        ]);
    }


    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'national_id' => 'required|unique:users',
            //'image'=>'mimes:jpeg,jpg',
        ]);
        $image = $request->file('image');
        //$extension=$image->getClientOriginalExtension();
        //Storage::disk('public')->put($image->getFilename(), File::get($image));
        $gymmanager = new User();
        $gymmanager->name = $request->name;
        $gymmanager->email = $request->email;
        $gymmanager->password = bcrypt($request->password);
        $gymmanager->national_id = $request->national_id;
        $gymmanager->position = $request->position;
        //$gymmanager->image = $image->getFilename();
        $gymmanager->save();
        //User::create($request->all());
        return redirect()->route('gymmanagers.index');
    }


    public function edit(User $gymmanager)
    {
        $gyms = Gym::all();
        $cities = City::all();
        return view('gymmanagers.edit', [
            'gymmanager' => $gymmanager,
            'gyms' => $gyms,
            'cities' => $cities
        ]);
    }


    public function update(Request $request, User $gymmanager)
    {
        $gymmanager->update($request->all());
        return redirect()->route('gymmanagers.index');
    }


    public function destroy(User $gymmanager)
    {
        $affectedRows = User::where('id', $gymmanager->id)->delete();
        return redirect()->route('gymmanagers.index');
    }


    public function get_table()
    {
        $user = \Auth::user();
        $role = $user->roles->first()->name;
        if ($role === 'admin') {
            $data = DB::table('users')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->where('model_has_roles.role_id', '=', 3)
                ->get();
            return datatables()->of($data)->toJson();
        } elseif ($role === 'city_manager') {
            $id = Auth::user()->id;
            $city_id = DB::table('cities')
                ->select('cities.id')
                ->where('cities.city_manager_id', '=', $id)
                ->value('id');

            $data = DB::table('users')
                ->join('gyms', 'gyms.id', '=', 'users.gym_id')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'users.name as name',
                    'users.email as email',
                    'users.national_id as national_id',
                    'users.banned_at as banned_at'
                )
                ->where('model_has_roles.role_id', '=', 3)
                ->where('gyms.city_id', '=', $city_id)
                ->get();

            return datatables()->of($data)->toJson();
        }
    }

    public function ban(User $gymmanager)
    {
        // User::where('id', $gymmanager->id)->delete();
        $gymmanager->ban();
        return redirect()->route('gymmanagers.index');
    }
    public function unban(User $gymmanager)
    {
        // User::where('id', $gymmanager->id)->delete();
        $gymmanager->unban();
        return redirect()->route('gymmanagers.index');
    }

}
