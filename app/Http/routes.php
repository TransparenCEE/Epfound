<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::get('/', function () {
//    return view('index');
//});


// Lang Pack
Route::post('/language', array(
    'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@loader'
));
//Route::get('/', function () {
//    return redirect('/self-governing/local-budget/2015');
//});

Route::group(['middleware' => 'LangMW'], function () {
// European Foundation Pages
Route::get('/', 'HomeController@index');
Route::get('/mycountry/infographic', 'HomeController@infoGraphic');
Route::get('/self-governing/local-budget/{id}', 'MunicipalityController@index');
Route::get('/self-governing/chronology/{id?}/{id2?}', 'MunicipalityChronology@index');
Route::get('/self-governing/details/{id?}/{id2?}', 'MunicipalityChronology@details');
Route::get('/mycountry/budget-chronology', 'Country@index');
Route::get('/mycountry/expenditures/{id?}', 'Country@expenditures');
Route::get('/mycountry/country-plan', 'Country@plan');
Route::get('/self-governing/city-expanses/{city?}/{year?}', 'City@index');
Route::get('/self-governing/compare/{id1?}/{id2?}/{id3?}', 'Compare@compare');
Route::get('/self-governing/compare-result', 'Compare@innerCompare');
});


//----------------------------------------------------------------------------------------------------------------------
/**
 * Municipaluri xarjebis API
 */
Route::get('/local-cities/{id?}', 'MunicipalityController@local_cities_API');
Route::get('/common-outcomes-API/{id}/{year}', 'MunicipalityController@common_outcomes_API');
// END API
//----------------------------------------------------------------------------------------------------------------------
//* Chronology API
Route::get('/income_chart/{id?}', 'MunicipalityChronology@income_chart');
Route::get('/outcome_chart/{id?}', 'MunicipalityChronology@outcome_chart');
Route::get('/expenses_API', 'MunicipalityChronology@municipality_expenses');
Route::get('/last-year', 'MunicipalityChronology@last_year');
Route::get('/details/{id?}/{id2}', 'MunicipalityChronology@details');
// END CHRONOLOGY
// ---------------------------------------------------------------------------------------------------------------------

Route::get('/country-compare/{id1?}/{id2?}/{id3?}', 'Country@compare');
Route::get('/separeted_json/{id1?}/{id2?}/{id3?}', 'Country@separeted_json');
Route::get('/budget-chart', 'Country@budget_chart_chronology');

//----------------------------------------------------------------------------------------------------------------------
// C I T Y
Route::get('/city_outcomes_API/{id?}/{id2?}', 'City@city_outcomes_API');
//----------------------------------------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------------
// B L O G
Route::any('/blog/', 'blogController@index');
Route::any('/blog/add/', 'blogController@add');
Route::any('/blog/{id}', 'blogController@view');
//----------------------------------------------------------------------------------------------------------------------


/* EMAIL */
Route::any('/answers/ask-question', 'LashaController@index');
Route::any('/ask-question/send', 'LashaController@send');
Route::any('/viewquestion/{id}', 'LashaController@viewquestion');
Route::get('/answers/faqs', 'LashaController@faqs');

/////////////////////---------------Manually Created AUTH----------------//////////////////////
Route::group(['middleware' => 'web'], function () {
    Route::group(['prefix' => 'admin'], function() {

        ///// AUTH
        // Authentication Routes...
        $this->get('login', 'Auth\AuthController@showLoginForm');
        $this->post('login', 'Auth\AuthController@login');
        $this->get('logout', 'Auth\AuthController@logout');

        // Registration Routes...
        $this->get('register', 'Auth\AuthController@showRegistrationForm');
        $this->post('register', 'Auth\AuthController@register');

        // Password Reset Routes...
        $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
        $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
        $this->post('password/reset', 'Auth\PasswordController@reset');

        //Route::get('/', 'HomeController@index'); // index page
    });
});


/////////////////////---------------Admin Secured Routes----------------//////////////////////

Route::group(['middleware' => 'auth'], function () {

///////////////////creating admin/ prefix here
    Route::group(['prefix' => 'admin'], function() {

        Route::get('/', 'AdminController@index');
        Route::any('/bacho', 'AdminController@bacho');


        // -------------- manage categories --------------------
        Route::get('/category/{id}', 'AdminController@index');
        Route::any('/category/{id}/add', 'AdminController@categoryAdd');
        Route::get('/category/{id}/delete/{id2}', 'AdminController@deleteCat');
        Route::get('/category/{id}/edit/{id2}', 'AdminController@editCat');
        Route::post('/category/{id}/update/{id2}', 'AdminController@editCat');
        ########################################################

        // -------------- Sub categories -----------------------
        Route::any('/subcat/{id}', 'AdminController@subcat');
        # add main category in subcats
        Route::any('/subcat/{id}/maincat/add', 'AdminController@mainSubCat');
        # update
        Route::any('/subcat/{id}/update/{id2}', 'AdminController@mainSubCatUpdate');
        # add subCat to main SubCategory
        Route::any('/subcat/{id}/add/{id2}', 'AdminController@subcatAdd');

        # edit sub category
        Route::any('/subcat/parent/{id}/edit/{id2}', 'AdminController@subCatEdit');
        # delete
        Route::get('/subcat/delete/{id}', 'AdminController@deleteSubCat');


        # ADD DATA
        Route::get('/addData/{id?}/{id2?}', 'Admin_addData@index');
        Route::post('addData/add', 'Admin_addData@add');


        # ADD DATA
        Route::any('/blog/', 'blogController@admin');
        Route::any('/blog/{id}/', 'blogController@adminAdd');
        Route::get('/blog/delete/{id}', 'blogController@deleteSubCat');
        Route::get('/blog/publish/{id}', 'blogController@publish');

        # FAQ
        Route::any('/faq/', 'blogController@admin');

        # Show Data
        Route::get('/showdata/{id}/{categoryID}/{year?}', 'Admin_showData@showData');
        //Route::get('/editdata/{categoryID}/{id}/{year?}', 'Admin_showData@editData');

    });
});


