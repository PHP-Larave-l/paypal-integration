<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function subscribe()
    {
        return view('subscribe');
    }

    public function subscriptionSuccess(Request $request)
    {
        // Here you can handle the success logic, such as storing subscription details in the database.
        return view('subscription-success');
    }

    public function subscriptionCancel()
    {
        // Here you can handle the cancellation logic.
        return view('subscription-cancel');
    }
}
