<?php

namespace ALttP\Rules;

use Illuminate\Contracts\Validation\Rule;

class OverrideStartScreenRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_array($value)) {
            return count($value) === 5 && min($value) >= 0x00 && max($value) <= 0x1F;
        } else if ($value === false) {
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
        return 'Value of :attribute must be a five integer array between 0 and 31!';
    }
}
