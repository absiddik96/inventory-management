<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GreaterThanOrEqual implements Rule
{
    public $min = null;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($par)
    {
        $this->min = $par;
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
        if($value>=$this->min){
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
        return 'The :attribute must be greater than or equal to '.$this->min.'.';
    }
}
