<?php

namespace App\Http\Requests;

use App\Rules\ExistsInCountriesRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'country' => ['required', new ExistsInCountriesRule()]
        ];
    }
}
