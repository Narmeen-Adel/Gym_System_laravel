<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasUsersSessionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $hasUsers=Attendance::select('select * from attendance where session_id=:id',['id'=>$session->id]);
        $arr=$hasUsers->pluck('id')->toArray();
        dd($arr);
        if($arr!=[]){
            return false;
        }else{
            return true;
        }
    }
    

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Can not Deal with This Session it has users';
    }
}
