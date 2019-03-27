<?php

namespace App\Http\Controllers\Gyms;

use App\Gym;
use App\User;
use App\City;
use App\Http\Requests\Gym\StoreGymRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymsController extends Controller
{
    public function index()
    {
        return view('gyms.index',[
            'gyms' => Gym::all()
        ]);
    }
   
    public function create()
    {
        $cities = City::all();
        return view('gyms.create',[
            'cities' => $cities
        ]);
    }

    public function store(StoreGymRequest $request)
    {
        Gym::create(request()->all());
        return redirect()->route('gyms.index');
    }

    public function edit(Gym $gym)
    {
        return view('gyms.edit', [
            'gym' => $gym,
        ]);
    } 

    public function update(Request $request, Gym $gym)
    {
        $gym->update(request()->all());
        return redirect()->route('gyms.index');
    }

    public function destroy(Gym $gym)
    {
        $gym->delete();
        return redirect()->route('gyms.index');
    }

    public function show(Gym $gym)
    {
        return view('gyms.show', [
            'gym' => $gym,
        ]);
    }  
    
    public function get_table(){
        return datatables()->of(Gym::with('City'))->toJson();
    }
}
