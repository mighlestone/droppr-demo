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
        $subscriber = $this->getSubscriberFromAttributes($attributes);
        $address = $this->getAddressFromAttributes($attributes);
        $card = $this->getCardFromAttributes($attributes);

        $subscriber = $this->subscriberRepository->create($subscriber);
        $this->addressRepository->create($address, $subscriber);

        $this->stripeCustomerService->createCustomer($subscriber);
        $this->stripePaymentService->createNewPaymentMethod($card, $subscriber);
    }

    /**
     * @param Collection $attributes
     * @return Collection
     */
    protected function getSubscriberFromAttributes(Collection $attributes): Collection
    {
        return $attributes->only([
            'first_name',
            'last_name',
            'email',
            'phone_number'
        ]);
    }

    /**
     * @param Collection $attributes
     * @return Collection
     */
    protected function getAddressFromAttributes(Collection $attributes): Collection
    {
        return $attributes->only([
            'shipping_address_line_1',
            'shipping_address_line_2',
            'shipping_address_line_3',
            'shipping_address_county',
            'shipping_address_postcode'
        ]);
    }

    /**
     * @param Collection $attributes
     * @return Collection
     */
    protected function getCardFromAttributes(Collection $attributes): Collection
    {
        return $attributes->only([
            'card_number',
            'card_expiry_month',
            'card_expiry_year',
            'card_cvc'
        ]);
    }
}
