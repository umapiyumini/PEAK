<?php 

if($_SERVER['SERVER_NAME'] == 'localhost'){
    // database configuration
    define('DBNAME','PEAK');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');


    define('ROOT','http://localhost/PEAK/public');
    define('LINKROOT','http://localhost/PEAK');
}else{
    // database configuration
    define('DBNAME','PEAK');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');

    define('ROOT','https://www.peak.com');



}

define('APP_NAME',"PEAK");
define('APP_DESCRIPTION',"Physical Education administrative kit");

// true means show errors. so change once in the live server
define('DEBUG',true);


