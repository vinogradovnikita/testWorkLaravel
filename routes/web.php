<?php


// Главная страница отображения погоды
Route::get('/', 'PageController@weatherShow')->name('weather.show');

// Роут заказов
Route::resource('order', 'OrderController')->only([
    'index', 'edit', 'update'
]);;