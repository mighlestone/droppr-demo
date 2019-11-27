<?php

namespace App\Repositories;

use App\Models\Subscriber;
use Illuminate\Support\Collection;

class SubscriberRepository
{
    /**
     * @param Collection $subscriber
     * @return Subscriber
     */
    public function create(Collection $subscriber): Subscriber
    {
        return Subscriber::create($subscriber->get('subscriber'));
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
