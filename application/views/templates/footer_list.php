<div class="buttons" style="text-align:center;">
    <?php
    echo '<p>';
    if ($this->ion_auth->is_admin()) {
        echo ' <a href="' . site_url("auth") . '" class="btn btn-primary btn-md" role="button">Admin</a>';
    } else {
        echo ' <a href="' . site_url("auth/edit_user") . '" class="btn btn-primary btn-md" role="button">Change details</a>';
    }
    echo ' <a href="' . site_url("year") . '" class="btn btn-primary btn-md" role="button">Show Free</a>';
    echo ' <a href="' . site_url("calendar/all") . '" class="btn btn-primary btn-md" role="button">List allocations</a>';
    echo ' <a href="' . site_url("calendar/reset") . '" onClick="return doconfirm();" class="btn btn-primary btn-md" role="button">Reset</a>';
    if (!$isUser) {
//            echo ' <a href="' . site_url("") . '" onClick="showRange();" class="btn btn-primary btn-md" role="button" name="daterange">Range</a>';

        echo ' <button  id="myBtn" onClick="showRange();" class="btn btn-primary btn-md" >Range</button>';
    }
    echo ' <a href="' . site_url("auth/logout") . '" class="btn btn-primary btn-md" role="button">Log out</a>';
    echo '</div>'
    ?>

    <br>
</div> 

<script type="text/javascript">

    function showRange() {
        $('#drp').data('daterangepicker').toggle();
    }
    $(function () {
        var start = moment();

        $('input[name="daterangepicker"]').daterangepicker(
            {
                locale: {
                  format: 'YYYY-MM-DD'
                },
                minDate: start,
            }, 
            function(start, end, label) {
                   var xhttp = new XMLHttpRequest();
                    xhttp.open("GET", "range" + start.format('/YYYY/MM/DD')+ end.format('/YYYY/MM/DD') , false);
                    xhttp.send();
                    window.location.reload();
            });
    });
</script>
<div class="copyright" style="text-align:center;">
    <I>Copyright F Cusmano 2016.</I>
</div>

