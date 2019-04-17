<?php

namespace App\Http\Controllers\Admin\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;

class AccountBankController extends Controller
{
    public function accounts($bank_id)
    {
        if(request()->expectsJson()){
            return response()->json([
                'data' => BankAccount::where('bank_id',$bank_id)->get(),
            ]);
        }
    }
}
