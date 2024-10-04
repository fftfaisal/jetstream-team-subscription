<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function portal(Request $request)
    {
//        $stripeCustomer = $request->user()->currentTeam->createOrGetStripeCustomer(
//            ['name' => $request->user()->name, 'email' => $request->user()->email]
//        );
        return $request->user()->currentTeam->redirectToBillingPortal(
            route('dashboard')
        );
    }
}
