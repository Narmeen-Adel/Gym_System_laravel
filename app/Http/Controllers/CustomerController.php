<?php

namespace App\Http\Controllers;
use App\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index',[
            'customers' => Customer::all()
        ]);
    }

    public function get_table(){
        return datatables()->of(Customer::query())->toJson();
    }
}
