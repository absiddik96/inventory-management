<?php 

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Dealer {
    
    function dealerPaymentDue()
    {
        $SQL = 'SELECT dealers.id,dealers.name,
        COALESCE(SUM(sell_products.grand_total),0) as total_amount, 
        (COALESCE(table_amount_pay_due.total_amount_pay,0) + COALESCE(table_tran_amount_pay.total_amount_pay,0)) as total_amount_pay, 
        (COALESCE(SUM(sell_products.grand_total),0) - (COALESCE(table_amount_pay_due.total_amount_pay,0) + COALESCE(table_tran_amount_pay.total_amount_pay,0))) as total_amount_due
        FROM `sell_products`
        LEFT JOIN (SELECT dealer_id, SUM(amount_pay) as total_amount_pay, SUM(amount_due) as total_amount_due FROM sell_products WHERE payment_type = 0 GROUP BY dealer_id) as table_amount_pay_due
        ON table_amount_pay_due.dealer_id = sell_products.dealer_id
        LEFT JOIN (SELECT transactionable_id as dealer_id, SUM(amount) as total_amount_pay FROM `bank_transactions` WHERE transactionable_type = "App\\\Models\\\Dealer" GROUP BY transactionable_id) as table_tran_amount_pay
        ON table_tran_amount_pay.dealer_id = sell_products.dealer_id
        RIGHT JOIN dealers 
        ON dealers.id = sell_products.dealer_id
        GROUP BY dealers.id
        ORDER BY dealers.name';
        return collect(DB::select($SQL));
    }

    function dealerPreviousDue($dealer_id)
    {
        $SQL = 'SELECT dealers.id,dealers.name,
        COALESCE(SUM(sell_products.grand_total),0) as total_amount, 
        (COALESCE(table_amount_pay_due.total_amount_pay,0) + COALESCE(table_tran_amount_pay.total_amount_pay,0)) as total_amount_pay, 
        (COALESCE(SUM(sell_products.grand_total),0) - (COALESCE(table_amount_pay_due.total_amount_pay,0) + COALESCE(table_tran_amount_pay.total_amount_pay,0))) as total_amount_due
        FROM `sell_products`
        LEFT JOIN (SELECT dealer_id, SUM(amount_pay) as total_amount_pay, SUM(amount_due) as total_amount_due FROM sell_products WHERE payment_type = 0 GROUP BY dealer_id) as table_amount_pay_due
        ON table_amount_pay_due.dealer_id = sell_products.dealer_id
        LEFT JOIN (SELECT transactionable_id as dealer_id, SUM(amount) as total_amount_pay FROM `bank_transactions` WHERE transactionable_type = "App\\\Models\\\Dealer" GROUP BY transactionable_id) as table_tran_amount_pay
        ON table_tran_amount_pay.dealer_id = sell_products.dealer_id
        RIGHT JOIN dealers 
        ON dealers.id = sell_products.dealer_id
        WHERE dealers.id = '.$dealer_id.'
        GROUP BY dealers.id
        ORDER BY dealers.name';
        return collect(DB::select($SQL));
    }
}