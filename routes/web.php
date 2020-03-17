<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('Dashboard');
    
});

Auth::routes();

Route::get('/home', function(){
    return redirect()->route('Dashboard');

})->name('home');

Route::post('/charge', 'OpenPayController@store')->name('openPay.store');


Route::get('/register/verify/{confirmation_code}', 'EmailController@verify')->name('email.verify');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/configuration', 'UserController@config')->name('config');
    Route::get('/billing', 'BillingController@billing')->name('billing');

    //Change password
    Route::put('/change/password/{slug}', 'UserController@change_password')->name('change_password');

    //Cambiar imágen de perfil
    Route::put('user/change/picture/{slug}', 'UserController@change_picture')->name('change_picture');
    //stripe
    
    Route::post('/charge_stripe', 'StripeController@store')->name('stripe.charge');

    Route::get('cancel-subscription','StripeController@cancelSubscription')->name('cancel.subscription');

    Route::get('resume-subscription','StripeController@resumeSubscription')->name('resume.subscription');

    Route::get('create-subscription','StripeController@createSuscription')->name('create.subscription');

    //paypal

    Route::get('paypal/subscription/create', 'PaypalSubscriptionController@store')->name('create.subscription.paypal');
    
    Route::get('paypal/subscription/suspend','PaypalSubscriptionController@suspendSubscription')->name('paypal.subscription.suspend');

    Route::get('paypal/subscription/reactivate','PaypalSubscriptionController@reactivateSubscription')->name('paypal.subscription.reactivate');

    Route::any('paypal/success','PaypalSubscriptionController@success')->name('paypal.success');
    Route::any('paypal/cancel','PaypalSubscriptionController@cancel')->name('paypal.cancel');

    Route::group(['middleware' => 'subscribed'], function () {
    

        //Dashboard
        Route::get('/dashboard', 'UserController@dashboard')->name('Dashboard');
        

        // Crud Pacientes
        Route::get('/patients', 'PatientController@index')->name('patients.index');
        Route::get('/patients/new-patient', 'PatientController@create')->name('patients.create');
        Route::post('/patients/new-patient', 'PatientController@store')->name('patients.store');
        Route::get('/patient/show/patient/{slug}', 'PatientController@show')->name('patients.show');
        Route::get('/patient/edit/{slug}', 'PatientController@edit')->name('patients.edit');
        Route::put('/patients/edit/{slug}', 'PatientController@update')->name('patients.update');
        Route::delete('patient/delete/{slug}', 'PatientController@destroy')->name('patients.destroy');

        //Crud de citas (Eventos)
        Route::get('/patients/event/create/{slug}', 'EventController@create')->name('event.create');
        Route::post('/patients/event/created', 'EventController@store')->name('event.store');
        Route::get('/appointments', 'EventController@index')->name('event.index');
        Route::get('/appointments/event/{slug}', 'EventController@show')->name('event.show');
        Route::delete('/appointment/delete/{slug}', 'EventController@destroy')->name('event.delete');

        //Historia Clinica
        Route::get('/patient/{slug}/create/BriefClinicalHistory', 'ClinicHistoryController@BriefClinicalHistory')->name('BriefClinicHistory.create');
        Route::get('/patient/{slug}/ClinicHistory', 'ClinicHistoryController@ClinicalHistoryPatient')->name('ClinicHistoryPatient');
        Route::post('/patient/{slug}/create/BriefClinicHistory/created', 'ClinicHistoryController@BriefClinicHistoryStore')->name('BriefClinicHistory.store');
        Route::get('/patient/{slug}/edit/BriefClinicalHistory', 'ClinicHistoryController@BriefClinicHistoryEdit')->name('BriefClinicalHistory.edit');
        Route::put('/patient/{slug}/BriefClinicHistory/Updated', 'ClinicHistoryController@BriefClinicHistoryUpdate')->name('BriefClinicHistory.update');

        //Analisis Quimicos
        Route::get('/patient/{slug}/create/ChemicalAnalysis', 'ChemicalAnalysisController@create')->name('ChemicalAnalysis.create');

        //Stores y Updates Analisis Bioquímicos
        Route::post('/patient/{slug}/ChemicalAnalysis/created', 'ChemicalAnalysisController@bloodChemistryStore')->name('bloodChemistry.store');
        Route::put('/patient/{slug}/ChemicalAnalysis/updated', 'ChemicalAnalysisController@bloodChemistryUpdate')->name('bloodChemistry.update');
        Route::post('/patient/{slug}/HematicBiometry/created', 'ChemicalAnalysisController@hematicBiometryStore')->name('hematicBiometry.store');
        Route::put('/patient/{slug}/HematicBiometry/updated', 'ChemicalAnalysisController@hematicBiometryUpdate')->name('hematicBiometry.update');
        Route::post('/patient/{slug}/VitaminMineral/created', 'ChemicalAnalysisController@vitaminMineralStore')->name('vitaminMineral.store');
        Route::put('/patient/{slug}/VitaminMineral/updated', 'ChemicalAnalysisController@vitaminMineralUpdate')->name('vitaminMineral.update');
        Route::post('/patient/{slug}/LipidProfile/created', 'ChemicalAnalysisController@lipidProfileStore')->name('lipidProfile.store');
        Route::put('/patient/{slug}/LipidProfile/updated', 'ChemicalAnalysisController@lipidProfileUpdate')->name('lipidProfile.update');
        Route::post('/patient/{slug}/ThyroidProfile/created', 'ChemicalAnalysisController@thyroidProfileStore')->name('thyroidProfile.store');
        Route::put('/patient/{slug}/ThyroidProfile/updated', 'ChemicalAnalysisController@thyroidProfileUpdate')->name('thyroidProfile.update');
        Route::post('/patient/{slug}/Urine/created', 'ChemicalAnalysisController@urineStore')->name('urine.store');
        Route::put('/patient/{slug}/Urine/updated', 'ChemicalAnalysisController@urineUpdate')->name('urine.update');
        Route::post('/patient/{slug}/UrineTest/created', 'ChemicalAnalysisController@urineTestStore')->name('urineTest.store');
        Route::put('/patient/{slug}/UrineTest/updated', 'ChemicalAnalysisController@urineTestUpdate')->name('urineTest.update');

        //Historia Clínica Nutricional
        Route::get('/patient/{slug}/NutritionalClinicalHistory/create', 'NutritionalClinicalHistoryController@create')->name('NutritionalClinicalHistory.create');
        Route::get('/patient/{slug}/NutritionalClinicalHistory/edit', 'NutritionalClinicalHistoryController@edit')->name('NutritionalClinicalHistory.edit');
        Route::post('patinet/{slug}/NutritionalClinicalHistory/created', 'NutritionalClinicalHistoryController@store')->name('NutritionalClinicalHistory.store');
        Route::put('patinet/{slug}/NutritionalClinicalHistory/updated', 'NutritionalClinicalHistoryController@update')->name('NutritionalClinicalHistory.update');
        Route::get('/patient/{slug}/FrequencyConsumption/create', 'NutritionalClinicalHistoryController@frequencyConsumptionCreate')->name('frequencyConsumption.create');
        Route::get('/patient/{slug}/FrequencyConsumption/edit', 'NutritionalClinicalHistoryController@frequencyConsumptionEdit')->name('frequencyConsumption.edit');
        Route::delete('/FrequencyConsumption/delete/{id}', 'NutritionalClinicalHistoryController@frequencyConsumptionDelete')->name('frequencyConsumption.delete');

        //ChartJS
        Route::get('/patient/{slug}/frequencyConsumption/Graphic', 'ChartController@show')->name('chart.show');

        Route::post('/patient/{slug}/frequencyConsumption', 'NutritionalClinicalHistoryController@test')->name('test');

        //Registro de alimentos
        Route::get('foods-ajax', 'FoodController@searchAjax')->name('foods.ajax');
        Route::post('food-groups-ajax', 'FoodController@foodGroupAjax')->name('foodGroups.ajax');
        Route::get('/foods', 'FoodController@index')->name('food.index');
        Route::post('/foodgroup/created', 'FoodController@storeFoodGroup')->name('foodGroup.store');
        Route::post('/food/created', 'FoodController@storeFood')->name('food.store');

        //Signos Vitales
        Route::get('/patient/{slug}/create/VitalSigns', 'VitalSignsController@create')->name('VitalSigns.create');
        Route::post('/patient/{slug}/VitalSigns/created', 'VitalSignsController@store')->name('VitalSigns.store');
        Route::get('/patient/{slug}/VitalSigns/edit', 'VitalSignsController@edit')->name('VitalSigns.edit');
        Route::put('/patient/{slug}/VitalSigns/updated', 'VitalSignsController@update')->name('VitalSigns.update');

        Route::post('chart-food-groups-ajax', 'ReminderController@chartFoodGroupAjax');
        //Peticion de inicio de sesión en gmail (Google Calendar)
        Route::post('/google-calendar/connect/{slug}', 'CalendarController@store')->name('oauth.calendar');
        Route::get('/oauth', 'CalendarController@oauth')->name('oauthCallback');

        // Crud nutriologos
        Route::get('/nutritionists', 'NutritionistController@index')->name('nutritionists.index');
        Route::put('/nutritionists/update/status/{slug}', 'NutritionistController@update')->name('nutritionists.update');

        //Routes axios
        Route::post('/frequencyConsumption/add', 'NutritionalClinicalHistoryController@frequencyConsumptionAdd')->name('frequencyConsumption.store');
        Route::delete('/frequencyConsumption/delete/{id}', 'NutritionalClinicalHistoryController@frequencyConsumptionDelete')->name('frequencyConsumption.delete');

        //Routes Tiempo de Comidas
        Route::resource('food-times', 'FoodTimeController', ['names' => ['index' => 'foodtimes.index', 'create' => 'foodtimes.create', 'store' => 'foodtimes.store', 'show' => 'foodtimes.show', 'update' => 'foodtimes.update', 'destroy' => 'foodtimes.destroy', 'edit' => 'foodtimes.edit']]);

        
        Route::prefix('patient')->group(function () {
            
            //Recordatorios 24 Historia
            Route::get('reminder/{slug}/change', 'ReminderController@change')->name('reminder.change');
            Route::resource('reminder', 'ReminderController', ['names' => ['index' => 'reminder.index', 'create' => 'reminder.create', 'store' => 'reminder.store', 'show' => 'reminder.show', 'update' => 'reminder.update', 'destroy' => 'reminder.destroy', 'edit' => 'reminder.edit']]);

            //Rutas de Antropometria
            Route::get('/{slug}/antropometria', 'AnthropometryController@index')->name('anthropometry.index');
            Route::get('/{slug}/antropometria/medidas-basicas', 'AnthropometryController@basicMeasure')->name('anthropometry.basicMeasure');
            Route::post('/antropometria/medidas-basicas', 'AnthropometryController@basicMeasurePost')->name('anthropometry.basicMeasurePost');
            Route::post('/antropometria/pregestational-weight-ajax', 'AnthropometryController@pregestationalWeightAjax');
            Route::put('/antropometria/medidas-basicas/{id}', 'AnthropometryController@basicMeasureUpdate')->name('anthropometry.basicMeasureUpdate');

            //mediddas corporales
            Route::get('/{slug}/antropometria/medidas-corporales', 'AnthropometryController@bodyMeasure')->name('anthropometry.bodyMeasure');
            Route::post('/antropometria/medidas-corporales', 'AnthropometryController@bodyMeasurePost')->name('anthropometry.bodyMeasurePost');
            Route::put('/antropometria/medidas-corporales/{id}', 'AnthropometryController@bodyMeasureUpdate')->name('anthropometry.bodyMeasureUpdate');

            //Composicion corporal
            Route::get('/{slug}/antropometria/composicion-corporal', 'AnthropometryController@bodyComposition')->name('anthropometry.bodyComposition');

            //Grafica de evolución
            Route::get('/{slug}/antropometria/grafica-evolucion', 'AnthropometryController@evolutionCard')->name('anthropometry.evolutionCard');
            //Somatocarta
            Route::get('/{slug}/antropometria/somatocarta', 'AnthropometryController@Somatocard')->name('anthropometry.somatocard');

            //Ruta de dietetica
            Route::get('/{slug}/dietetica', 'DieteticController@index')->name('dietetic.index');
            Route::get('/{slug}/dietetica/requerimiento-energetico', 'DieteticController@energyRequirement')->name('dietetic.energyRequirement');
            Route::get('/{slug}/dietetica/requerimiento-energetico/edit', 'DieteticController@energyRequirementEdit')->name('dietetic.energyRequirementEdit');
            Route::put('/dietetica/requerimiento-energetico/{id}', 'DieteticController@energyRequirementUpdate')->name('dietetic.energyRequirementUpdate');
            Route::post('/dietetica/requerimiento-energetico', 'DieteticController@energyRequirementPost')->name('dietetic.energyRequirementStore');
            Route::get('/{slug}/dietetica/distribucion-equivalentes', 'DieteticController@equivalentDistribution')->name('dietetic.equivalentDistribution');
            Route::post('/dietetica/distribucion-equivalentes', 'DieteticController@equivalentDistributionStore')->name('dietetic.equivalentDistributionStore');
            Route::post('/dietetica/distribucion-equivalentes/{id}', 'DieteticController@equivalentDistributionUpdate')->name('dietetic.equivalentDistributionUpdate');
            Route::post('/dietetica/distribucion-equivalentes-ajax', 'DieteticController@equivalentDistributionAjax')->name('dietetic.equivalentDistributionAjax');
            Route::post('/dietetica/distribucion-equivalentes-unidad-ajax', 'DieteticController@unityAjax')->name('dietetic.unityAjax');
            Route::get('/{slug}/dietetica/menu', 'MenuController@index')->name('dietetic.menu');
            //Ruta de GET en dietetica
            Route::get('/{slug}/dietetica/get', 'DieteticController@get')->name('dietetic.get');
            Route::post('/dietetica/get', 'DieteticController@getStore')->name('dietetic.getStore');
            Route::put('/dietetica/get/{id}', 'DieteticController@getUpdate')->name('dietetic.getUpdate');
            //Ruta Ajax de MET's
            Route::get('mets-ajax', 'DieteticController@searchMetAjax')->name('mets.ajax');
            //Ruta Ajax de Dishes
            Route::get('dishes-ajax', 'DishController@searchDishAjax')->name('dishes.ajax');
            //Ruta Ajax de Ingredientes
            Route::get('ingredients-ajax', 'MenuController@searchSemAjax')->name('ingredients.ajax');
            //Rutas de platillos
            Route::get('/{slug}/platillos', 'DishController@index')->name('dishes.index');
            Route::get('/{slug}/platillos/create', 'DishController@create')->name('dishes.create');
            Route::get('/platillos/edit/{id}', 'DishController@edit')->name('dishes.edit');
            Route::delete('/platillos/delete/{id}', 'DishController@destroy')->name('dishes.destroy');
            Route::post('/platillos', 'DishController@store')->name('dishes.store');
            Route::get('/platillos/show/{id}', 'DishController@show')->name('dishes.show');
            Route::put('/platillos/{id}', 'DishController@update')->name('dishes.update');
            //Ruta de busqueda de platillo
            Route::get('/{slug}/platillos/search', 'MenuController@search')->name('menu.search');
            //Rutas de Menu
            Route::post('/menu', 'MenuController@store')->name('menu.store');
            Route::put('/menu/{id}', 'MenuController@update')->name('menu.update');
            Route::get('/menu/{id}', 'MenuController@show')->name('menu.show');
            Route::post('/menu/copy', 'MenuController@copy')->name('menu.copy');
            Route::get('/menu/delete/{id}', 'MenuController@delete')->name('menu.delete');
           
        });


        //Rutas de configuracion de pagos de pacientes
        Route::resource('administrar-pagos-de-pacientes','PaymentMethodController')->names([

            'index'=>'index.payment.method',
            'show'=>'show.payment.method',
            'update'=>'update.payment.method'
        ])->only([
            'index',
            'show',
            'update',
        ]);

        
    });

});

Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

Route::get('payment-guest/{code}','PaymentMethodController@paymentGuest')->name('payment.guest');

Route::get('paypal/plans', 'Paypal\PlanController@index');
Route::get('paypal/plans/create', 'Paypal\PlanController@create');

Route::get('paypal/plans/{link}/show', 'Paypal\PlanController@show');
