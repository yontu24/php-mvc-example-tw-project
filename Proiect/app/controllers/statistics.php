<?php

class Statistics extends Controller
{
    public function index()
    {
        $loc = $this->model('Location');
        $loc->_value = $loc->getData();
        $year = $this->model('Year');
        $year->_value = $loc->getData();
        $data = $this->model('Test');
        $data->_value = $data->getData();

        $this->view('statistics/charts', $loc->_value, $year->_value, $data->_value);
    }
}