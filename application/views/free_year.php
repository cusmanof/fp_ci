<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Free days</title>
        <meta http-equiv='Content-type' content='text/html; charset=UTF-8' >
        <style type="text/css"> 
            table {
                border:0; 
                text-align: center;
                font-size:8pt; 
                font-family:Verdana;
            }
            th {align: center; 
                font-size:12pt;
                font-family:Arial;
                color:#666699;
            }
            .free {
                font-size:8pt;
                font-family:Verdana;
                background:#00ff00;
            }
            .day {          
                text-align: center;
                font-weight: bold;
                color:#666666;
            }
            .dayW {          
                text-align: center;
                font-weight: bold;
                color:#0000cc;
            }
            .dayd {          
                text-align: center;
                color:#666666;
            }
            .dayWd {          
                text-align: center;
                color:#0000cc;
            }
            @media only screen and (max-device-width: 480px) {
                table {
                    border:0; 
                    text-align: center;
                    font-size:32px; 
                    font-family:Verdana;
                }
                p {
                    font-size: 40px;
                }
                h1 {
                    font-size: 56px;  
                }
                .btn-md {
                    padding:2px 4px;
                    font-size:90%;
                    line-height: 2;
                }
                .free {
                    font-size:32px; 
                    font-family:Verdana;
                    background:#00ff00;
                }
                .day {
                    font-size:32px; 
                    text-align: center;
                    font-weight: bold;
                    color:#666666;
                }
                .dayW {   
                    font-size:32px; 
                    text-align: center;
                    font-weight: bold;
                    color:#0000cc;
                }
                .dayd {          
                    text-align: center;
                    color:#666666;
                }
                .dayWd {  
                    font-size:32px; 
                    text-align: center;
                    color:#0000cc;
                }
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('templates/header'); ?> 
        <div align="center">
            <h1>Free days for <?php echo $year ?> </h1>

            <?php
            $mm = date('n');
            $yy = date('Y');
            $dd = date('d');
            $monate = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

            echo '<table border=0 width=700>';

            for ($reihe = 1; $reihe <= 3; $reihe++) {
                echo '<tr>';
                for ($spalte = 1; $spalte <= 4; $spalte++) {
                    $this_month = ($reihe - 1) * 4 + $spalte;
                    $day_of_week = date('w', mktime(0, 0, 0, $this_month, 1, $yy));
                    $days_in_month = date('t', mktime(0, 0, 0, $this_month, 1, $yy));
                    if ($day_of_week == 0)
                        $day_of_week = 7;
                    echo '<td width="25%" valign=top>';
                    echo '<table>';
                    echo '<th colspan=7 ">' . $monate[$this_month - 1] . '</th>';
                    echo '<tr><td class="day">Mo</td>';
                    echo '<td class="day">Tu</td>';
                    echo '<td class="day">We</td>';
                    echo '<td class="day">Th</td>';
                    echo '<td class="day">Fr</td>';
                    echo '<td class="dayW">Sa</td>';
                    echo '<td class="dayW">Su</td>';
                    echo '<tr><br>';
                    $i = 1;
                    while ($i < $day_of_week) {
                        echo '<td> </td>';
                        $i++;
                    }
                    $i = 1;
                    while ($i <= $days_in_month) {
                        $ddmmyy = date('Y-m-d', mktime(0, 0, 0, $this_month, $i, $yy));
                        $rest = ($i + $day_of_week - 1) % 7;
                        if (in_array($ddmmyy, $free_days)) {
                            echo '<td class="free" align=center>';
                        } else {
                            echo '<td style="font-size:8pt; font-family:Verdana" align=center>';
                        }
                        if (($i == $dd) && ($this_month == $mm)) {
                            echo '<span class="dayd">' . $i . '</span>';
                        } else if ($rest == 6 || $rest == 0) {
                            echo '<span class="dayWd">' . $i . '</span>';
                        } else {
                            echo $i;
                        }
                        echo "</td>\n";
                        if ($rest == 0)
                            echo "</tr>\n<tr>\n";
                        $i++;
                    }
                    echo '</tr>';
                    echo '</table>';
                    echo '</td>';
                }
                echo '</tr>';
            }

            echo '</table>';
            ?> 
            <BR>
            <?php $this->load->view('templates/footer_free'); ?> 
            </body>
