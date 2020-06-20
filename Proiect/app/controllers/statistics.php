<?php

class Statistics extends Controller
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

        if(isset($_POST['filterChart']))
        {
        ?>
            <script type=text/javascript>
                localStorage.setItem('chartType', '<?php echo $_POST['filterChart'] ?>');
            </script>
        <?php
        }


        $this->view('statistics/index', $loc->value, $year->value, $response->value, $category->value);
    }

    public function stats()
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