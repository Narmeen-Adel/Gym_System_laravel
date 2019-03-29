<?php

namespace App\Http\Controllers;
use App\Package;
use App\Gym;
use Illuminate\Http\Request;


class PackageController extends Controller
{
    public function index()
    {

        return view('packages.index', [
            'packages' => Package::all()
        ]);

    }

    public function create()
    {
        $gyms = Gym::all();
        return view('packages.create',[
            'gyms' => $gyms,
        ]);
    }


    public function store()
    {
        $req=request()->all();
        Package::create($req);
        return redirect()->route('packages.index');
    }

    public function edit(Package $package)
    {
        return view('packages.edit', [
            'packages' => $package,
        ]);
    }

    public function update(Package $package,Request $request){
        $package->update($request->all());
        return redirect()->route('packages.index');
    }

    public function delete(Package $package){

        $package->delete();
        return redirect()->route('packages.index');
    }

    public function get_table(){
        return datatables()->of(Package::query())->toJson();
    }

}
