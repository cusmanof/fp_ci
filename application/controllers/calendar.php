<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends CI_Controller {

    var $yy;
    var $mm;
    var $dd;
    var $owner;
    var $user;

    public function __construct() {
        parent::__construct();
    }

    public function fullDate() {
        return $this->yy . "-" . $this->mm . "-" . $this->dd;
    }

    public function partDate() {
        return $this->yy . "-" . $this->mm . "-";
    }

    public function do_user() {
        
    }

    public function do_owner() {
        $result = $this->Freepark_model->get_entries_for_owner($this->user, $this->partDate());
        if (array_key_exists($this->dd, $result)) {
            $this->Freepark_model->do_release_for_owner($this->user, $this->fullDate());
        } else {
            $this->Freepark_model->do_free_for_owner($this->user, $this->fullDate());
        }
    }

    public function index() {
        $this->user = $this->ion_auth->get_user();
        $this->owner = !empty($this->ion_auth->get_bay());
        if ($this->uri->segment(5)) {
            //we have an update
            $this->yy = $this->uri->segment(3);
            $this->mm = $this->uri->segment(5);
            $this->dd = $this->uri->segment(6);

            if ($this->owner) {
                $this->do_owner();
            } else {
                $this->do_user();
            }
        } else {
            $this->yy = $this->uri->segment(3);
            $this->mm = $this->uri->segment(4);
        }


        if ($this->owner) {
              $res = $this->Freepark_model->get_entries_for_owner($this->user, $this->partDate());
              $req = $this->Freepark_model->get_requested_dates($this->partDate());
              $result = $req + $res;
        } else {
            $result = $this->Freepark_model->get_entries_for_month($this->partDate());
        }
        $data = array(
            'year' => $this->yy,
            'month' => $this->mm,
            'content' => $result
        );


        $prefs['template'] = '
	{table_open}<table id="fc" class="calendar">{/table_open}
	{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
	{cal_cell_content}<date d="{day}" m="{month}" y="{year}"/><span class="day_listing">{day}</span><span class="day_content">{content}</span>{/cal_cell_content}
	{cal_cell_content_today}<date d="{day}" m="{month}" y="{year}"/><div class="today"><span class="day_listing">{day}</span><span class="day_content">{content}</span></div>{/cal_cell_content_today}
	{cal_cell_no_content}<date d="{day}" m="{month}" y="{year}"/><span class="day_listing">{day}</span>{/cal_cell_no_content}
	{cal_cell_no_content_today}<div class="today"><date d="{day}" m="{month}" y="{year}"/><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
        ';
        $prefs['day_type'] = 'short';
        $prefs['show_next_prev'] = true;
        $prefs['next_prev_url'] = base_url() . 'index.php/calendar/index';

// Loading calendar library and configuring table template
        $this->load->library('calendar', $prefs);

// Load view page

        if ($this->owner) {
            $data['user'] = "Owner : " . $this->user;
            $data['isUser'] = false;
        } else {
            $data['user'] = "User : " . $this->user;
            $data['isUser'] = true;
        }
        $this->load->view('calendar_view', $data);
    }

}

?>