<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Customer;
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
      return view('sales.index',[
          'sales' => Sale::all(),
          'sum' => Sale::all()->sum('paid_price'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create',['customers'=>Customer::all(),'packages' =>Package::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {

      $pack=Package::find($request->package_id);
      Sale::create([
      'available_sessions'=>$pack->sessionsNumber,
      'paid_price'=>$pack->price,
      'package_id'=>$pack->id,
      'user_id'=>$request->customer_id]);
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
