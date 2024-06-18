<?php

namespace App\Http\Controllers\api\v2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends BaseController
{

    public function index(){
        $paymentList = DB::table('invoices')
        ->leftJoin('users', 'users.id', '=', 'invoices.user_id')
        ->where('invoices.payment_status', 'Success') // Specify the table for clarity
        ->select(
            'invoices.id',                       // Invoice ID
            'invoices.tran_id as transaction_id', // Transaction ID with alias
            'invoices.payment_status',            // Payment status
            'invoices.total as amount',           // Total amount with alias
            'invoices.payment_method',  
            'users.id as user_id',
                      // Payment method
            // Invoice status
                          DB::raw('CONCAT(users.fname, " ", users.lname) as name'), // Concatenated full name with middle name if exists
                          'invoices.created_at'                // Invoice creation timestamp
        )
        ->get();
            return $this->sendResponse($paymentList, 'Payment List');
        
    }
}
