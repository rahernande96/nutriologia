<?php

use App\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::insert([
        	[
        		'title'=>'Mercado Pago',
        		'image'=>'images/mercado-pago.png',
                'instructions'=>'<ul>
                   <li> Ve a tu cuenta de Mercado Pago desde <a href="https://www.mercadopago.com/" target="_blank">Aquí</a></li><br>
                    <li>Dirigete hasta la sección <a href="https://www.mercadopago.com.mx/tools/list" target="_blank">Botón y link de pago </a></li><br>
                    <li>Selecciona el botón crear botón o link </li><br>
                    <li> Coloca titulo y el monto de la consulta</li> <br>
                    <li> Copia el código HTML que te muestra</li> <br>
                    <li>Pega el codigo en la sección Ingresar codigo en la vista anterior de ConTodoFit</li>
                    </ul>',
                'processor_link'=>'https://www.mercadopago.com/',
        	],
        	[
        		'title'=>'PayPal',
        		'image'=>'images/paypal.png',
                'instructions'=>'<ul>
                      <li> Ve a tu cuenta de Paypal desde <a href="https://www.paypal.com/" target="_blank">Aquí</a></li><br>
                      <li>Dirigete hasta la herramientas <a href="https://www.paypal.com/merchantapps/myapps" target="_blank">todas las herramientas </a></li><br>
                      <li>Selecciona la opción Botones de PayPal</li><br>
                      <li> Una vez dentro, presiona en crear nuevo botón</li> <br>
                      <li> Rellena los datos solicitados</li> <br>
                      <li> Copia el código HTML que te muestra</li> <br>
                      <li>Pega el codigo en la sección Ingresar codigo en la vista anterior de ConTodoFit</li>
                    </ul>',
                'processor_link'=>'https://www.paypal.com/',
        	],
        	[
        		'title'=>'Payu Latam',
        		'image'=>'images/payu.png',
                'instructions'=>'<ul>
                   <li> Ve a tu cuenta de Payu latam desde <a href="https://www.payulatam.com/" target="_blank">Aquí</a></li><br>
                    <li>Para generar un botón de pago debes ingresar a la pestaña “Herramientas” opción “Botones de pago”.</li><br>
                    <li>Elige “Crear Botón pagar”</li><br>
                    <li> Luego describe el producto o servicio que vas a vender</li> <br>
                    <li> te generará el código HTML del Botón. Este código se debe copiar en tu página web.</li> <br>
                    <li> Copia el código HTML que te muestra</li> <br>
                    <li>Pega el codigo en la sección Ingresar codigo en la vista anterior de ConTodoFit</li>
                    </ul>',
                'processor_link'=>'https://www.payulatam.com/',
        	],
        ]);
    }
}
