<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Cart;

class PaymentsController extends Controller {
    
    public function showPaymentPage() {
        $payment_info = Session::get('payment_info');
        
        //has not paid
        if($payment_info && $payment_info['status'] == 'on_hold'){
            return view("payment.paymentpage",['payment_info'=>$payment_info]);
        } else {
            return redirect()->route('allProducts');
        }
    }
    
    function showPaymentReceipt($paypalOrderID, $paypalPayerID) {
        
    }
}
