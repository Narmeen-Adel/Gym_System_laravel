<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        request()->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'national_id'=>'required|unique:users',
            //'image'=>'mimes:jpeg,jpg',
        ]);
        $image=$request->file('image');
        //$extension=$image->getClientOriginalExtension();
        //Storage::disk('public')->put($image->getFilename(), File::get($image));
        $citymanager = new User();
        $citymanager->name = $request->name;
        $citymanager->email = $request->email;
        $citymanager->password = bcrypt($request->password);
        $citymanager->national_id = $request->national_id;
        $citymanager->position=$request->position;
        //$citymanager->image = $image->getFilename();
        $citymanager->save();

        //User::create($request->all());
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

    public function get_table(){
        return datatables()->of(User::query())->toJson();
    }
}
