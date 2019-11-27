<?php

namespace App\Services\Subscribe;

use App\Repositories\AddressRepository;
use App\Repositories\SubscriberRepository;
use App\Services\Stripe\CustomerService;
use App\Services\Stripe\PaymentService;
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

    /**
     * @var CustomerService
     */
    private $stripeCustomerService;

    /**
     * @var PaymentService
     */
    private $stripePaymentService;

    /**
     * ToListService constructor.
     * @param SubscriberRepository $subscriberRepository
     * @param AddressRepository $addressRepository
     * @param CustomerService $customerService
     * @param PaymentService $paymentService
     */
    public function __construct(
        SubscriberRepository $subscriberRepository,
        AddressRepository $addressRepository,
        CustomerService $customerService,
        PaymentService $paymentService
    ) {
        $this->subscriberRepository = $subscriberRepository;
        $this->addressRepository = $addressRepository;
        $this->stripeCustomerService = $customerService;
        $this->stripePaymentService = $paymentService;
    }

    /**
     * @param Collection $attributes
     */
    public function handle(Collection $attributes)
    {
        $subscriber = $attributes->get('subscriber');
        $address = $attributes->get('address');
        $card = $attributes->get('card');

        $subscriber = $this->subscriberRepository->create($subscriber);
        $this->addressRepository->create($address, $subscriber);

//        $this->stripeCustomerService->createCustomer($subscriber);
//        $this->stripePaymentService->createNewPaymentMethod($card, $subscriber);
    }
}
