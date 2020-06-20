<?php

class Comparisons extends Controller
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

        $this->view('comparison/index', $loc->value, $year->value, $response->value, $category->value);
    }

    public function stats()
    {
        $data = $this->model('Comparison');
        $data->values = $data->getData();
        $this->view('comparison/comparison-chart', $data->values);
    }
}