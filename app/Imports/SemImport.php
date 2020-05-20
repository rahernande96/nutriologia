<?php

namespace App\Imports;

use App\Sem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SemImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();
        
        foreach ($rows as $r) {
            $registro = new Sem();
            $registro->food = $r[0];
            $registro->food_group_id = $r[1];	
            $registro->quantity = $r[2];	
            $registro->unity = $r[3];	
            $registro->gross_weight = $r[4];	
            $registro->net_weight = $r[5];	
            $registro->energy = $r[6];	
            $registro->proteins = $r[7];	
            $registro->lipids = $r[8];	
            $registro->carbohydrates = $r[9];	
            $registro->fiber = $r[10];	
            $registro->vitamin_A = $r[11];	
            $registro->ascorbic_acid = $r[12];	
            $registro->folic_acid = $r[13];	
            $registro->airon_NO = $r[14];	
            $registro->potassium = $r[15];	
            $registro->glycemic_iex = $r[16];	
            $registro->glycemic_charge = $r[17];	
            $registro->sugar_equivalent = $r[18];
            $registro->save();
        } 
    }
}
