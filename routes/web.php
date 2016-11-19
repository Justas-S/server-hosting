<?php 

Route::get('/',  [
    'as'        => 'home',
    'uses'      => 'HomeController@index'
]); 

require('auth/auth.routes.php');






