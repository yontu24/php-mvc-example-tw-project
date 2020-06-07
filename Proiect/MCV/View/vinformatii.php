<?php
    class VInformatii{
        private $sablon;
        private $informatii;

        public function __construct()
        {
            $this->sablon = DIRECTOR_SITE.SLASH.'View'.SLASH.'sinformatii.tpl';
        }

        public function incarcaDatele($datele){
            $this->informatii = $datele;
            // echo "<pre>";
            // print_r($this->informatii);
            // echo "</pre>";
        }

        public function oferaVizualizare($edit = NULL){
            $datele = $this->informatii;
            ob_start();
            include($this->sablon);            
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }

    }