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
            //'starts_at' => new OverlapValidateRule,
            'day' => 'after_or_equal:'.date('Y-m-d'),
            'starts_at'=>'after_or_equal:'.date('Y-m-d H:i:s'),
            'coach_id' => 'exists:coaches,id',
            'gym_id' => 'exists:gyms,id',
            'package_id' => 'exists:packages,id',
            'finishes_at'=>'after:starts_at',
            'day' => 'required',
            'starts_at'=>'required',
            'finishes_at'=>'required',
            'name'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'day.after_or_equal'=>'This day is Passed',
            'starts_at.after_or_equal'=>'The session start time passed',
            'couch_id.exists'=>'This Id is not Exists please enter valid coach id',
            'gym_id.exists'=>'This Id is not Exists please enter valid gym id',
            'package_id.exists'=>'This Id is not Exists please enter valid package id',
            'finishes_at.after'=>'The finshes_at time of the session must be after its start time',

        ];
    }
}
