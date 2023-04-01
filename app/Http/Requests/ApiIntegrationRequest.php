<?php

namespace App\Http\Requests;

class ApiIntegrationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'api_key' => 'required',
        ];
    }
}
