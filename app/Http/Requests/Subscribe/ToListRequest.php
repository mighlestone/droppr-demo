<?php

namespace App\Http\Requests\Subscribe;

use Illuminate\Foundation\Http\FormRequest;

class ToListRequest extends FormRequest
{
    public const ATTRIBUTES = [
        'email',
        'phone_number',
        'shipping_address_line_1',
        'shipping_address_line_2',
        'shipping_address_line_3',
        'shipping_address_county',
        'shipping_address_postcode',
        'card_name',
        'card_number',
        'card_expiry_date',
        'card_cvv_number'
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
            'email' => 'required|email|unique:subscriber,email',
            'phone_number' => 'required|numerical|unique:subscriber,phone_number',
            'shipping_address_line_1' => 'required|string',
            'shipping_address_line_2' => 'string',
            'shipping_address_line_3' => 'string',
            'shipping_address_county' => 'required|string',
            'shipping_address_postcode' => 'required|string',
            'card_name' => 'required|string',
            'card_number' => 'required|numerical',
            'card_expiry_date' => 'required|date_format:MM/YY',
            'card_cvv_number' => 'required|int|min:3|max:4'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'shipping_address_line_1' => 'address line 1',
            'shipping_address_line_2' => 'address line 2',
            'shipping_address_line_3' => 'address line 3',
            'shipping_address_county' => 'county',
            'shipping_address_postcode' => 'postcode',
            'card_name' => 'card name holder',
            'card_expiry_date' => 'expiry date',
            'card_cvv_number' => 'cvv number'
        ];
    }
}
