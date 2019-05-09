<?php

namespace App\Http\Controllers\User\DailyRecord;

use App\Models\DailyRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DailyRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.daily_records.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'transaction_type' => 'required',
            'note' => 'required|min:2',
            'amount' => 'required|numeric',
        ]);

        $request['purpose'] = $request->note;
        $request['user_id'] = auth()->user()->id;

        DailyRecord::create($request->all());
    }

    public function creditData()
    {
        return response()->json([
            'data' => DailyRecord::where('transaction_type', 1)->whereDate('created_at', Carbon::today())->get()
        ]);
    }

    public function debitData()
    {
        return response()->json([
            'data' => DailyRecord::where('transaction_type', 0)->whereDate('created_at', Carbon::today())->get()
        ]);
    }

    public function previousAmount()
    {
        $SQL = 'SELECT IFNULL((table_credit.credit - table_debit.debit), 0) AS previous_amount

                FROM `daily_records`
                JOIN (SELECT IFNULL(SUM(amount), 0) AS credit FROM `daily_records` WHERE transaction_type = 1 AND created_at < CURDATE()) as table_credit
                JOIN (SELECT IFNULL(SUM(amount), 0) AS debit FROM `daily_records` WHERE transaction_type = 0 AND created_at < CURDATE()) AS table_debit
                
                GROUP BY previous_amount';

        return response()->json([
            'data' => collect(DB::select($SQL))[0]->previous_amount
        ]);
    }
}
