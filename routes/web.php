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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/profile/{slug}','ProfileController@index')->name('profile');
    Route::get('/profile/edit/{slug}','ProfileController@edit')->name('profile.edit');
    Route::post('/profile/update/{slug}','ProfileController@update')->name('profile.update');

    Route::get('/add_friend/{id}','FriendshipController@add_friend')->name('add_friend');
    Route::get('/accept_friend/{id}','FriendshipController@accept_friend')->name('accept_friend');

    Route::post('/create/post', 'PostController@store')->name('post.store');
    Route::get('/feed', 'FeedController@feed')->name('feed');

    Route::get('/get_auth_user_data', function(){
        return Auth::user();
    });

    Route::get('/like/{id}', 'LikeController@like');
    Route::get('/unlike/{id}', 'LikeController@unlike');


    Route::get('add',function(){

        return \App\User::find(1)->add_friend(12);

    });

    Route::get('accept',function(){

        return \App\User::find(2)->accept_friend(1);

    });

 
    Route::get('friends',function(){

        return \App\User::find(1)->friends();

    });   

     
    Route::get('pending_friends',function(){

        return \App\User::find(1)->pending_friend_requests();

    }); 


    Route::get('ids',function(){

        return \App\User::find(1)->friends_ids();

    }); 


    Route::get('is',function(){

        return \App\User::find(1)->is_friends_with(5);

    }); 

    Route::get('check',function(){

        return \App\User::find(1)->add_friend(2);

    }); 

    Route::get('/check_relationship_status/{id}','FriendshipController@check')->name('check');
    

});