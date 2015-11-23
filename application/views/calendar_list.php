<!DOCTYPE html>

<html>
    <?php $this->load->view('templates/header'); ?> 
    <style class="ftable"  type="text/css">
        table { 
            margin-left:auto; 
            margin-right:auto;
            text-align: center;
            color: #333; /* Lighten up font color */
            font-family: Helvetica, Arial, sans-serif; /* Nicer font */
            font-size: large;
            width: 640px; 
            border-collapse: collapse; 
            border-spacing: 0; 

        }

        td, th { border: 1px solid #CCC; height: 30px;} /* Make cells a bit taller */

        th {
            background: #F3F3F3; /* Light grey background */
            font-weight: bold; /* Make sure they're bold */
            text-align: center; /* Center our text */
        }

        td {
            background: #FAFAFA; /* Lighter grey background */
            text-align: center; /* Center our text */
        }
    </style>


    <?php
    echo '<H1 align="center">' . $user . '</H1>';
    echo '<div style="text-align:center;">';
    echo $table;
    echo '</div>';
    ?>
    <BR>
    <?php $this->load->view('templates/footer'); ?> 

</body>
</html>