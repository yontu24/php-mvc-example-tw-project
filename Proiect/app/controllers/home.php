<?php

class Home extends Controller
{
    // aici o sa vina pagina principala
    public function index($name = '')
    {
        // asta se va gasi in app/view
        $this->view('home/index', ['name' => $name]);
    }
}
