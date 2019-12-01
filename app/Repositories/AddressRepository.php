<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Subscriber;
use Illuminate\Support\Collection;

class AddressRepository
{
    /**
     * @param array $address
     * @param Subscriber $subscriber
     * @return Address
     */
    public function create(array $address, Subscriber $subscriber): Address
    {
        $address += ['subscriber_id' => $subscriber->id];
        $address = Address::create($address);

//        $address->subscriber_id = $subscriber->id;
//        $address->save();

        return $address;
    }
}
