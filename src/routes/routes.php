<?php

Route::get('/', 'GooglePlus\Client@index');
Route::get('/auth', 'GooglePlus\Client@afterRedirect');