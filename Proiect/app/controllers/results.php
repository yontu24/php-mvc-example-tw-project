<?php

class Results extends Controller
{
    public function index()
    {
        $this->view('result/index');
    }

    public function formularTip()
    {
        if(isset($_POST['filterAction']))
        {
            if($_POST['filterAction'] == 'comparison')
            {
                $this->view('comparison/chartType');
            }
            else
            {
                $this->view('statistics/chartType');
            }
        }
    }
}