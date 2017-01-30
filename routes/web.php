<?php 

Route::get('/',  [
    'as'        => 'home',
    'uses'      => 'HomeController@index'
]); 

require('auth.routes.php');
require('user.routes.php');
require('server.routes.php');
require('order.routes.php');
require('gameserver.routes.php');




