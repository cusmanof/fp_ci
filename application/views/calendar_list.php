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
        @media only screen and (max-device-width: 480px) {
            p {
                font-size: 48px;
            }
            h1 {
                font-size: 56px;  
            }
            table { 
                margin-left:auto; 
                margin-right:auto;
                text-align: center;
                color: #333; /* Lighten up font color */
                font-family: Helvetica, Arial, sans-serif; /* Nicer font */
                font-size: 38px;
                border-collapse: collapse; 
                width: 90%; 
                border-spacing: 0; 

            }

            td, th { border: 1px solid #CCC; height: 30px;} /* Make cells a bit taller */

            th {
                background: #F3F3F3; /* Light grey background */
                font-weight: bold; /* Make sure they're bold */
                text-align: center; /* Center our text */
                 font-size: 38px;
            }

            td {
                background: #FAFAFA; /* Lighter grey background */
                text-align: center; /* Center our text */
                 font-size: 38px;
            }

            .copyright {
                font-family: Arial, Verdana, Sans-serif;
                font-size: 30px;  
                text-align: center;
            }
            .btn-md {
                padding:2px 4px;
                font-size:90%;
                line-height: 2;
            }
            .panel-heading {
                font-family: Arial, Verdana, Sans-serif;
                font-size: 24px;  
                text-align: center;
            }
            .alert-warning {
                font-family: Arial, Verdana, Sans-serif;
                font-size: 20px;  
                text-align: center;
            }
            .calendar {
                font-family: Arial, Verdana, Sans-serif;
                font-size: 38px;
                width: 100%;
                height: 100%
            }

            .calendar tbody tr:first-child th {
                color: #505050;
                text-align: center;
                margin: 0 0 10px 0;
            }

            .day_header {
                font-weight: normal;
                text-align: center;
                color: #757575;
                font-size: 42px;
            }

            .calendar td {
                width: 14%; /* Force all cells to be about the same width regardless of content */
                cursor: pointer;
                border:1px solid #CCC;
                height: 140px;
                min-height: 100px;
                vertical-align: top;
                font-size: 38px;
                padding: 0;
            }

            .calendar td:hover {
                background: #F3F3F3;
            }

            .day_listing {
                display: block;
                text-align: right;
                font-size: 38px;
                color: #2C2C2C;
                padding: 5px 5px 0 0;
            }
            .day_content {
                display: block;
                text-align: center;
                font-size: 38px;
                color: #2C2C2C;
                background: #F3F3F3;
                padding: 5px 5px 0 0;
            }
            div.today {
                background: #E9EFF7;
                height: 100%;
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