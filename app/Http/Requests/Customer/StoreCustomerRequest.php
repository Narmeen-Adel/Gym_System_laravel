<?php

namespace App\Http\Requests\Customer;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
            'name'=>'required |min:9',
            'email'=>'required|unique:customers|email',
            'password'=>'required|min:8|confirmed',
            //'date_of_birth'=>'date|required|',//after:strtotime(1/1/1930)|before:strtotime(1/1/2015)',
            'gender'=>'in:male,female',
            //'image'=>'',
            
          
        ];
    }

    public function message()
    {
        return [
        'name.required'=>" insert name ...",
        'name.min'=>" name  at least 9 character...",
        'email.required'=>"insert email ",
        'email.unique'=>"email must be nique ",
        'password.required'=>" insert password  ",
        'password.min'=>"password is short", 
        //'date_of_birth.format'=>"d/m/y",
        'date_of_birth.after'=>"not valide date",
        'gender'=>"not valid gender",
        'password.confirm'=>"must be identical"
    ];
    }
}
