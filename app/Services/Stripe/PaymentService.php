<?php

namespace App\Services\Stripe;

use App\Models\Subscriber;
use Illuminate\Support\Collection;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;

class PaymentService
{
    /**
     * @param Collection $card
     * @param Subscriber|null $subscriber
     */
    public function createNewPaymentMethod(Collection $card, ?Subscriber $subscriber = null)
    {
        $paymentMethod = PaymentMethod::create([
            'type' => 'card',
            'card' => $card->toArray()
        ]);

        if (is_null($subscriber) === false) {
            $paymentMethod->attach([
                'customer' => $subscriber->stripe_id
            ]);
        }
    }
}
