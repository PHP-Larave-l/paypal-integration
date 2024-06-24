<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function showSubscriptionForm()
    {
        return view('subscribe');
    }

    public function createSubscription(Request $request)
    {
        $planId = $request->input('plan');
        $planName = $request->input('plan_name');
        $price = $request->input('price');
        return view('create-subscription', compact('planId', 'planName', 'price'));
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
