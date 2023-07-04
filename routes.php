<?php

use App\controllers\MeterController;
// Here we can add multiple endpoints
return [
    'POST' => [
        'rate' => [
            'controller' => MeterController::class,
            'action' => 'CalculateBill'
        ]
    ]
];
