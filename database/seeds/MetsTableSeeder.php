<?php
use App\Met;
use League\Csv\Reader;
use Illuminate\Database\Seeder;

class MetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath('database/seeds/mets.csv', 'r');     
        // indicamos que el delimitador es el punto y coma
        $csv->setDelimiter(';');     
        // Indicamos el índice de la fila de nombres de columnas
        $csv->setHeaderOffset(0);     
        $records = $csv->getRecords();
            
        foreach ($records as $r) {
            $registro = new Met();
            $registro->actividad = $r['actividad'];
            $registro->categoria = $r['categoria'];         
            $registro->met = $r['met'];
            $registro->save();
        }  	
    }
}
