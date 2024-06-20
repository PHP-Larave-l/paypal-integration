<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function pay()
    {
        return view('pay');
    }

    public function success(Request $request)
    {
        // Handle the payment success
        return "Payment successful!";
    }

    public function cancel()
    {
        // Handle the payment cancellation
        return "Payment canceled!";
    }
}
