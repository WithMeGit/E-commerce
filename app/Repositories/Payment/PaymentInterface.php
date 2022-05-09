<?php

namespace App\Repositories\Payment;

use App\Repositories\RepositoryInterface;

interface PaymentInterface extends RepositoryInterface
{
    public function getPaymentWithUserLogged();

    public function create($data_payment);
}