<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends CI_Controller {

    var $yy;
    var $mm;
    var $dd;
    var $user;
    var $bay;
    var $isOwner;

    public function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->get_user();
        if (empty($this->user)) {
            redirect('auth/login');
            return;
        }
        $this->bay = $this->ion_auth->get_bay();
        $this->isOwner = !empty($this->bay);
    }

    private function T2($vv) {
        return substr('00' . $vv, -2);
    }

    public function fullDate() {
        return $this->yy . "-" . $this->T2($this->mm) . "-" . $this->T2($this->dd);
    }

    public function partDate() {
        return $this->yy . "-" . $this->T2($this->mm) . "-";
    }

    public function do_user() {
        $this->Freepark_model->reserve_available_date($this->user, $this->fullDate());
    }

    public function all() {

        if ($this->ion_auth->is_admin()) {
            $data['user'] = "Admin : " . $this->user;
            $data["table"] = $this->Freepark_model->do_list_all();
        } else {
            if ($this->isOwner) {
                $data['user'] = "Owner : " . $this->user;
                $data['isUser'] = false;
                $data["table"] = $this->Freepark_model->do_list_owner($this->user);
            } else {
                $data['user'] = "User : " . $this->user;
                $data['isUser'] = true;
                $data["table"] = $this->Freepark_model->do_list_user($this->user);
            }
        }

        $this->load->view('calendar_list', $data);
    }

    public function do_owner() {
        $result = $this->Freepark_model->get_entries_for_owner($this->user, $this->partDate());
        if (array_key_exists($this->dd, $result)) {
            $this->Freepark_model->do_release_for_owner($this->user, $this->fullDate());
        } else {
            $this->Freepark_model->do_free_for_owner($this->user, $this->fullDate(), $this->bay);
        }
    }

    public function reset() {

        redirect("Welcome");
    }

    public function index() {

        if ($this->uri->segment(5)) {
            //we have an update
            $this->yy = $this->uri->segment(3);
            $this->mm = $this->uri->segment(5);
            $this->dd = $this->uri->segment(6);

            if ($this->isOwner) {
                $this->do_owner();
            } else {
                $this->do_user();
            }
        } else {
            $this->yy = $this->uri->segment(3);
            $this->mm = $this->uri->segment(4);
        }


        if ($this->isOwner) {
            $res = $this->Freepark_model->get_entries_for_owner($this->user, $this->partDate());
            $req = $this->Freepark_model->get_requested_dates($this->partDate());
            //make sure req is first so overwritten by owner allocated.
            $result = $res + $req;
        } else {
            $result = $this->Freepark_model->get_entries_for_month($this->user, $this->partDate());
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
	{cal_cell_content_today}<date d="{day}" m="{month}" y="{year}"/><span class="day_listing">TODAY</span><span class="day_content">{content}</span>{/cal_cell_content_today}
	{cal_cell_no_content}<date d="{day}" m="{month}" y="{year}"/><span class="day_listing">{day}</span>{/cal_cell_no_content}
	{cal_cell_no_content_today}<date d="{day}" m="{month}" y="{year}"/><span class="day_listing">TODAY</span>{/cal_cell_no_content_today}';
        $prefs['day_type'] = 'short';
        $prefs['show_next_prev'] = true;
        $prefs['next_prev_url'] = base_url() . 'index.php/calendar/index';

// Loading calendar library and configuring table template
        $this->load->library('calendar', $prefs);

// Load view page
        if ($this->isOwner) {
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
