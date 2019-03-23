<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DeleteSessionRule implements Rule
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
        $hasUsers=Attendence::where('session_id',$value)->get();
       return(!$hasUsers);
       }
    

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cant Delete This Session';
    }
}
