<?php
use App\Core\Route;

Route::get("index", "IndexController@index");
Route::get("orders", "IndexController@orders");
Route::get("orders/sort", "OrderController@sort");
Route::get("orders/seed", "OrderController@seed");
Route::get("orders/paid", "OrderController@paid");
Route::get("orders/shipped", "OrderController@shipped");

Route::post("orders/create", "OrderController@create");
Route::post("orders/all", "OrderController@all");
