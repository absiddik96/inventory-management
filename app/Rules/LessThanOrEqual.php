<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LessThanOrEqual implements Rule
{
    public $max = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($par)
    {
        $this->max = $par;
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
        if($value<=$this->max){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be less then or equal to '.$this->max.'.';
    }
}
