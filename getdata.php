<!DOCTYPE html>
<html>
<head>
</head>

<body>

<?php
require_once ('lib.php');
require_once ('utils.php');
require_once ('connect.php');

$table = ($_GET['str']);
$sql = "SELECT * FROM $table";
$result = mysqli_query($link, "SHOW COLUMNS FROM $table");

echo "<table class='responstable'>";
echo "<tr>";
while ($row = mysqli_fetch_assoc($result))
{
    echo "<th>";
    echo $row['Field'];
    echo "</th>";
}

echo "</tr>";

$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_row ($result))
{
    echo "<tr>";
    foreach ($row as $key => $value)
    {
        echo "<td>";
        echo $value;
        echo "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>
