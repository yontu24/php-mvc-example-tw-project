<?php

class Home extends Controller
{
    // aici o sa vina pagina principala
    public function index()
    {
        // asta se va gasi in app/view
        $this->view('home/index');
    }

    public function documentation()
    {
        $this->view('home/documentation');
    }
}
