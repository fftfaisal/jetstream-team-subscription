<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index() {
        return view('billing');
    }

    public function subscribe(Request $request) {

        $subscription = $request->user()->currentTeam->newSubscription('main', $request->plan)->trialDays(5)->checkout([
            'success_url' => route('dashboard'),
            'cancel_url' => route('pricing'),
        ]);

        return new JsonResponse([
            'status' => true,
            'url' => $subscription->toArray()['url'],
            'message' => 'Subscription created successfully.'
        ]);
    }
}
