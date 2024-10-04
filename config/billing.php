<?php

return [
    'plans' => [
        [
            'name' => 'Basic',
            'short_description' => 'This a basic plan with some limited features.',
            'monthly_id' => env('STRIPE_BASIC_MONTHLY_PLAN', ''),
            'yearly_id' => env('STRIPE_BASIC_YEARLY_PLAN', ''),
            'yearly_incentive' => 'Save 10%',
            'features' => [
                'Feature 1',
                'Feature 2',
                'Feature 3',
            ],
        ],
        [
            'name' => 'Gold',
            'short_description' => 'Everything from basic also some extended features.',
            'monthly_id' => env('STRIPE_GOLD_MONTHLY_PLAN', ''),
            'yearly_id' => env('STRIPE_GOLD_YEARLY_PLAN', ''),
            'yearly_incentive' => 'Save 15%',
            'features' => [
                'Feature 1',
                'Feature 2',
                'Feature 3',
                'Feature 4',
                'Feature 5',
            ],
        ],
        [
            'name' => 'Premium',
            'short_description' => 'This is most valuable plan that you need.',
            'monthly_id' => env('STRIPE_PREMIUM_MONTHLY_PLAN', ''),
            'yearly_id' => env('STRIPE_PREMIUM_YEARLY_PLAN', ''),
            'yearly_incentive' => 'Save 25%',
            'features' => [
                'Feature 1',
                'Feature 2',
                'Feature 3',
                'Feature 4',
                'Feature 5',
                'Feature 6',
                'Feature 7',
                'Feature 8',
                'Feature 9',
                'Feature 10',
            ],
        ],
    ],
];
