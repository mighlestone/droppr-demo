<?php

namespace App\Repositories;

use App\Subscriber;
use Illuminate\Support\Collection;

class SubscriberRepository
{
    /**
     * @param Collection $attributes
     * @return Subscriber
     */
    public function create(Collection $attributes): Subscriber
    {

    }

    public function updateStripeInfo(Subscriber $subscriber, Collection $stripeData)
    {

    }
}
