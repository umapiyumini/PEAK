<?php 

if($_SERVER['SERVER_NAME'] == 'localhost'){
    
    define('DBNAME','PEAK');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');


    define('ROOT','http://localhost/PEAK/public');
    define('LINKROOT','http://localhost/PEAK');
}else{
    
    define('DBNAME','PEAK');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');

    define('ROOT','https://www.peak.com');



}

define('APP_NAME',"PEAK");
define('APP_DESCRIPTION',"Physical Education administrative kit");


define('DEBUG',true);


