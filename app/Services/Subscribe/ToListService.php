<?php

namespace App\Services\Subscribe;

use App\Repositories\AddressRepository;
use App\Repositories\SubscriberRepository;
use Illuminate\Support\Collection;

class ToListService
{
    /**
     * @var SubscriberRepository
     */
    private $subscriberRepository;

    /**
     * @var AddressRepository
     */
    private $addressRepository;

    public function __construct(
        SubscriberRepository $subscriberRepository,
        AddressRepository $addressRepository
    ) {
        $this->subscriberRepository = $subscriberRepository;
        $this->addressRepository = $addressRepository;
    }
    public function handle(Collection $attributes)
    {
        // create subscriber
        $subscriber = $this->subscriberRepository->create($attributes);
        // create subscriber's shipping address
        $this->addressRepository->create($attributes, $subscriber);
        // create Stripe customer details
        $subscriber->createAsStripeCustomer();
            // In doing so, this should confirm permission for SCA2
    }
}
