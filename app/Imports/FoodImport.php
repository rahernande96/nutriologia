<?php

namespace App\Imports;

use App\Food;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FoodImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $elements = [];

        foreach ($collection as $key => $value) {
            
            $elements[$key] = [
                'name' => $value[0],
                'group_id' => $value[1],
                'energy'    => $value[6],
                'protein'   => $value[7],
                'lipids'    => $value[8],
                'carbohydrates' => $value[9],
                'fiber' => $value[10]

            ];
        }

        Food::insert($elements);
    }
}
