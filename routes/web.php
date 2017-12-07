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
    return view('Member.index');
})->name('index');

Route::get('/search', function () {
    return view('Member.search');
})->name('search');

Route::get('/addmember', function () {
    return view('Member.addmember');
})->name('addmember');

Route::get("/get_id" , "Member\MemberController@getMemberId")->name("get_id");

Route::post('getMemberInfo', 'Member\MemberController@getMemberInfo')->name('getMemberInfo');

Route::get('getMultipleId', 'Member\MemberController@getMultipleId')->name('getMultipleId');

Route::post('addmember_add', 'Member\MemberController@addmember')->name('addmember_add');

Route::post('/updateusercheckin', 'Member\MemberController@updateusercheckin')->name('updateusercheckin');
