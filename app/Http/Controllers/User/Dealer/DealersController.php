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

    public function getDealerPreviousDueByDate($dealer_id,$date)
    {
        return response()->json([
            'data' => $this->dealerPreviousDueByDate($dealer_id,$date)[0]
        ]);
    }
}
