<?php

namespace App\Http\Controllers\Gyms;

use App\Gym;
use App\User;
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
        $users = User::all();
        return view('gyms.create',[
            'users' => $users
        ]);
    }

    public function store(Request $request)
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
}
