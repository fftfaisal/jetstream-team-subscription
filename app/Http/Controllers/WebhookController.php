<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Support\Facades\DB;

class WebhookController extends CashierController
{
    public function handleCheckoutSessionCompleted(array $payload)
    {
        $data = $payload['data']['object'];
        $team = Team::findOrFail($data['client_reference_id']);

        DB::transaction(function () use ($data, $team) {
            $team->update(['stripe_id' => $data['customer']]);

            $team->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => $data['subscription'],
                'stripe_status' => 'active'
            ]);
        });

        return $this->successMethod();
    }
}
