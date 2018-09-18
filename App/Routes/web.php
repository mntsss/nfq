<?php
use App\Core\Route;

Route::get("index", "IndexController@index");
Route::get("orders", "IndexController@orders");
Route::get("orders/sort", "OrderController@sort");

Route::post("orders/create", "OrderController@create");
Route::post("orders/all", "OrderController@all");
