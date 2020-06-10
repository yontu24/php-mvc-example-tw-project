<?php
    class CRead
    {
        private $model;
        public function __construct($actiune, $parametri)
        {
            $this->model = new MInformatii();
            if ($actiune=="primulChart") $this->getInformatii($parametri);
            $this->afiseazaInformatii();
        }

        private function getInformatii($parametri){
            $raspuns = $this->model->getInformatii($parametri[0], $parametri[1], $parametri[2]);
        }

        private function afiseazaInformatii(){
            $informatii = $this->model->getInformatii('Puerto Rico','Age Group','Obese (BMI 30.0 - 99.8)');
            $view = new VInformatii();
            $view -> incarcaDatele($informatii);
            echo $view -> oferaVizualizare();
        }

    }

?>