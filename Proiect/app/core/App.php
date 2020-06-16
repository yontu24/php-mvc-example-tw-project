<?php

class App {

    // default
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    
    public function __construct() {
        $url = $this->parseUrl();
        if (!empty($url)) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]); // remove from the array
            }
        } else {
            echo 'Go to /home/index/';
        }
        
        require_once '../app/controllers/' . $this->controller . '.php';
        
        // creezm o noua instanta a obiuectului controller
        $this->controller = new $this->controller;
        
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // daca nu exista parametrii dupa un controler si o metoda valida,
        // va da eroare, de aceea asignez un array []
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    /* logica: din parseUrl(): daca home este un controler si index o metoda, atunci restul sunt parametri */
}