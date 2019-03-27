<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
             'email'=>'email|required_with:Customer',
            'password'=>'required|min:8',
            'date_of_birth'=>'date:Y-m-d',//after:strtotime(1/1/1930)|before:strtotime(1/1/2015)',
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
        'date_of_birth.date'=>"d/m/y",
        //'date_of_birth.after'=>"not valide date",
        'gender'=>"not valid gender"
    ];
    }
}
