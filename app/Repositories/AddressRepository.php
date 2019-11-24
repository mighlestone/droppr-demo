<?php

namespace App\Repositories;

use App\Address;
use App\Subscriber;
use Illuminate\Support\Collection;

class AddressRepository
{
    /**
     * @param Collection $address
     * @param Subscriber $subscriber
     * @return Address
     */
    public function create(Collection $address, Subscriber $subscriber): Address
    {
        $address = Address::create($address->get('address'));

        $address->subscriber_id = $subscriber->id;
        $address->save();

        return $address;
    }
}
