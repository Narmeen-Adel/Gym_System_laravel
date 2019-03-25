<?php

namespace App\Http\Controllers\Cities;

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
        $users = User::all();
        return view('cities.create',[
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        City::create(request()->all());
        return redirect()->route('cities.index');
    }

    public function edit(City $city)
    {
        return view('cities.edit', [
            'city' => $city,
        ]);
    } 

    public function update(Request $request, City $city)
    {
        $city->update(request()->all());
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
}
