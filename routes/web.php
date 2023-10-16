<?php

use App\Http\Controllers\Admin\AltServiceSectionSettingController;
use App\Http\Controllers\Admin\ConstructionSettingController;
use App\Http\Controllers\admin\ContactInformationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\ProjectSectionSettingController;
use App\Http\Controllers\Admin\RecentBlogSettingController;
use App\Http\Controllers\Admin\SecondServiceLinkController;
use App\Http\Controllers\Admin\ServiceLinkController;
use App\Http\Controllers\Admin\ServiceSectionSettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\admin\TestimonialSettingController;
use App\Http\Controllers\Admin\ThirdServiceLinkController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\TestimonialSetting;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class,'index'])->name('home');



Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Admin Routes

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::resource('hero',HeroController::class);
    Route::resource('construction-setting',ConstructionSettingController::class);
    Route::resource('service-setting',ServiceSectionSettingController::class);
    Route::resource('alt-service-setting',AltServiceSectionSettingController::class);
    Route::resource('project-setting', ProjectSectionSettingController::class);
    Route::resource('testimonial-setting',TestimonialSettingController::class);
    Route::resource('recent-blog-setting', RecentBlogSettingController::class);
    Route::resource('contact-info', ContactInformationController::class);
    Route::resource('useful-link', UsefulLinkController::class);
    Route::resource('social-link', SocialLinkController::class);
    Route::resource('service-link', ServiceLinkController::class);
    Route::resource('second-service-link', SecondServiceLinkController::class);
    Route::resource('third-service-link', ThirdServiceLinkController::class);

    
   
 });