<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::prefix("app")->group(function () {
    Auth::routes();
});
//Language Translation
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('home');

Route::get('modules', [App\Http\Controllers\Frontend\FrontendController::class, 'showModules'])->name('modules');
Route::post('contact-us', [App\Http\Controllers\Frontend\FrontendController::class, 'sendContactUs'])->name('contact-us');
Route::get('module/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'showModuleDetails'])->name('module.details');
Route::post('module/apply', [App\Http\Controllers\Frontend\FrontendController::class, 'applyModule'])->name('module.apply');

Route::get('history', function(){
    return view('frontend.history');
})->name('history');


Route::get('mandate', function(){
    return view('frontend.mandate');
})->name('mandate');

Route::get('cooperate-statement', function(){
    return view('frontend.cooperate-statement');
})->name('cooperate-statement');

Route::get('organizational-structure', function(){
    return view('frontend.organogram');
})->name('organizational-structure');



Route::get('app/migrate', function () {
    Artisan::call('migrate');
    echo "migrate";
});

Route::middleware('auth')->group(function () {

    
    
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
    
    Route::resource('icdl_modules', \App\Http\Controllers\Models\ICDLModuleController::class);

    Route::post('icdl_module/resources', [\App\Http\Controllers\Models\ICDLModuleController::class, 'uploadResource'])->name('icdl_module.resources.store');

    Route::delete('icdl_module/resources/{id}', [\App\Http\Controllers\Models\ICDLModuleController::class, 'deleteResource'])->name('icdl_module.resources.destroy');
    
    Route::resource('icdl_applications', \App\Http\Controllers\Models\ICDLApplicationController::class);



    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::resource('users', \App\Http\Controllers\Models\UserController::class);
        
    });


    Route::get('profile', [\App\Http\Controllers\Models\UserController::class,'showProfile'])->name('profile');


});


