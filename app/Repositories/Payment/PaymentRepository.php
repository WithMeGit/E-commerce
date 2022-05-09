<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class PaymentRepository extends BaseRepository implements PaymentInterface
{
    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function getPaymentWithUserLogged()
    {
        return Payment::where('user_id', '=', Auth::user()->id)->first();
    }

    public function create($data_payment)
    {
        return Payment::create($data_payment);
    }
}