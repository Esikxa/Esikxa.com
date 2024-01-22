<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', ['uses' => "Auth\LoginController@index", 'as' => 'auth.login']);
    Route::post('/login', ['uses' => "Auth\LoginController@login", 'as' => 'auth.login']);
    Route::get('/forget-password', ['uses' => "Auth\ForgetPasswordController@index", 'as' => 'auth.forget.password']);
    Route::post('/forget-password', ['uses' => "Auth\ForgetPasswordController@forgetPassword", 'as' => 'auth.forget.password']);
    Route::get('/reset-password/{tokem}', ['uses' => "Auth\ResetPasswordController@index", 'as' => 'auth.reset.password']);
    Route::post('/reset-password/{token}', ['uses' => "Auth\ResetPasswordController@resetPassword"]);
});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout', 'as' => 'auth.logout']);
    Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);
    Route::get('/dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);


    Route::resource('role', 'RoleController');

    Route::prefix('admin')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'AdminController@changeStatus', 'as' => 'admin.change-status']);
        Route::get('/trash', ['uses' => 'AdminController@trash', 'as' => 'admin.trash']);
        Route::get('/restore/{id}', ['uses' => 'AdminController@restore', 'as' => 'admin.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'AdminController@forceDelete', 'as' => 'admin.force-delete']);
    });
    Route::resource('admin', 'AdminController');

    Route::prefix('student')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'StudentController@changeStatus', 'as' => 'student.change-status']);
        Route::get('/trash', ['uses' => 'StudentController@trash', 'as' => 'student.trash']);
        Route::get('/restore/{id}', ['uses' => 'StudentController@restore', 'as' => 'student.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'StudentController@forceDelete', 'as' => 'student.force-delete']);
    });
    Route::resource('student', 'StudentController');

    Route::prefix('teacher')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'TeacherController@changeStatus', 'as' => 'teacher.change-status']);
        Route::get('/trash', ['uses' => 'TeacherController@trash', 'as' => 'teacher.trash']);
        Route::get('/restore/{id}', ['uses' => 'TeacherController@restore', 'as' => 'teacher.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'TeacherController@forceDelete', 'as' => 'teacher.force-delete']);
    });
    Route::resource('teacher', 'TeacherController');

    Route::prefix('request-tutor')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'RequestTutorController@changeStatus', 'as' => 'request-tutor.change-status']);
        Route::get('/trash', ['uses' => 'RequestTutorController@trash', 'as' => 'request-tutor.trash']);
        Route::get('/restore/{id}', ['uses' => 'RequestTutorController@restore', 'as' => 'request-tutor.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'RequestTutorController@forceDelete', 'as' => 'request-tutor.force-delete']);
    });
    Route::resource('request-tutor', 'RequestTutorController');

    Route::prefix('banner')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'BannerController@changeStatus', 'as' => 'banner.change-status']);
        Route::get('/trash', ['uses' => 'BannerController@trash', 'as' => 'banner.trash']);
        Route::get('/restore/{id}', ['uses' => 'BannerController@restore', 'as' => 'banner.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'BannerController@forceDelete', 'as' => 'banner.force-delete']);
    });

    Route::resource('banner', 'BannerController');
    Route::prefix('contact')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'ContactController@changeStatus', 'as' => 'contact.change-status']);
        Route::get('/trash', ['uses' => 'ContactController@trash', 'as' => 'contact.trash']);
        Route::get('/restore/{id}', ['uses' => 'ContactController@restore', 'as' => 'contact.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'ContactController@forceDelete', 'as' => 'contact.force-delete']);
    });

    Route::resource('contact', 'ContactController');
    Route::resource('layout-option', 'LayoutOptionController');
    Route::resource('site-setting', 'SiteSettingController');

    Route::prefix('menu')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'MenuController@changeStatus', 'as' => 'menu.change-status']);
        Route::prefix('{menu}')->group(function () {
            Route::prefix('menu-item')->group(function () {
                Route::post('/sort', ['uses' => 'MenuItemController@sort', 'as' => 'menu.menu-item.sort']);
            });
            Route::resource('menu-item', 'MenuItemController', ['as' => 'menu']);
        });
    });
    Route::resource('menu', 'MenuController');

    Route::prefix('content')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'ContentController@changeStatus', 'as' => 'content.change-status']);
        Route::get('/trash', ['uses' => 'ContentController@trash', 'as' => 'content.trash']);
        Route::get('/restore/{id}', ['uses' => 'ContentController@restore', 'as' => 'content.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'ContentController@forceDelete', 'as' => 'content.force-delete']);
    });
    Route::resource('content', 'ContentController');

    Route::prefix('grade')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'GradeController@changeStatus', 'as' => 'grade.change-status']);
        Route::get('/trash', ['uses' => 'GradeController@trash', 'as' => 'grade.trash']);
        Route::get('/restore/{id}', ['uses' => 'GradeController@restore', 'as' => 'grade.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'GradeController@forceDelete', 'as' => 'grade.force-delete']);
    });
    Route::resource('grade', 'GradeController');
    Route::prefix('subject')->group(function () {
        Route::get('/change-status/{id}', ['uses' => 'SubjectController@changeStatus', 'as' => 'subject.change-status']);
        Route::get('/trash', ['uses' => 'SubjectController@trash', 'as' => 'subject.trash']);
        Route::get('/restore/{id}', ['uses' => 'SubjectController@restore', 'as' => 'subject.restore']);
        Route::get('/force-delete/{id}', ['uses' => 'SubjectController@forceDelete', 'as' => 'subject.force-delete']);
    });
    Route::resource('subject', 'SubjectController');
});
