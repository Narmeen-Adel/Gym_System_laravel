<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
class CityManagersController extends Controller
{
    public function index()
    {
        return view('citymanagers.index', [
            'citymanagers' => User::where('position',2)->get()
        ]);
    }

    public function create()
    {
        $cities=City::all();
        return view('citymanagers.create',[
            'cities'=>$cities,
        ]);
    }


    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('citymanagers.index');
    }


    public function edit(User $citymanager){
        $cities=City::all();
        return view('citymanagers.edit', [
            'citymanager' => $citymanager,
            'cities'=>$cities
            ]);
        }


    public function update(Request $request,User $citymanager){
        $citymanager->update($request->all());
            return redirect()->route('citymanagers.index');
    }


    public function destroy(User $citymanager)
    {
       $affectedRows = User::where('id',$citymanager->id)->delete();
       return redirect()->route('citymanagers.index');
    }
}
