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
    echo $tt;
    //flash data
    echo '<p>';
    if (!empty($this->session->flashdata('error'))) {
        echo '<div class="alert alert-warning">  <strong>Warning!</strong>';
        echo $this->session->flashdata('error');
        echo '</div>';
    }
    ?>
    <BR>
    <?php $this->load->view('templates/footer_list'); ?> 

</body>
</html>