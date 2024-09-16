<?php

if ($_SERVER['SERVER_NAME']=='localhost'){
   
    define('DBNAME','my_db');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBHOST','localhost');
    define('DBDRIVER','');
    define('ROOT','http://localhost/mvc/public');
}
else{
    
    define('DBNAME','my_db');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBHOST','localhost');
    define('DBDRIVER','');

    define('ROOT','https://yourdomain.com/public');
}

define('APP_NAME', "My Website");
define('APP_DESC', "Best web site on the planet");


define('DEBUG',true); //shoe errors