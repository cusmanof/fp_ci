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
        //delete everything before today  and any funny entries.
        $q = "DELETE FROM freedays_tbl WHERE free_date < CURDATE() OR (owner='' AND userId='')";
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

    function get_entries_for_month($user, $yymm) {
        $result = array();
        $q = "SELECT * FROM freedays_tbl WHERE free_date LIKE '" . $yymm . "%'";
        $query = $this->db->query($q);
        foreach ($query->result_array() as $row) {
            $dd = new DateTime($row['free_date']);
            if (empty($row['userId']) && !isset($result[$dd->format('j')])) {
                $result[$dd->format('j')] = '<span style="color:green"><B></I>Available</B></I></span>';
            } else if ($user == $row['userId']) {
                if (!empty($row['owner'])) {
                    $res = 'park in <span style="color:#6495ED">' . $row['parkId'] . '</span><BR>' . $row['owner'];
                } else {
                    $res = '<span style="color:#D2691E">Requested</span>';
                }
                $result[$dd->format('j')] = $res;
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
            $result[$dd->format('j')] = "Requested";
        }
        return $result;
    }

    function reserve_available_date($user, $yymmdd) {
        if (empty($user))
            return;
        //remove any request
        $q = "DELETE FROM freedays_tbl WHERE free_date = '" . $yymmdd . "' AND owner = '' AND userId= '" . $user . "'";
        $this->db->query($q);
        if ($this->db->affected_rows() <> 0) {
            return;
        }
        //remove if alloacted
        $q = "UPDATE freedays_tbl SET userId='' WHERE free_date = '" . $yymmdd . "' AND userId = '" . $user . "'";
        $this->db->query($q);
        if ($this->db->affected_rows() <> 0) {
            //released, see if anybody else wants this slot.
            $q = "SELECT * FROM freedays_tbl WHERE free_date = '" . $yymmdd . "' AND userId = '' AND owner <> '' LIMIT 1";
            $query = $this->db->query($q);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $owner = $row->owner;
                $bay = $row->parkId;
                //easiest way is to release/then make free for owner
                $this->do_release_for_owner($owner, $yymmdd);
                $this->do_free_for_owner($owner, $yymmdd, $bay);
            }
            return;
        }
         $q = "SELECT * FROM freedays_tbl WHERE userId = '" . $user . "'";
         $query = $this->db->query($q);
         if ($query->num_rows() > 7) {
            $message = " Sorry, you cannot reserve more than 7 bays in advance." .
                    "Buy Frank a beer and he might increase your limit.";
            $this->session->set_flashdata('error', $message);
             return;
         }
        //allocate if one avail
        $q = "UPDATE freedays_tbl SET userId='" . $user . "' WHERE free_date = '" . $yymmdd . "' AND userId = '' LIMIT 1";
        $this->db->query($q);
        if ($this->db->affected_rows() <> 0) {
            return;
        }
        //Ok reserve it
        $q = "INSERT INTO freedays_tbl (userId, free_date) VALUES ('$user','$yymmdd');";
        $this->db->query($q);
    }

    function do_release_for_owner($owner, $dd) {
        $q = "DELETE FROM freedays_tbl  WHERE free_date = '" . $dd . "' AND owner = '" . $owner . "' AND userId=''";
        $this->db->query($q);
    }

    function do_free_for_owner($owner, $yymmdd, $bay) {
        if (empty($owner))
            return;
        //see if somebody has requested that date
        $q = "UPDATE freedays_tbl SET owner='" . $owner . "', parkId='" . $bay . "' WHERE  owner=''  and userId !='' and free_date LIKE '" . $yymmdd . "%' LIMIT 1";
        $this->db->query($q);
        if ($this->db->affected_rows() == 0) {
            $q = "INSERT INTO freedays_tbl (owner, parkId, free_date) VALUES ('$owner','$bay','$yymmdd');";
            $this->db->query($q);
        }
    }

    function do_reset($user, $isOwner) {
        if ($isOwner) {
            $q = "DELETE FROM freedays_tbl WHERE owner = '" . $user . "' AND userId=''";
        } else {
            $q = "UPDATE freedays_tbl SET userId='' WHERE  userId='" . $user . "'";
        }
        $this->db->query($q);
    }

}

?>