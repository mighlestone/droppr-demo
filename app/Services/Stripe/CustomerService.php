<?php

namespace App\Services\Stripe;

use App\Repositories\SubscriberRepository;
use App\Models\Subscriber;
use Stripe\Customer;

class CustomerService extends Foundation
{
    /**
     * @var SubscriberRepository
     */
    private $subscriberRepository;

    /**
     * CustomerService constructor.
     * @param SubscriberRepository $subscriberRepository
     */
    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    /**
     * @param Subscriber $subscriber
     * @return Customer
     */
    public function createCustomer(Subscriber $subscriber)
    {
        $data = ['email' => $subscriber->email];
        $customer = Customer::create($data, static::stripeOptions());

        $this->subscriberRepository->addStripeIdentifierToSubscriber($subscriber, $customer->id);

        return $customer;
    }
}
