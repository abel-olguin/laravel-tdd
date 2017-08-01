<?php

Route::resource('posts','PostController',['except' => ['show','index']]);
/*
 * Route::get('post/{post}',function(){...})->where('post','\d+');
 * */

Route::post('post/{post}/comment',['uses' => 'CommentController@store','as' => 'comment.store']);