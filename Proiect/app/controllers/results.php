<?php

class Results extends Controller
{
    public function index()
    {
        $loc = $this->model('Location');
        $loc->value = $loc->getData();
        $year = $this->model('Year');
        $year->value = $year->getData();
        $response = $this->model('Response');
        $response->value = $response->getData();
        $category = $this->model('Category');
        $category->value = $category->getData();

        $this->view('result/index', $loc->value, $year->value, $response->value, $category->value);
    }

    public function formularParametrii()
    {
        $loc = $this->model('Location');
        $loc->value = $loc->getData();
        $year = $this->model('Year');
        $year->value = $year->getData();
        $response = $this->model('Response');
        $response->value = $response->getData();
        $category = $this->model('Category');
        $category->value = $category->getData();

        $this->view('result/chartSelection', $loc->value, $year->value, $response->value, $category->value);
    }
}