<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Year extends CI_Controller {

    public function index() {
         $data = array(
            'year' => date("Y"),
             'free_days'=> $this->Freepark_model->get_free_days()
        );
        $this->load->view('free_year', $data);
    }

}
