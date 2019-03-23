<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OverlapValidateRule;

class StoreSessionRequest extends FormRequest
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
        return [
            'starts_at' => new OverlapValidateRule,
            'day' => 'after_or_equal:'.date('d-m-Y'),
            'starts_at'=>'gte:'.date('Y-m-d H:i:s A'),
            'coach_id' => 'exists:coaches,id',
            'gym_id' => 'exists:gyms,id',
            'package_id' => 'exists:packages,id'
        ];
    }
    public function messages()
    {
        return [

            'couch_id.exists'=>'This Id is not Exists please enter valid coach id',
            'gym_id.exists'=>'This Id is not Exists please enter valid gym id',
            'package_id.exists'=>'This Id is not Exists please enter valid package id',

        ];
    }
}
