<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use App\Package;
use Illuminate\Http\Request;
use App\Http\Requests\Sale\StoreSaleRequest;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('sales.index',['sales' => Sale::all()]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create',['users'=>User::all(),'packages' =>Package::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    { 
      //dd($request->fillable->package_id);
     // dd($request->all());
      //$request=$request->all();
     $pack=Package::find($request->package_id);
    // dd($pack->price);
   
     $user_id=$request->user_id;
    // dd($request->all());
      

      Sale::create([

      'available_sessions'=>$pack->sessionsNumber,
      'paid_price'=>$pack->price,
      'package_id'=>$pack->id,
      'user_id'=>$request->user_id]);
      return redirect()->route('sales.index');   
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    
}
