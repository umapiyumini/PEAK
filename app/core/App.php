<?php

class App
{
    private $controller = 'Guesthome';
    private $method = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL,"/"));
        return($URL);
    }
    
    public function loadController()
    {
        $URL = $this->splitURL();

    
        $controllerPath = "../app/controllers/";
        foreach ($URL as $key => $segment) {
            if(is_dir($controllerPath . ucfirst($segment))) {
            
                $controllerPath .= ucfirst($segment) . "/";
                unset($URL[$key]);
            } else {
                
                $controllerPath .= ucfirst($segment) . ".php";
                $this->controller = ucfirst($segment); 
                unset($URL[$key]);
                break;  
            }
        }

        
        if(file_exists($controllerPath))
        {
            require $controllerPath;
        } 
        else
        {
            
            require "../app/controllers/_404.php";
            $this->controller = "_404";
        }

    
        $controller = new $this->controller;

        
        if(!empty($URL[2]))
        {
            if(method_exists($controller, $URL[2]))
            {
                $this->method = $URL[2];
                unset($URL[2]);
            }
        }

        
        call_user_func_array([$controller, $this->method], $URL);
    }
}