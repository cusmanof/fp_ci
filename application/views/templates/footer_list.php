<div class="buttons" style="text-align:center;">
    <?php
    echo '<p>';
    if ($this->ion_auth->is_admin()) {
        echo ' <a href="' . site_url("auth") . '" class="btn btn-primary btn-md" role="button">Admin</a>';
    } else {
    echo ' <a href="' . site_url("auth/edit_user") . '" class="btn btn-primary btn-md" role="button">Change details</a>';
    }
    echo ' <a href="' . site_url("calendar/all") . '" class="btn btn-primary btn-md" role="button">List allocations</a>';
    echo ' <a href="' . site_url("calendar/reset") . '" onClick="return doconfirm();" class="btn btn-primary btn-md" role="button">Reset</a>';
    echo ' <a href="' . site_url("auth/logout") . '" class="btn btn-primary btn-md" role="button">Log out</a>';
    echo '</div>'
    ?>
    <br>
</div> 
<div class="copyright" style="text-align:center;">
    <I>Copyright F Cusmano 2015.</I>
</div>

