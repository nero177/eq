<?php

namespace App\Contracts;

interface PaymentProviderInterface
{
    public function purchase(string $clientFirstName, string $clientLastName, string $clientEmail,string $clientPhone);
}