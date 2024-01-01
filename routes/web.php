<?php
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteSettingController;
use Illuminate\Support\Facades\Artisan;



// Route::get('/link', function () {
//     $target = '/home1/dberry3/portfolio.dunesberry.com/storage/app/public/images';
//     $shortcut = '/home1/dberry3/portfolio.dunesberry.com/storage/images';
//     symlink($target, $shortcut);
// });
// Route::get('/link2', function () {
//     $target = '/home1/dberry3/portfolio.dunesberry.com/storage/app/public/videos';
//     $shortcut = '/home1/dberry3/portfolio.dunesberry.com/storage/videos';
//     symlink($target, $shortcut);
// });




Route::get('/', function () {
    return view('welcome');
});
Route::group(['namespace' => 'App\Http\Controllers'], function()
{  
    Route::get('/', 'PagesController@index')->name('pages.index');
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('', function() {
        return view('admin.dashboard');
        
    });
Route::get('clear-cache', function () {
    Artisan::call('clear:cache');

    return 'Cache cleared successfully.';
});
    Route::resource('pages', PageController::class);
    Route::get('pages/sections/{id}', [PageController::class, 'pagesections'])->name('sections');
    Route::resource('site-setting', SiteSettingController::class);
});

// Route::group(['middleware' => 'auth:web'], function () {
//     Route::get('/admin', function() {
//         return view('admin.dashboard');
        
//     });
// Route::get('/clear-cache', function () {
//     Artisan::call('clear:cache');

//     return 'Cache cleared successfully.';
// });
//     Route::resource('admin/pages', PageController::class);
//     Route::get('admin/pages/sections/{id}', [PageController::class, 'pagesections'])->name('sections');
//     Route::resource('admin/site-setting', SiteSettingController::class);
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
