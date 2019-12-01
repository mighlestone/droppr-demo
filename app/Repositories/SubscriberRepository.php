<?php

namespace App\Repositories;

use App\Models\Subscriber;
use Illuminate\Support\Collection;

class SubscriberRepository
{
    /**
     * @param array $subscriber
     * @return Subscriber
     */
    public function create(array $subscriber): Subscriber
    {
        return Subscriber::create($subscriber);
    }

    public function updateStripeInfo(Subscriber $subscriber, Collection $stripeData)
    {

    }

    /**
     * @param Subscriber $subscriber
     * @param string $stripeCustomerId
     */
    public function addStripeIdentifierToSubscriber(Subscriber $subscriber, string $stripeCustomerId): void
    {
        $subscriber->stripe_id = $stripeCustomerId;
        $subscriber->save();
    }
}
