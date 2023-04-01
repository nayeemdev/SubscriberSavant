<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExistsInCountriesRule implements Rule
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
    public function passes($attribute, $value): bool
    {
        // check if the country name exists in the countries json file
        if (in_array($value, $this->countries())) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is not valid.';
    }

    public function countries(): array
    {
        $jsonOfCountries = file_get_contents(database_path('resources/countries.json'));
        $countries = json_decode($jsonOfCountries, true);

        return array_column($countries, 'name');
    }
}
