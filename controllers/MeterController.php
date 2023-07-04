<?php

namespace App\controllers;
use App\services\ApiService;
include_once "./services/ApiService.php" ;
class MeterController
{
    public function CalculateBill()
    {
        // Parse the request data
        $requestData = json_decode(file_get_contents('php://input'), true);
        $cdr = $requestData['cdr'];
        $rate = $requestData['rate'];
        $meterService = new ApiService();
        $ovarallCharges = $meterService->consumptionCalculation($cdr,$rate);

        // Return a response
        echo $ovarallCharges;
    }
}
