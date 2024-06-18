<?php

namespace App\Http\Controllers;

use Exception;
use App\Helper\Bkash;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\api\v2\BaseController;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class BkashTokenizePaymentController extends BaseController
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        
        $tran_id = uniqid();
        $user_id = '1';
         Invoice::create([
            'total' => 500,
            'vat' => 0,
            'payable' => 500,
            'cus_details' => "Demo",
            'tran_id' => $tran_id,
            'payment_status' => 'Pending',
            'user_id' => $user_id,
            'payment_method' => 'bkash'
        ]);
       
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $tran_id;
        $request['currency'] = 'BDT';
        $request['amount'] = 500;
        $request['merchantInvoiceNumber'] = $tran_id;
       // Replace with your actual value
       $callbackURL = config("bkash.callbackURL") . '?tran_id=' . $tran_id;
       $request['callbackURL'] = $callbackURL;

        $request_data_json = json_encode($request->all());

        $response = BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response); //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) {
            return redirect()->away($response['bkashURL']);
        } else {
            return redirect()->back()->with('error-alert2', $response['statusMessage']);
        }

    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response) { //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
               
                 
                 
                
                 return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        } else if ($request->status == 'cancel') {
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        } else {
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        $amount = 5;
        $reason = 'this is test reason';
        $sku = 'abc';
        //response
        return BkashRefundTokenize::refund($paymentID, $trxID, $amount, $reason, $sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID, $trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function PaymentSuccess(Request $request)
    {
        try {
            Bkash::PaymentSuccess($request->query('tran_id'));
            return BaseController::sendResponse('Payment is successful', 'Payments retrieved successfully.');

        } catch (Exception $e) {
            return BaseController::sendError('error', $e->getMessage());

        }
    }

    public function PaymentFail(Request $request)
    {
        try {
            Bkash::PaymentFail($request->query('tran_id'));
        } catch (Exception $e) {
            return BaseController::sendError('Error', $e->getMessage());

        }
    }
    public function PaymentCancel(Request $request)
    {
        try {
            Bkash::PaymentCancel($request->query('tran_id'));
            // return redirect('/Profile');
            return 1;
        } catch (Exception $e) {
            return BaseController::sendError('Error', $e->getMessage());
        }
    }

    public function PaymentIPN(Request $request)
    {
        Bkash::PaymentIPN($request->input('tran_id'), $request->input('status'), $request->input('val_id'));

    }
}
