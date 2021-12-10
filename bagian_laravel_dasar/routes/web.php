<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', "AuthController@index")->name("login");
Route::post('/login', "AuthController@login")->name("login.post");

Route::middleware("auth")->group(function () {
    Route::post('/logout', "AuthController@logout")->name("logout");
    Route::get('/', "HomeController@index")->name("home");
    Route::resource("employees", "EmployeeController");
    Route::resource("companies", "CompanyController");
    Route::resource("import_companies", "ImportCompanyController")->only(["index", "store"]);
    Route::resource("import_employees", "ImportEmployeeController")->only(["index", "store"]);
    Route::post("companies/create/temp", "CompanyController@tempUpload")->name("companies.store.temp");
    Route::get("companies/{company}/employees", "CompanyController@reportEmployee")->name("companies.show.employees");
    Route::post("companies/{company}/edit/file", "CompanyController@upload")->name("companies.store.file");
    Route::get("companies/create/temp/{filename}", "CompanyController@getTempFile")->name("companies.show.temp");
    Route::get("companies/{company}/{filename}", "CompanyController@getFile")->name("companies.show.file");

    Route::get("employees/list/company", "EmployeeController@getListCompany")->name("employee.company");
});
