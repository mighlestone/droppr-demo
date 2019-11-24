<?php


namespace App\Services\Stripe;


class Foundation
{
    /**
     * @var string
     */
    public const STRIPE_VERSION = '2019-08-14';

    /**
     * @param array $options
     * @return array
     */
    public static function stripeOptions(array $options = [])
    {
        return array_merge([
            'api_key' => config('services.stripe.api_key'),
            'stripe_version' => static::STRIPE_VERSION,
        ], $options);
    }
}
