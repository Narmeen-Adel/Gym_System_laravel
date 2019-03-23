<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'package_id'=>'required|exists:packages,id',
            
            'user_id'=>'required|exists:users,id'
        ];
    }
    public function message()
    {
        return [
        'package_id.required'=>" insert package ...",
        'package_id.exists'=>"package not found",
        'user_id.required'=>"insert user ",
        'user_id.exists'=>"user not found ",          
    ];
    }
}
