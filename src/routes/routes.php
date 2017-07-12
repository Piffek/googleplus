<?php

Route::get('/', 'GooglePlus\Client@beforeRedirect');
Route::get('/auth', 'GooglePlus\Client@afterRedirect');