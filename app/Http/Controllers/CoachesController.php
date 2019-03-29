<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coach;

class CoachesController extends Controller
{
    public function index()
    {
        return view('coaches.index', [
            'coaches' => Coach::all()
        ]);
    }

    public function create()
    {
        return view('coaches.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required']);
        Coach::create($request->all());
        return redirect()->route('coaches.index');
    }


    public function edit(Coach $coach){
        return view('coaches.edit', [
            'coach' => $coach,
            ]);
        }


    public function update(Request $request,Coach $coach){
        $validatedData = $request->validate([
            'name' => 'required']);
        $coach->update($request->all());
            return redirect()->route('coaches.index');
    }

    public function destroy(Coach $coach)
    {
       $affectedRows = Coach::where('id',$coach->id)->delete();
       return redirect()->route('coaches.index');
    }

    public function get_table(){
        return datatables()->of(Coach::query())->toJson();
    }

}
