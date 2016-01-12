<?php $this->load->view('templates/header'); ?> 

<span class="text-center">

    <h1><?php echo lang('login_heading'); ?></h1>

    <p><?php echo lang('login_subheading'); ?></p>


    <div id="infoMessage"><?php echo $message; ?></div>

    <?php echo form_open("auth/login"); ?>

    <p>
        <?php echo lang('login_identity_label', 'identity'); ?>
        <?php echo form_input($identity); ?>
    </p>

    <p>
        <?php echo lang('login_password_label', 'password'); ?>
        <?php echo form_input($password); ?>
    </p>

    <p>
        <?php echo lang('login_remember_label', 'remember'); ?>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
    </p>


    <p><?php echo form_submit('submit', lang('login_submit_btn')); ?></p>
    <?php echo form_close(); ?>
   
    <p>
        If you would like an account, send details to 
        <?php
        echo mailto('frank.cusmano@thalesgroup.com.au;erik.sauter@thalesgroup.com.au?subject=Free Park account request.'
                . '&body=Please create an account for me'
                . ', use email address: ------', 'Frank');
        ?>
        OR 
        <?php
        echo mailto('erik.sauter@thalesgroup.com.au;frank.cusmano@thalesgroup.com.au?subject=Free Park account request.'
                . '&body=Please create an account for me'
                . ', use email address: ------', 'Erik');
        ?> 

    </p>
    <p>
       <?php echo '<a href="' . site_url("calendar/brief") . '" class="btn btn-default btn-md" role="button">View free days</a>' ?>
    </p>
</span>

<?php $this->load->view('templates/footer'); ?> 
