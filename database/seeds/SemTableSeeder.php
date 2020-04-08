<?php

use App\Sem;
use League\Csv\Reader;
use App\Imports\SemImport;
use Illuminate\Database\Seeder;

class SemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new SemImport, 'database/seeds/SEM.csv');
        // $csv = Reader::createFromPath('database/seeds/SEM(1).csv', 'r');     
        // // indicamos que el delimitador es el punto y coma
        // $csv->setDelimiter(';');     
        // // Indicamos el índice de la fila de nombres de columnas
        // $csv->setHeaderOffset(0);     
        // $records = $csv->getRecords();

        // foreach ($records as $r) {
        //     dd($r);
        //     $registro = new Sem();
        //     $registro->food = $r['food'];
        //     $registro->food_group_id = $r['food_group_id'];	
        //     $registro->quantity = $r['quantity'];	
        //     $registro->unity = $r['unity'];	
        //     $registro->gross_weight = $r['gross_weight'];	
        //     $registro->net_weight = $r['net_weight'];	
        //     $registro->energy = $r['energy'];	
        //     $registro->proteins = $r['proteins'];	
        //     $registro->lipids = $r['lipids'];	
        //     $registro->carbohydrates = $r['carbohydrates'];	
        //     $registro->fiber = $r['fiber'];	
        //     $registro->vitamin_A = $r['vitamin_A'];	
        //     $registro->ascorbic_acid = $r['ascorbic_acid'];	
        //     $registro->folic_acid = $r['folic_acid'];	
        //     $registro->airon_NO = $r['airon_NO'];	
        //     $registro->potassium = $r['potassium'];	
        //     $registro->glycemic_iex = $r['glycemic_iex'];	
        //     $registro->glycemic_charge = $r['glycemic_charge'];	
        //     $registro->sugar_equivalent = $r['sugar_equivalent'];
        //     $registro->save();
        // } 
    }
}
