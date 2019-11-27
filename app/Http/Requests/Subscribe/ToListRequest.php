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
            'subscriber.first_name' => 'required|string|max:100',
            'subscriber.last_name' => 'required|string|max:100',
            'subscriber.email' => 'required|email|unique:subscriber,email',
            'subscriber.phone_number' => 'required|numerical|unique:subscriber,phone_number',
            'address.address_line_1' => 'required|string',
            'address.address_line_2' => 'string',
            'address.address_line_3' => 'string',
            'address.county' => 'required|string',
            'address.postcode' => 'required|string',
            'card.number' => 'required|numerical|max:16',
            'card.expiry_month' => 'required|date_format:MM',
            'card.expiry_year' => 'required|date_format:YYYY',
            'card.cvc' => 'required|int|min:3|max:4'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'subscriber.first_name' => 'first name',
            'subscriber.last_name' => 'last name',
            'subscriber.email' => 'email',
            'subscriber.phone_number' => 'phone number',
            'address.address_line_1' => 'address line 1',
            'address.address_line_2' => 'address line 2',
            'address.address_line_3' => 'address line 3',
            'address.county' => 'county',
            'address.postcode' => 'postcode',
            'card.number' => 'number',
            'card.expiry_month' => 'expiry month',
            'card.expiry_year' => 'expiry year',
            'card.cvc' => 'cvc number',
        ];
    }
}
