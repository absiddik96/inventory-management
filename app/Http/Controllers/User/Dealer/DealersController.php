<?php

namespace App\Http\Controllers\User\Dealer;

use App\Traits\Dealer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealersController extends Controller
{
    use Dealer;

    public function index()
    {
        return response()->json([
            'data' => $this->dealerPaymentDue()
        ]);
    }
}
