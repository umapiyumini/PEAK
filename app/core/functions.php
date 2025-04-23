<?php

//debugging
function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

//ignores html tags
function esc($str){
    return htmlspecialchars($str);
}

//
function redirect($path){
    header('Location: '. ROOT."/". $path);
    die;
}







		

