<?php

namespace App\Http\Controllers;
use App\User;
use App\Gym;
use App\City;

use Illuminate\Http\Request;

class GymManagersController extends Controller
{
    public function index()
    {
        return view('gymmanagers.index', [
            'gymmanagers' => User::where('position',3)->get()
        ]);
    }

    public function create()
    {
        $gyms = Gym::all();
        $cities=City::all();
        return view('gymmanagers.create',[
            'gyms' => $gyms,
            'cities'=>$cities,
        ]);
    }


    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('gymmanagers.index');
    }


    public function edit(User $gymmanager){
        $gyms = Gym::all();
        $cities=City::all();
        return view('gymmanagers.edit', [
            'gymmanager' => $gymmanager,
            'gyms' => $gyms,
            'cities'=>$cities
            ]);
        }


    public function update(Request $request,User $gymmanager){
        $gymmanager->update($request->all());
            return redirect()->route('gymmanagers.index');
    }


    public function destroy(User $gymmanager)
    {
       $affectedRows = User::where('id',$gymmanager->id)->delete();
       return redirect()->route('gymmanagers.index');
    }

}
