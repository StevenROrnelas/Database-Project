<!doctype html>
<html>
<head>
    <title> Chart generation </title>
</head>
<body>
   <div id = "sales_visualization" style ="width: 1000px; height: 800px;"></div>
<?php
    require_once ('connect.php');

    $query = "select * from Orders order by DatePlaced";
    $result = mysqli_query($link, $query);

    $num_results = mysqli_num_rows($result);

    if ($num_results > 0)
    {
    ?>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>

        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
        </script>

        <script type="text/javascript">
            function drawVisualization()
            {
                var data = google.visualization.arrayToDataTable([
                    ['DatePlaced', 'Total'],
            <?php
            $yearsUsed = array();
            $arrCount = 0;
            while ($row = $result->fetch_assoc())
            {
                $echoDate = true;
                extract($row);
                $DatePlaced = date('Y', strtotime($DatePlaced));
                for ($i = 0; $i < $arrCount; $i++)
                {
                    if ($yearsUsed[$i][0] == $DatePlaced)
                    {
                        $yearsUsed[$i][1] += $Total;
                        $echoDate = false;
                        break ;
                    }
                }
                
                if ($echoDate == true)
                {
                    $yearsUsed[$arrCount] = array($DatePlaced, $Total);
                    $arrCount++;
                }

            }
                for ($i = 0; $i < $arrCount; $i++)
                {
                    echo "['{$yearsUsed[$i][0]}', {$yearsUsed[$i][1]}],";
                }
            ?>
            ]);

            new google.visualization.ColumnChart(document.getElementById('sales_visualization')).
            draw(data, {title:"Total sales by year"});
            }

            google.setOnLoadCallback(drawVisualization);
        </script>
<?php
    }
    else
    {
        echo "No Orders in the db";
    }
?>

</body>
</html>
