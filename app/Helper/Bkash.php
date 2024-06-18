<?php
namespace App\Helper;

use App\Models\Invoice;

class Bkash
{
   
    public static function PaymentSuccess($tran_id)
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => 'Success']);
        return response()->json(['message' => 'Payment status updated successfully.']);
       
    }

    public static function PaymentCancel($tran_id)
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => 'Cancel']);
       
        return response('Payment cancel', 500);
    }

    public static function PaymentFail($tran_id)
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => 'Fail']);
       
        return response('Payment Fail', 404);
    }

    public static function PaymentIPN($tran_id, $status, $val_id)
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => $status, 'val_id' => $val_id]);
       
        return response('Payment IPN', 200);}
}
