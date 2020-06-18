<?php

class Results extends Controller
{
    public function showchart()
    {
        $loc = $this->model('Location');
        $loc->_value = $loc->getData();
        $year = $this->model('Year');
        $year->_value = $loc->getData();
        $data = $this->model('Test');
        $data->_value = $data->getData();

        // foreach ($loc->_value as $item) :
        //     echo '<br>' . $item;
        // endforeach;

        $this->view('result/chart', $loc->_value, $year->_value, $data->_value);
    }

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
}