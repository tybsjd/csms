<?php
namespace App\services;
class ApiService
{
    public function consumptionCalculation($cdr,$rate)
    {
        // Input validations
        if (!isset($cdr['meterStart'], $cdr['timestampStart'], $cdr['meterStop'], $cdr['timestampStop'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Meter Reading : Missing required fields']);
            exit;
        }
        else if($cdr['meterStop'] < $cdr['meterStart'] ){
            http_response_code(400);
            echo json_encode(['error' => 'Meter Reading : Invalid readings']);
            exit;
        }
        if (!isset($rate['energy'], $rate['time'], $rate['transaction'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Electricity Rate : Missing required fields']);
            exit;
        }
        else if($rate['energy'] < 0 || $rate['time'] < 0 || $rate['transaction'] < 0 ){
            http_response_code(400);
            echo json_encode(['error' => 'Electricity Rate : Negative values are not allowed']);
            exit;
        }
        $timestampStart = date("Y-m-d H:i:s", strtotime($cdr['timestampStart']));
        $timestampStop = date("Y-m-d H:i:s", strtotime($cdr['timestampStop']));
        // validation of timestamps order
        if($timestampStop < $timestampStart ){
            http_response_code(400);
            echo json_encode(['error' => 'Meter Reading : Invalid TimeStamps']);
            exit;
        }
        // Start Calculation
        // Find consumed units and time difference
        $consumedUnits = $cdr['meterStop']  -  $cdr['meterStart'] ; 
        $busyHours = abs(strtotime($timestampStop) - strtotime($timestampStart))/3600;
        $serviceCharges = $rate['transaction'];
        // Apply rates to CDR
        $consumedUnitsCharges = $consumedUnits/1000 * $rate['energy']; 
        $consumedUnitsCharges = round($consumedUnitsCharges,3);
        $busyHoursCharges = round(($busyHours * $rate['time'] ), 3);
        // Ovarall Charges 
        $ovarallCharges = round(($consumedUnitsCharges + $busyHoursCharges + $serviceCharges), 2);
        // Return JSON result
        return json_encode(array
            ("ovarall" => $ovarallCharges,
                "components" => array(
                    "energy" => $consumedUnitsCharges,
                    "time" => $busyHoursCharges,
                    "transaction" => $serviceCharges
                )
            )
        ,JSON_NUMERIC_CHECK);
    }
}
