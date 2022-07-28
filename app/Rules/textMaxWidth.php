<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class textMaxWidth implements Rule
{
    private $max;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $max)
    {
        $this->max = $max;
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
        return mb_strwidth($value) <= $this->max;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return ":attributeは全角".($this->max / 2)."・半角{$this->max}文字以下で入力してください。";
    }
}
