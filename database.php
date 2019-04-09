<?php session_start();
require_once ('lib.php');
require_once ('utils.php');
require_once ('connect.php');

function query(mysqli $link) {
    $table = mysqli_real_escape_string ($link, $_POST['table']);
    $_SESSION['table'] = $table;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($link, $sql);
  
    if ($result && mysqli_num_rows($result) != 0)
        $_SESSION['query_submitted'] = true;
     else {
        $message = "error querying database";
        echo "<script type = 'text/javascript'>
                alert('$message');
              </script>";
    }
 
}

if (isset($_POST['submit'])) {
    query($link);
}

?>

<!-- If a query was submitted -->
<?php if ($_SESSION['query_submitted']) { ?>
<html>
    <head>
        <title> Database access </title>
    </head>

    <body>
        <div id = 'wrapper'>
        <div id = 'header'>
            <?php include_once 'header.php' ?>
        </div>
        
        <div id = 'left' >
            <?php include_once 'left.php' ?>
        </div>

        <div id = 'main'>
            <p> <form action = "database.php" method = "post">
                    <select name = "table">
                        <option value="Customer">Customer</option>
                        <option value="Employee">Employee</option>
                        <option value="Item">Item</option>
                        <option value="Location">Location</option>
                        <option value="LocationCustomer">LocationCustomer</option>
                        <option value="LocationItems">LocationItems</option>
                        <option value="Orders">Orders</option>
                        <option value="OrderItems">OrderItems</option>
                        <option value="OrdersLocations">OrdersLocation</option>
                        <option value="Supplier">Supplier</option>
                        <option value="SupplierItems">SupplierItems</option>
                    </select><input name = "submit" type = "submit" value = "Query"/>
                </form>
            </p>
            <h3> Query Results </h3>
            <hr />

            <table class="responstable">
<?php
                $table = $_SESSION['table'];
                $result = mysqli_query($link, "SHOW COLUMNS FROM $table");
                echo "<tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<th>";
                    echo $row['Field'];
                    echo "</th>";
                }
                echo "</tr>";
              
                $sql = "SELECT * FROM $table";
                $result = mysqli_query($link, $sql);

                $i = 0;
                $file = fopen("insert$table.sql", "w");
                while ($row = mysqli_fetch_row ($result)) {
                    echo '<tr>';
                    foreach ($row as $key => $value) {
                            echo "<td>";
                            echo $value;
                            echo "</td>";

                            if (strpos($value, '-') == true)
                                $value = date("d-M-Y", strtotime($value));
                            if(!$value)
                                $value = "NULL";
                            if ($i == 0)
                                $text = "INSERT INTO SM$table VALUES ('$value'";
                            else
                                $text .= ", '$value'";
                            $i++;
                    } 
                    $text .= ");\n";
//                    fwrite($file, $text);
                    unset ($i);
                    echo '</tr>';
                }  ?>
            </table> <br>


    
        </div>
        </div>
    </body>
</html> 

<?php
}
//No query yet
else {?>
<html>
    <head>
        <title> Database access </title>
    </head>
<body>
<div id = 'wrapper'>
    <div id = 'header'>
        <?php include_once 'header.php' ?>
    </div>
    <div id = 'left'>
        <?php include_once 'left.php' ?>
    </div>
    <div id = 'main'>

<!--        <form action = "database.php" method = "post">
            Enter the table you wish to query: <input name = "table" type = "text" />
        <input name = "submit" type = "submit" value = "Query" />
-->
            <p> <form action = "database.php" method = "post">
                    <select name = "table">
                        <option value="Customer">Customer</option>
                        <option value="Employee">Employee</option>
                        <option value="Item">Item</option>
                        <option value="Location">Location</option>
                        <option value="LocationCustomer">LocationCustomer</option>
                        <option value="LocationItems">LocationItems</option>
                        <option value="Orders">Orders</option>
                        <option value="OrderItems">OrderItems</option>
                        <option value="OrdersLocations">OrdersLocation</option>
                        <option value="Supplier">Supplier</option>
                        <option value="SupplierItems">SupplierItems</option>
                    </select><input name = "submit" type = "submit" value = "Query"/>
</form>
</div>
</body>
</html>

<?php 
}

if (isset($_POST['newQuery'])) {
    $_SESSION['query_submitted'] = false;
    header("location: database.php");
}
?>
