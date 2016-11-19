<?php 

Route::get('/',  [
    'as'        => 'home',
    'uses'      => 'HomeController@index'
]); 

require('auth.routes.php');
require('user.routes.php');






