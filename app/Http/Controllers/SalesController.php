<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Customer;
use App\Package;
use Stripe\Stripe;
use App\Gym;
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
          'customers' => Customer::all(),
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
        return view('sales.create',['customers'=>Customer::all(),'packages' =>Package::all(),'gyms' =>Gym::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
    
        Stripe::setApiKey("sk_test_m5t3Ge3l73E7UGiQYukXfh3K00SMAhGxvr");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;
        $package=Package::find($request->package_id);
        $currency = $package->price;
    
        $charge = \Stripe\Charge::create([
            'amount' => $currency,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);
        

   
        if ($charge->status=="succeeded"){
            Sale::create(request()->all());
            return redirect()->route('sales.index');   
        }
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
