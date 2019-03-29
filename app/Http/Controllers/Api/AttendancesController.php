<?php

namespace App\Http\Controllers\Api;
use App\Attendence;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\AuthController;

class AttendancesController extends Controller
{
    
    // public function __construct(AuthController $auth){
    //     dd($auth->me());

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function store(Request $request)
    {
        dd("hhhh");
       Attendence::create(["session_id"=>$request->session_id,"user_id" =>auth()->user()->id]);
       return response()->json([
        'message' => 'you are register to that  session '
    ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }
  
}
