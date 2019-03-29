<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use DB;

class CityManagersController extends Controller
{
    public function index()
    {
        return view('citymanagers.index');
    }

    public function create()
    {
        $cities = City::all();
        return view('citymanagers.create', [
            'cities' => $cities,
        ]);
    }


    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'national_id' => 'required|unique:users',

        ]);
        $image = $request->file('image');
        $citymanager = new User();
        $citymanager->name = $request->name;
        $citymanager->email = $request->email;
        $citymanager->password = bcrypt($request->password);
        $citymanager->national_id = $request->national_id;
        $citymanager->position = $request->position;
        $citymanager->save();
        $citymanager->assignRole('city_manager');
        return redirect()->route('citymanagers.index');
    }


    public function edit(User $citymanager)
    {
        $cities = City::all();
        return view('citymanagers.edit', [
            'citymanager' => $citymanager,
            'cities' => $cities
        ]);
    }

    public function update(Request $request, User $citymanager)
    {
        $citymanager->update($request->all());
        return redirect()->route('citymanagers.index');
    }


    public function destroy(User $citymanager)
    {
        $affectedRows = User::where('id', $citymanager->id)->delete();
        return redirect()->route('citymanagers.index');
    }

    public function get_table()
    {
        $citymanager = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->select(
                'users.id as id',
                'users.name as name',
                'users.email as email',
                'users.national_id as national_id'
            )
            ->where('model_has_roles.role_id', '=', 2)
            ->get();

        return datatables()->of($citymanager)->toJson();
    }
}
