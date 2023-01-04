<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Support\Str;

class ComplexPassword implements ImplicitRule
{
    public $lengthPasses = true;
    public $uppercasePasses = true;
    public $numericPasses = true;
    public $specialCharacterPasses = true;

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
        $this->lengthPasses = (Str::length($value) >= 7);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->numericPasses = ((bool) preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool) preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $message = "Lozinka mora imati barem 7 karaktera; ";
        switch (true) {
            case ! $this->uppercasePasses:
                $message .= "Lozinka mora imati barem 1 veliko slovo; ";

            case ! $this->numericPasses:
                $message .= "Lozinka mora imati barem 1 broj; ";

            case ! $this->specialCharacterPasses:
                $message .= "Lozinka mora imati barem 1 specijalni karakter; ";                

            default:
                return $message;
        }
    }
}
