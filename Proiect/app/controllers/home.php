<?php

class Home extends Controller {
    public function index($name = '') {
        $user = $this->model('User');
        $user->name = $name;
        
        // asta se va gasi in app/view
        $this->view('home/index', ['name' => $user->name]);
    }

    public function location() {
        $loc = $this->model('Location');
        $loc->_value = $loc->getData();

        // foreach ($loc->_value as $item) :
        //     echo '<br>' . $item;
        // endforeach;

        $this->view('home/locations', $loc->_value);
    }
}