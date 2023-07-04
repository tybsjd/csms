<?php

class BillCalculationTest extends \PHPUnit\Framework\TestCase
{
public function testMeter()
   {
        $input = json_decode('{
            "rate": {
                "energy": 0.3,
                "time": 2,
                "transaction": 1
            },
            "cdr": {
                "meterStart": 1204307,
                "timestampStart": "2021-04-05T10:04:00Z",
                "meterStop": 1215230,
                "timestampStop": "2021-04-05T11:27:00Z"
            }
        }');
        // Expected Results
        $exp_ovarall = 7.04;
        $exp_energy = 3.277;
        $exp_time =  2.767;
        $exp_transaction =  1;

        // Find units and time difference
        $timestampStart = date("Y-m-d H:i:s", strtotime($input->cdr->timestampStart));
        $timestampStop = date("Y-m-d H:i:s", strtotime($input->cdr->timestampStop));
        $consumedUnits = $input->cdr->meterStop  -  $input->cdr->meterStart  ; 
        $busyHours = abs(strtotime($timestampStop) - strtotime($timestampStart))/3600;
        $serviceCharges = $input->rate->transaction;
        // Apply rates to CDR
        $consumedUnitsCharges = number_format(($consumedUnits/1000 * $input->rate->energy), 3, '.', ''); 
        $busyHoursCharges = number_format(($busyHours * $input->rate->time ), 3, '.', '');
        $totalCharges = number_format(($consumedUnitsCharges + $busyHoursCharges + $serviceCharges), 2, '.', '');
        // Return JSON result
        $output = json_encode(array
            ("ovarall" => $totalCharges,
                "components" => array(
                    "energy" => $consumedUnitsCharges,
                    "time" => $busyHoursCharges,
                    "transaction" => $serviceCharges
                )
            )
        );
        //assertions for expected values
        $this->assertEquals($totalCharges,$exp_ovarall);
        $this->assertEquals($consumedUnitsCharges,$exp_energy);
        $this->assertEquals($busyHoursCharges,$exp_time);
        $this->assertEquals($serviceCharges,$exp_transaction);
   }
}