<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freepark_model extends CI_Model {

    var $title = '';
    var $content = '';
    var $date = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        //delete everything before today.
        $q = "DELETE FROM freedays_tbl WHERE free_date < CURDATE()";
        $query = $this->db->query($q);
    }

    function get_entries_for_owner($user, $yymm) {
        $result = array();
        $q = "SELECT * FROM freedays_tbl WHERE free_date LIKE '" . $yymm . "%' AND owner = '" . $user . "'";
        $query = $this->db->query($q);
        foreach ($query->result_array() as $row) {
            $dd = new DateTime($row['free_date']);
            if (empty($row['userId'])) {
                $result[$dd->format('j')] = "Free";
            } else {
                $result[$dd->format('j')] = $row['userId'];
            }
        }
        return $result;
    }
     function get_entries_for_month($user,$yymm) {
        $result = array();
        $q = "SELECT * FROM freedays_tbl WHERE free_date LIKE '" . $yymm . "%'";
        $query = $this->db->query($q);
        foreach ($query->result_array() as $row) {
            $dd = new DateTime($row['free_date']);
            if (empty($row['userId'])) {
                $result[$dd->format('j')] = "Available";
            } else if ($user == $row['userId']) {
                $result[$dd->format('j')] = $row['userId'];
            }
        }
        return $result;
    }

    function get_requested_dates($yymm) {
        $result = array();
        $q = "SELECT * FROM freedays_tbl WHERE free_date LIKE '" . $yymm . "%' AND owner = '' and userId !=''";
        $query = $this->db->query($q);
        foreach ($query->result_array() as $row) {
             $dd = new DateTime($row['free_date']);
            $result[$dd->format('j')] = "***";
        }
        return $result;
    }

    function do_release_for_owner($user, $dd) {
        $q = "DELETE FROM freedays_tbl  WHERE free_date = '" . $dd . "' AND owner = '" . $user . "' AND userId=''";
        file_put_contents("c:\\temp\\zd.txt", $q);
        $this->db->query($q);
    }

    function do_free_for_owner($user, $dd) {
        $q = "INSERT INTO freedays_tbl (owner, parkId, free_date) VALUES ('$user','123','$dd');";
        file_put_contents("c:\\temp\\zi.txt", $q);
        $this->db->query($q);
    }

//    function insert_entry()
//    {
//        $this->title   = $_POST['title']; // please read the below note
//        $this->content = $_POST['content'];
//        $this->date    = time();
//
//        $this->db->insert('entries', $this);
//    }
//
//    function update_entry()
//    {
//        $this->title   = $_POST['title'];
//        $this->content = $_POST['content'];
//        $this->date    = time();
//
//        $this->db->update('entries', $this, array('id' => $_POST['id']));
//    }
}

?>