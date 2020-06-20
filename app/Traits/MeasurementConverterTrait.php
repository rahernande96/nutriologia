<?php
namespace App\Traits;

trait MeasurementConverterTrait {

    public function cmToMeters($measure){

        return $measure/100;

    }

    public function metersToCm($measure){

        return $measure*100;

    }

    public function mmToCm($measure){
        return $measure/10;
    }

}