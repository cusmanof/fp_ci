<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Year extends CI_Controller {

    public function index() {
         $data = array(
            'year' => 2016,
        );
        $this->load->view('free_year', $data);
    }

}
