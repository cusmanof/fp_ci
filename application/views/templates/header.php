
<head>
    <title>Free Park</title>
    <style type="text/css">
        .calendar {
            font-family: Arial, Verdana, Sans-serif;
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
            font-size: 10px;
        }

        .calendar td {
            width: 14%; /* Force all cells to be about the same width regardless of content */
            cursor: pointer;
            border:1px solid #CCC;
            height: 70px;
            min-height: 50px;
            vertical-align: top;
            font-size: 10px;
            padding: 0;
        }

        .calendar td:hover {
            background: #F3F3F3;
        }

        .day_listing {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #2C2C2C;
            padding: 5px 5px 0 0;
        }
        .day_content {
            display: block;
            text-align: center;
            font-size: 16px;
            color: #2C2C2C;
            background: #F3F3F3;
            padding: 5px 5px 0 0;
        }
        div.today {
            background: #E9EFF7;
            height: 100%;
        }
      
    </style>
    <script type="text/javascript">
        function doconfirm()
        {
            job = confirm("Are you sure to remove your entries?");
            if (job != true)
            {
                return false;
            }
        }
        function tableText(tableCell) {
            for (var i = 0; i < tableCell.childNodes.length; i++) {
                var node = tableCell.childNodes[i];
                if (node.tagName === 'DATE') {
                    var d = node.getAttribute('d');
                    var m = node.getAttribute('m');
                    var y = node.getAttribute('y');
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("GET", "update/" + m + "/" + d, false);
                    xhttp.send();
                    window.location.reload();
                }
            }

        }
        function afterTableLoad() {
            var table = document.getElementById("fc");
            if (table != null) {
                for (var i = 0; i < table.rows.length; i++) {
                    for (var j = 0; j < table.rows[i].cells.length; j++)
                        table.rows[i].cells[j].onclick = function () {
                            tableText(this);
                        };
                }
            }
        }
        window.onload = afterTableLoad;
    </script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="panel panel-default">
        <div class="panel-heading">Free Park brought to you by Frank Cusmano at his own expense.</div>
    </div>    
