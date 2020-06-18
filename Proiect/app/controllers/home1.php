<?php
class Home1 extends Controller1 {
    public function test() {
      $loc = $this->model('Location');
      $loc->_value = $loc->getData();
      $year = $this->model('Year');
      $year->_value = $loc->getData();
      $data=$this->model('Test');
      $data->_value=$data->getData();
      // foreach ($loc->_value as $item) :
      //     echo '<br>' . $item;
      // endforeach;

      $this->view('home/test', $loc->_value,$year->_value,$data->_value);
    }
    public function location() {
      $loc = $this->model('Location');
      $loc->_value = $loc->getData();
      $year = $this->model('Year');
      $year->_value = $year->getData();
      //$data=$this->model('Test');
      //$data->_value=$data->getData();
      // foreach ($loc->_value as $item) :
      //     echo '<br>' . $item;
      // endforeach;

      $this->view('home/locations', $loc->_value,$year->_value,[]);
    }
  }
