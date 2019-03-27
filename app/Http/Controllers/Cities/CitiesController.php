<?php

namespace App\Http\Controllers\Cities;

use App\User;
use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    public function index()
    {
        return view('cities.index',[
            'cities' => City::all()
        ]);
    }
   
    public function create()
    {
        $users = User::where('position',2)->get();
        return view('cities.create',[
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        City::create(request()->all());
        return redirect()->route('cities.index');
    }

    
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index');
    }

    public function show(City $city)
    {
        return view('cities.show', [
            'city' => $city,
        ]);
    } 
    
    public function get_table(){
        return datatables()->of(City::query())->toJson();
    }
}
