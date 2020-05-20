<?php

use App\GctDurninCol;
use League\Csv\Reader;
use Illuminate\Database\Seeder;

class GctDurminColTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csv = Reader::createFromPath('database/seeds/GCT_4 pliegues_Durnin_y_colaboradores.csv', 'r');     
        // indicamos que el delimitador es el punto y coma
        $csv->setDelimiter(';');     
        // Indicamos el índice de la fila de nombres de columnas
        $csv->setHeaderOffset(0);     
        $records = $csv->getRecords();
        
        foreach ($records as $r) {
            $registro = new GctDurninCol();
            $registro->gender = $r['gender'];
            $registro->sum_folds = $r['sum_folds'];         
            $registro->age_17_29 = $r['age_17_29'];
            $registro->age_30_39 = $r['age_30_39'];         
            $registro->age_40_49 = $r['age_40_49'];
            $registro->age_more_50 = $r['age_more_50'];
            $registro->save();
          }  	
        
    }
}
