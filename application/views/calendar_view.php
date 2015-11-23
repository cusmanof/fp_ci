<!DOCTYPE html>
<html>
    <?php $this->load->view('templates/header'); ?> 
    <?php
    echo '<H1 align="center">' . $user . '</H1>';
    //flash data
    if (!empty($this->session->flashdata('error'))) {
        echo '<div class="alert alert-warning">  <strong>Warning!</strong>';
        echo $this->session->flashdata('error');
        echo '</div>';
    }
    // Generate calendar
    $tt = str_replace('{base_url}', base_url(), $this->calendar->generate($year, $month, $content));
    $tt = str_replace('{year}', $year, $tt);
    $tt = str_replace('{month}', $month, $tt);
    echo $tt . "<BR>";
    //flash data
    if (!empty($this->session->flashdata('error'))) {
        echo '<div class="alert alert-warning">  <strong>Warning!</strong>';
        echo $this->session->flashdata('error');
        echo '</div>';
    }
    if ($this->ion_auth->is_admin()) {
        echo ' <a href="' . site_url("auth") . '" class="btn btn-info" role="button">Admin</a>';
        echo ' <a href="' . site_url("calendar/all") . '" class="btn btn-info" role="button">List allocations</a>';
    } else {
        echo ' <a href="' . site_url("auth/change_password") . '" class="btn btn-info" role="button">Change password</a>';
    }
    echo ' <a href="' . site_url("calendar/reset") . '" onClick="return doconfirm();" class="btn btn-info" role="button">Reset</a>';
    echo ' <a href="' . site_url("auth/logout") . '" class="btn btn-info" role="button">Log out</a>';
    ?>
    <BR>
    <?php $this->load->view('templates/footer'); ?> 

</body>
</html>