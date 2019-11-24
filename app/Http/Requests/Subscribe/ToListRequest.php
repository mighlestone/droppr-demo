<?php

namespace App\Http\Requests\Subscribe;

use Illuminate\Foundation\Http\FormRequest;

class ToListRequest extends FormRequest
{
    public const ATTRIBUTES = [
        'subscriber',
        'address',
        'card'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subscriber' => [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|unique:subscriber,email',
                'phone_number' => 'required|numerical|unique:subscriber,phone_number'
            ],
            'address' => [
                'address_line_1' => 'required|string',
                'address_line_2' => 'string',
                'address_line_3' => 'string',
                'county' => 'required|string',
                'postcode' => 'required|string'
            ],
            'card' => [
                'number' => 'required|numerical|max:16',
                'expiry_month' => 'required|date_format:MM',
                'expiry_year' => 'required|date_format:YYYY',
                'cvc' => 'required|int|min:3|max:4'
            ]
        ];
    }
}
