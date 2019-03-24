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
    protected $finishes_at;
    protected $valid_Session=[];

    public function __construct(string $value2)
    {
        $this->finishes_at=$value2;
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
        $sessions=Session::where('day',(new Carbon($value))->format('Y-m-d'))->get();
        $arr=$sessions->pluck('id')->toArray();
        if($arr!=[]){
            foreach ($sessions as $session){
                array_push($this->valid_Session,
                ((((new Carbon($value))->format('H:i:s'))>=($session->finishes_at->format('H:i:s')))
                    ||
                      (($session->starts_at->format('H:i:s'))>((new Carbon($value))->format('H:i:s')))
                      &&
                      (($session->starts_at->format('H:i:s'))>=((new Carbon($this->finishes_at))->format('H:i:s'))))
 
            );}
            if(in_array(false,$this->valid_Session)){
                return false;
            }else{
                return true;
            }
                
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
        return 'Your Session time is not Available';
    }
}
