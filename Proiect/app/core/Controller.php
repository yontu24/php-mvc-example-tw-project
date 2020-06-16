<?php

class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    // ceea ce parsam in functia asta va fi automat valabil
    // fisierul $view. In acest caz, $data va fi valabil in $view
    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }
}