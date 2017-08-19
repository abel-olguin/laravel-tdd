<?php

Route::resource('posts','PostController',['except' => ['show','index']]);
/*
 * Route::get('post/{post}',function(){...})->where('post','\d+');
 * */

Route::post('post/{post}/comment',['uses' => 'CommentController@store','as' => 'comment.store']);
Route::post('comments/{comment}/accept',['uses' => 'CommentController@accept','as' => 'comment.accept']);