<div class="buttons" style="text-align:center;">
<?php
echo '<p>';
if ($this->ion_auth->is_admin()) {
    echo ' <a href="' . site_url("auth") . '" class="btn btn-primary btn-md" role="button">Admin</a>';
} else {
    echo ' <a href="' . site_url("auth/edit_user") . '" class="btn btn-primary btn-md" role="button">Change details</a>';
}
echo ' <a href="' . site_url("") . '" class="btn btn-primary btn-md" role="button">Show calendar</a>';
echo ' <a href="' . site_url("calendar/reset") . '" onClick="return doconfirm();" class="btn btn-primary btn-md" role="button">Reset</a>';
echo ' <a href="' . site_url("auth/logout") . '" class="btn btn-primary btn-md" role="button">Log out</a>';
echo '</div>'
?>
</div>
<div class="copyright" style="text-align:center;">
    <I>Copyright F Cusmano 2016, Donate a beer to keep me programming.</i>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
               ">
        <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
    </form>
</div>
