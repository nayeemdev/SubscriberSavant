<?php

namespace App\Http\Requests;

use App\Rules\ExistsInCountriesRule;

class CreateSubscriberRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required|string',
            'country' => ['required', new ExistsInCountriesRule()]
        ];
    }
}
