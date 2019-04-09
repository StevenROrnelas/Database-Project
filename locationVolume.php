<!doctype html>
<html>
<head>
    <title> Chart generation </title>
</head>
<body>
   <div id = "visualization" style ="width: 1000px; height: 550px;"></div>
<?php
    require_once ('connect.php');

    $query = "select * from OrdersLocations order by LocationID";
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
                    ['LocationID', 'Total'],
            <?php
            $locationUsed = array();
            $arrCount = 0;
            while ($row = $result->fetch_assoc())
            {
                $echoData = true;
                extract($row);
                for ($i = 0; $i < $arrCount; $i++)
                {
                    if ($locationUsed[$i][0] == $LocationID)
                    {
                        $locationUsed[$i][1] += 1;
                        $echoData = false;
                        break;
                    }
                }
                
                if ($echoData == true)
                {
                    $locationUsed[$arrCount] = array($LocationID, 1);
                    $arrCount++;
                }
            }

            for ($i = 0; $i < $arrCount; $i++)
            {
                echo "['{$locationUsed[$i][0]}', {$locationUsed[$i][1]}],";
            }
            
            ?>
            ]);

            new google.visualization.PieChart(
                document.getElementById('visualization')).
            draw(data, {title:"Orders fulfilled by each location"});
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
