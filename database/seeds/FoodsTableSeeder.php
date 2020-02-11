<?php

use App\Food;
use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('foods')->truncate();

        Food::create([
            'name' => 'Brocoli',
            'group_id' => 1,
            'energy'    => 19,
            'protein'   => 2.1,
            'lipids'    => 0.3,
            'carbohydrates' => 3.7,
            'fiber' => 2.1
        ]);

        Food::create([
            'name' => 'Calabacitas',
            'group_id' => 1,
            'energy'    => 21,
            'protein'   => 1.6,
            'lipids'    => 0.1,
            'carbohydrates' => 3.4,
            'fiber' => 1.4
        ]);

        Food::create([
            'name' => 'Coliflor',
            'group_id' => 1,
            'energy'    => 20,
            'protein'   => 1.6,
            'lipids'    => 0.1,
            'carbohydrates' => 4.2,
            'fiber' => 2.0
        ]);

        Food::create([
            'name' => 'Champiñón',
            'group_id' => 1,
            'energy'    => 20,
            'protein'   => 2.9,
            'lipids'    => 0.3,
            'carbohydrates' => 3.1,
            'fiber' => 0.9
        ]);

        Food::create([
            'name' => 'Chayotes',
            'group_id' => 1,
            'energy'    => 19,
            'protein'   => 0.8,
            'lipids'    => 0.1,
            'carbohydrates' => 4.5,
            'fiber' => 1.7
        ]);

        Food::create([
            'name' => 'Hojas Verdes',
            'group_id' => 1,
            'energy'    => 19,
            'protein'   => 2.1,
            'lipids'    => 0.3,
            'carbohydrates' => 3.4,
            'fiber' => 0.0
        ]);

        Food::create([
            'name' => 'Nopales',
            'group_id' => 1,
            'energy'    => 22,
            'protein'   => 1.8,
            'lipids'    => 0.1,
            'carbohydrates' => 4.5,
            'fiber' => 3.2
        ]);

        Food::create([
            'name' => 'Zanahorias',
            'group_id' => 1,
            'energy'    => 21,
            'protein'   => 0.4,
            'lipids'    => 0.1,
            'carbohydrates' => 4.9,
            'fiber' => 1.7
        ]);

        Food::create([
            'name' => 'Guayabas',
            'group_id' => 4,
            'energy'    => 63,
            'protein'   => 1.0,
            'lipids'    => 0.7,
            'carbohydrates' => 14.8,
            'fiber' => 7.0
        ]);

        Food::create([
            'name' => 'Mango',
            'group_id' => 4,
            'energy'    => 57,
            'protein'   => 1.3,
            'lipids'    => 0.0,
            'carbohydrates' => 14.6,
            'fiber' => 1.8
        ]);

        Food::create([
            'name' => 'Manzana',
            'group_id' => 4,
            'energy'    => 55,
            'protein'   => 0.3,
            'lipids'    => 0.2,
            'carbohydrates' => 14.7,
            'fiber' => 2.6
        ]);

        Food::create([
            'name' => 'Papaya',
            'group_id' => 4,
            'energy'    => 45,
            'protein'   => 0.7,
            'lipids'    => 0.2,
            'carbohydrates' => 11.2,
            'fiber' => 2.1
        ]);

        Food::create([
            'name' => 'Pera',
            'group_id' => 4,
            'energy'    => 47,
            'protein'   => 0.3,
            'lipids'    => 0.1,
            'carbohydrates' => 12.5,
            'fiber' => 2.5
        ]);

        Food::create([
            'name' => 'Piña',
            'group_id' => 4,
            'energy'    => 42,
            'protein'   => 0.5,
            'lipids'    => 0.1,
            'carbohydrates' => 11.0,
            'fiber' => 1.2
        ]);

        Food::create([
            'name' => 'Sandía',
            'group_id' => 4,
            'energy'    => 48,
            'protein'   => 1.0,
            'lipids'    => 0.2,
            'carbohydrates' => 12.1,
            'fiber' => 0.6
        ]);

        Food::create([
            'name' => 'Uva',
            'group_id' => 4,
            'energy'    => 61,
            'protein'   => 0.6,
            'lipids'    => 0.5,
            'carbohydrates' => 15.3,
            'fiber' => 1.1
        ]);

        Food::create([
            'name' => 'Arroz',
            'group_id' => 6,
            'energy'    => 72,
            'protein'   => 1.3,
            'lipids'    => 0.1,
            'carbohydrates' => 15.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Cereal de caja',
            'group_id' => 6,
            'energy'    => 68,
            'protein'   => 1.9,
            'lipids'    => 1.1,
            'carbohydrates' => 12.6,
            'fiber' => 1.9
        ]);

        Food::create([
            'name' => 'Elote',
            'group_id' => 6,
            'energy'    => 70,
            'protein'   => 2.6,
            'lipids'    => 1.0,
            'carbohydrates' => 15.5,
            'fiber' => 2.2
        ]);

        Food::create([
            'name' => 'Pastas',
            'group_id' => 6,
            'energy'    => 78,
            'protein'   => 3.2,
            'lipids'    => 1.1,
            'carbohydrates' => 14.0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Palomitas Light',
            'group_id' => 6,
            'energy'    => 70,
            'protein'   => 3.5,
            'lipids'    => 0,
            'carbohydrates' => 14.0,
            'fiber' => 3.5
        ]);

        Food::create([
            'name' => 'Pan (de caja o bolillo)',
            'group_id' => 6,
            'energy'    => 71,
            'protein'   => 2.2,
            'lipids'    => 0.8,
            'carbohydrates' => 13.6,
            'fiber' => 0.5
        ]);

        Food::create([
            'name' => 'Papa',
            'group_id' => 6,
            'energy'    => 60,
            'protein'   => 1.6,
            'lipids'    => 0.1,
            'carbohydrates' => 13.5,
            'fiber' => 1.4
        ]);

        Food::create([
            'name' => 'Tortilla',
            'group_id' => 6,
            'energy'    => 64,
            'protein'   => 1.4,
            'lipids'    => 0.5,
            'carbohydrates' => 13.6,
            'fiber' => 0.6
        ]);

        Food::create([
            'name' => 'Tostadas Horneadas',
            'group_id' => 6,
            'energy'    => 73,
            'protein'   => 2.0,
            'lipids'    => 1.3,
            'carbohydrates' => 16.0,
            'fiber' => 2.0
        ]);

        Food::create([
            'name' => 'Brownies',
            'group_id' => 7,
            'energy'    => 114,
            'protein'   => 1.4,
            'lipids'    => 4.6,
            'carbohydrates' => 17.9,
            'fiber' => 0.6
        ]);

        Food::create([
            'name' => 'Croutones sazonados',
            'group_id' => 7,
            'energy'    => 105,
            'protein'   => 2.4,
            'lipids'    => 4.1,
            'carbohydrates' => 14.3,
            'fiber' => 1.1
        ]);

        Food::create([
            'name' => 'Frituras',
            'group_id' => 7,
            'energy'    => 84,
            'protein'   => 0.8,
            'lipids'    => 5.3,
            'carbohydrates' => 8.3,
            'fiber' => 0.0
        ]);

        Food::create([
            'name' => 'Galletas',
            'group_id' => 7,
            'energy'    => 105,
            'protein'   => 1.3,
            'lipids'    => 5.3,
            'carbohydrates' => 13.8,
            'fiber' => 0.7
        ]);

        Food::create([
            'name' => 'Bollería',
            'group_id' => 7,
            'energy'    => 112,
            'protein'   => 2.9,
            'lipids'    => 3.4,
            'carbohydrates' => 18.0,
            'fiber' => 0.0
        ]);

        Food::create([
            'name' => 'Palomitas de mantquilla',
            'group_id' => 7,
            'energy'    => 110,
            'protein'   => 2.0,
            'lipids'    => 7.0,
            'carbohydrates' => 10.8,
            'fiber' => 2.1
        ]);

        Food::create([
            'name' => 'Papas a la Francesa',
            'group_id' => 7,
            'energy'    => 100,
            'protein'   => 1.1,
            'lipids'    => 6.9,
            'carbohydrates' => 9.2,
            'fiber' => 0.6
        ]);

        Food::create([
            'name' => 'Tortilla de Harina',
            'group_id' => 7,
            'energy'    => 80,
            'protein'   => 1.9,
            'lipids'    => 1.9,
            'carbohydrates' => 13.4,
            'fiber' => 0.1
        ]);

        Food::create([
            'name' => 'Tostadas',
            'group_id' => 7,
            'energy'    => 93,
            'protein'   => 1.2,
            'lipids'    => 4.9,
            'carbohydrates' => 11.2,
            'fiber' => 1.2
        ]);

        Food::create([
            'name' => 'Frijoles',
            'group_id' => 5,
            'energy'    => 105,
            'protein'   => 9.6,
            'lipids'    => 1.1,
            'carbohydrates' => 20.4,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Garbanzos',
            'group_id' => 5,
            'energy'    => 127,
            'protein'   => 6.8,
            'lipids'    => 2.2,
            'carbohydrates' => 21.2,
            'fiber' => 6.1
        ]);

        Food::create([
            'name' => 'Lentejas',
            'group_id' => 5,
            'energy'    => 124,
            'protein'   => 9.0,
            'lipids'    => 0.4,
            'carbohydrates' => 21,
            'fiber' => 10.7
        ]);

        Food::create([
            'name' => 'Soya',
            'group_id' => 5,
            'energy'    => 98,
            'protein'   => 9.4,
            'lipids'    => 5.1,
            'carbohydrates' => 5.6,
            'fiber' => 3.4
        ]);

        Food::create([
            'name' => 'Atún',
            'group_id' => 10,
            'energy'    => 43,
            'protein'   => 7.0,
            'lipids'    => 1.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Bistec',
            'group_id' => 10,
            'energy'    => 36,
            'protein'   => 7.2,
            'lipids'    => 0.8,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Chuleta Ahumada',
            'group_id' => 10,
            'energy'    => 34,
            'protein'   => 6.1,
            'lipids'    => 1.0,
            'carbohydrates' => 0.1,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Clara de huevo',
            'group_id' => 10,
            'energy'    => 32,
            'protein'   => 7.2,
            'lipids'    => 0.1,
            'carbohydrates' => 0.5,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Falda de res',
            'group_id' => 10,
            'energy'    => 35,
            'protein'   => 7.4,
            'lipids'    => 0.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Filete de pescado',
            'group_id' => 10,
            'energy'    => 36,
            'protein'   => 7.5,
            'lipids'    => 0.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Pechuga de pollo sin piel',
            'group_id' => 10,
            'energy'    => 39,
            'protein'   => 7.9,
            'lipids'    => 0.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Pescado',
            'group_id' => 10,
            'energy'    => 35,
            'protein'   => 7.3,
            'lipids'    => 0.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Salmón',
            'group_id' => 10,
            'energy'    => 41,
            'protein'   => 6.4,
            'lipids'    => 1.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Arrachera de Res',
            'group_id' => 9,
            'energy'    => 36,
            'protein'   => 7.5,
            'lipids'    => 0.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Gallina',
            'group_id' => 9,
            'energy'    => 59,
            'protein'   => 7.6,
            'lipids'    => 0,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Higado de aves',
            'group_id' => 9,
            'energy'    => 50,
            'protein'   => 7.3,
            'lipids'    => 2.0,
            'carbohydrates' => 0.3,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Jamon de pavo',
            'group_id' => 9,
            'energy'    => 54,
            'protein'   => 8.0,
            'lipids'    => 2.1,
            'carbohydrates' => 0.1,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Lomo de cerdo',
            'group_id' => 9,
            'energy'    => 56,
            'protein'   => 7.9,
            'lipids'    => 2.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);


        Food::create([
            'name' => 'Milanesa de cerdo',
            'group_id' => 9,
            'energy'    => 56,
            'protein'   => 7.9,
            'lipids'    => 2.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Molida de res',
            'group_id' => 9,
            'energy'    => 54,
            'protein'   => 6.2,
            'lipids'    => 3.0,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Pierna de pollo sin piel',
            'group_id' => 9,
            'energy'    => 52,
            'protein'   => 8.7,
            'lipids'    => 1.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso',
            'group_id' => 9,
            'energy'    => 58,
            'protein'   => 6.1,
            'lipids'    => 2.8,
            'carbohydrates' => 2.0,
            'fiber' => 0
        ]);
Food::create([
            'name' => 'Bola de res',
            'group_id' => 16,
            'energy'    => 71,
            'protein'   => 7.2,
            'lipids'    => 4.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Carne deshebrada',
            'group_id' => 16,
            'energy'    => 75,
            'protein'   => 7.4,
            'lipids'    => 4.8,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Chicharron',
            'group_id' => 16,
            'energy'    => 72,
            'protein'   => 6.9,
            'lipids'    => 4.7,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Costilla de cerdo',
            'group_id' => 16,
            'energy'    => 69,
            'protein'   => 6.5,
            'lipids'    => 4.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Huevo',
            'group_id' => 16,
            'energy'    => 63,
            'protein'   => 5.5,
            'lipids'    => 4.4,
            'carbohydrates' => 0.3,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Pierna de pollo con piel',
            'group_id' => 16,
            'energy'    => 74,
            'protein'   => 7.2,
            'lipids'    => 4.8,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso blanco',
            'group_id' => 16,
            'energy'    => 77,
            'protein'   => 6.0,
            'lipids'    => 5.1,
            'carbohydrates' => 1.8,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso parmesano',
            'group_id' => 16,
            'energy'    => 78,
            'protein'   => 7.2,
            'lipids'    => 5.2,
            'carbohydrates' => 0.6,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Salchicha de pavo',
            'group_id' => 16,
            'energy'    => 120,
            'protein'   => 14.6,
            'lipids'    => 6.4,
            'carbohydrates' => 1.0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Carne molida regular',
            'group_id' => 12,
            'energy'    => 107,
            'protein'   => 7.2,
            'lipids'    => 8.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Costilla de res',
            'group_id' => 12,
            'energy'    => 112,
            'protein'   => 4.5,
            'lipids'    => 10.3,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Jamon Ahumado',
            'group_id' => 12,
            'energy'    => 95,
            'protein'   => 4.9,
            'lipids'    => 8.2,
            'carbohydrates' => 0.2,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso amarillo',
            'group_id' => 12,
            'energy'    => 100,
            'protein'   => 7.0,
            'lipids'    => 5.9,
            'carbohydrates' => 4.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso crema light',
            'group_id' => 12,
            'energy'    => 104,
            'protein'   => 4.8,
            'lipids'    => 7.9,
            'carbohydrates' => 3.2,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso mozzarella',
            'group_id' => 12,
            'energy'    => 105,
            'protein'   => 7.8,
            'lipids'    => 7.8,
            'carbohydrates' => 0.8,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Queso oaxaca',
            'group_id' => 12,
            'energy'    => 95,
            'protein'   => 7.7,
            'lipids'    => 6.6,
            'carbohydrates' => 0.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Salchicha',
            'group_id' => 12,
            'energy'    => 114,
            'protein'   => 6.6,
            'lipids'    => 9.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Tripa de res',
            'group_id' => 12,
            'energy'    => 109,
            'protein'   => 5.6,
            'lipids'    => 9.5,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Leche descremada',
            'group_id' => 13,
            'energy'    => 86,
            'protein'   => 8.4,
            'lipids'    => 0.4,
            'carbohydrates' => 11.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Leche light',
            'group_id' => 13,
            'energy'    => 96,
            'protein'   => 7.5,
            'lipids'    => 2.4,
            'carbohydrates' => 11.1,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Yoghur bajo en grasa',
            'group_id' => 13,
            'energy'    => 83,
            'protein'   => 2.7,
            'lipids'    => 0.8,
            'carbohydrates' => 16.0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Leche Semidescremada',
            'group_id' => 14,
            'energy'    => 116,
            'protein'   => 7.7,
            'lipids'    => 4.4,
            'carbohydrates' => 11.2,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Leche Entera',
            'group_id' => 15,
            'energy'    => 148,
            'protein'   => 7.9,
            'lipids'    => 8.0,
            'carbohydrates' => 11.2,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Yoghur',
            'group_id' => 15,
            'energy'    => 139,
            'protein'   => 7.9,
            'lipids'    => 7.4,
            'carbohydrates' => 10.6,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Yoghur natural',
            'group_id' => 15,
            'energy'    => 139,
            'protein'   => 7.9,
            'lipids'    => 7.4,
            'carbohydrates' => 10.6,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Helado',
            'group_id' => 17,
            'energy'    => 214,
            'protein'   => 3.8,
            'lipids'    => 10.9,
            'carbohydrates' => 27.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Aceite vegetal',
            'group_id' => 18,
            'energy'    => 44,
            'protein'   => 0,
            'lipids'    => 5.0,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Aceiunas',
            'group_id' => 18,
            'energy'    => 46,
            'protein'   => 0.3,
            'lipids'    => 5.1,
            'carbohydrates' => 0.8,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Aderezos',
            'group_id' => 18,
            'energy'    => 48,
            'protein'   => 0,
            'lipids'    => 4.5,
            'carbohydrates' => 2.1,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Aguacate',
            'group_id' => 18,
            'energy'    => 46,
            'protein'   => 0.5,
            'lipids'    => 4.6,
            'carbohydrates' => 1.5,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Crema ácida',
            'group_id' => 18,
            'energy'    => 46,
            'protein'   => 0.7,
            'lipids'    => 4.4,
            'carbohydrates' => 0.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Mayonesa',
            'group_id' => 18,
            'energy'    => 34,
            'protein'   => 0.1,
            'lipids'    => 3.6,
            'carbohydrates' => 0.2,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Tocino',
            'group_id' => 18,
            'energy'    => 44,
            'protein'   => 0.7,
            'lipids'    => 4.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Ajonjolí',
            'group_id' => 19,
            'energy'    => 61,
            'protein'   => 2.7,
            'lipids'    => 5.7,
            'carbohydrates' => 1.0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Almendra',
            'group_id' => 19,
            'energy'    => 66,
            'protein'   => 2.7,
            'lipids'    => 6.6,
            'carbohydrates' => 0.5,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Cacahuate',
            'group_id' => 19,
            'energy'    => 73,
            'protein'   => 2.9,
            'lipids'    => 6.2,
            'carbohydrates' => 2.7,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Chía',
            'group_id' => 19,
            'energy'    => 69,
            'protein'   => 3.5,
            'lipids'    => 5.9,
            'carbohydrates' => 1.9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Chorizo',
            'group_id' => 19,
            'energy'    => 64,
            'protein'   => 3.5,
            'lipids'    => 5.6,
            'carbohydrates' => 0,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Nueces',
            'group_id' => 19,
            'energy'    => 67,
            'protein'   => 0.9,
            'lipids'    => 7.0,
            'carbohydrates' => 1.3,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Ate',
            'group_id' => 20,
            'energy'    => 41,
            'protein'   => 0.4,
            'lipids'    => 0.1,
            'carbohydrates' => 9.8,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Azucar de mesa',
            'group_id' => 20,
            'energy'    => 33,
            'protein'   => 0,
            'lipids'    => 0,
            'carbohydrates' => 8.4,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Gelatina de agua',
            'group_id' => 20,
            'energy'    => 38,
            'protein'   => 0.8,
            'lipids'    => 0.0,
            'carbohydrates' => 9.1,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Mermelada',
            'group_id' => 20,
            'energy'    => 41,
            'protein'   => 0.1,
            'lipids'    => 0,
            'carbohydrates' => 10,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Refresco',
            'group_id' => 20,
            'energy'    => 38,
            'protein'   => 0,
            'lipids'    => 0,
            'carbohydrates' => 9.7,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'kinder delice',
            'group_id' => 21,
            'energy'    => 95,
            'protein'   => 5.9,
            'lipids'    => 5.9,
            'carbohydrates' => 9,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Mazapan',
            'group_id' => 21,
            'energy'    => 85,
            'protein'   => 3.8,
            'lipids'    => 3.8,
            'carbohydrates' => 11.3,
            'fiber' => 0
        ]);

        Food::create([
            'name' => 'Mole',
            'group_id' => 21,
            'energy'    => 79,
            'protein'   => 1.7,
            'lipids'    => 5.3,
            'carbohydrates' => 6.2,
            'fiber' => 0
        ]);


    }
}
