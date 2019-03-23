<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Session;
use Carbon\Carbon;


class OverlapValidateRule implements Rule
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
        $sessions=Session::where('day',(new Carbon($value))->format('d-m-Y'))->get();
        if($sessions){
            foreach ($sessions as $session){
                return((new Carbon($value))->format('H:i:s A')>=$session->finishes_at->format('H:i:s A')||$session->starts_at->format('H:i:s A')>=(new Carbon($value))->format('H:i:s A'));
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your Session time is not Available';
    }
}
