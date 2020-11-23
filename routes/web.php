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

Route::get('/','Frontend\PaibaController@index');

include 'frontendRoute.php';


Route::middleware(['auth','disablepreventback','admin'])->group(function () {
    Route::get('/home', 'DashboadController@home');
    Route::get('/home/{slug}', 'DashboadController@subMenu');
    Route::get('/home/{slug}/{subslug}', 'DashboadController@subSubMenu');
    Route::get('/email-update-for-verify', 'Auth\VerificationController@updateEmail');

    Route::resource('manage-ad','ManageAdController')->middleware('permission:manage-ad.view,manage-ad.create,manage-ad.update,manage-ad.delete');
    Route::get('/load-area-by-division-town/{divisionTown}', 'ManageAdController@loadAreaByDivisionTown');

    Route::get('/all-ads', 'ManageAdController@allAds')->middleware('permission:all-approve-ads');
    Route::get('/show-all-ads', 'ManageAdController@showAllAds');

    Route::get('/change-ad-status/{status}/{id}', 'ManageAdController@changeAdStatus');

    // -------- basic setting ----------
    Route::resource('post-field','PostFieldController')->middleware('permission:post-field');
    Route::resource('division-town','DivisionTownController')->middleware('permission:division-town');
    Route::resource('area','AreaController')->middleware('permission:area');
    Route::resource('category','CategoryController')->middleware('permission:category');
    Route::resource('sub-category','SubCategoryController')->middleware('permission:sub-category');
    Route::resource('location','LocationController')->middleware('permission:location');
    Route::resource('brand','BrandController')->middleware('permission:brand');
    Route::get('load-sub-category/{categoryId}','BrandController@loadSubcategoryByCategory');

    Route::resource('business-category','CategoryController');
   // Route::resource('last-step-catageory','LastStepCategoryController');

    Route::resource('/designation','DesignationController')->middleware('permission:designation');

    // acl -----------------------------
    Route::resource('acl-role', 'AclRolesController')->middleware('permission:acl');
    Route::resource('acl-permission', 'AclPermissionController')->middleware('role:developer');
    Route::post('acl-permission-role', 'AclPermissionController@storeRole')->middleware('permission:acl');

    Route::resource('primary-info','PrimaryInfoController')->middleware('permission:primary-info');
    Route::resource('all-users','UsersController')->middleware('permission:admin-users');

    Route::resource('user-profile','ProfileController');
    Route::post('change-password',[ 'as'=>'password','uses'=>'UsersController@password']);
    Route::get('change-password','UsersController@changePass')->middleware('permission:users');

    // menu setting --------------------
    Route::resource('menu','MenuController')->middleware('permission:menu');
    Route::resource('sub-menu','SubMenuController')->middleware('permission:menu');
    Route::resource('sub-sub-menu','SubSubMenuController')->middleware('permission:menu');
    Route::get('page-menu','MenuController@page')->middleware('permission:menu');
    Route::resource('pages','PagesController')->middleware('permission:pages');
    Route::get('/logout','IndexController@logout');
});

Route::get('/job-queue','JobQueueController@index');

Auth::routes(['register'=>true]);

Route::get('clear-all','CacheClearController@clearAllAndReset');


