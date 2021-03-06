<?php session_start();
require_once('utils.php');
require_once('connect.php');

if (isset($_POST['submit']))
{ 
    $whereClause = $_POST['whereClause'];
    $table = $_POST['table'];
    $sql = "DELETE FROM $table WHERE $whereClause";
    $result = mysqli_query($link, $sql);

    if ($result != 0)
    {
        $_SESSION['update_submitted'] = true;
    }
    else
    {
        $error = mysqli_error($link);
        print_r($error);
        $message = "error querying database";
        echo "<script type='text/javascript'>
            alert('$message');
        </script>";
    }
}
?>

<html>
    <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>View data </title>
<style>
    .inv
    {
        display: none;
    }

    h3
    {
        text-align: center;
    }

    .textbox
    {
        width: 25%;
        text-align: center; 
    }

    #formWrapper
    {
        width: 500px;
        padding: 2em 0 2em 0;
        margin-top: 100px;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: auto;
    }
    
    .details
    {
        text-align: center;
    }
</style>
</head>
<body>
<div class="details">
<form action="delete.php" method = "post">
<select id="selection" name="table" onchange="showData(this.value)">
    <option></option>
    <option value="employee">View Employee table</option>
    <option value="customer">View Customer table </option>
    <option value="item">View Item table </option>
    <option value="location">View Location table </option>
    <option value="locationcustomer">View LocationCustomer table </option>
    <option value="locationitems">View LocationItems table </option>
    <option value="orders">View Orders table </option>
    <option value="orderitems">View OrderItems table </option>
    <option value="orderslocations">View OrderLocations table </option>
    <option value="supplier">View Supplier table </option>
    <option value="supplieritems">View SupplierItems table </option>
</select>
    </form>
</div>

<script>
function showData(str)
{
    if (str == "")
    {
        document.getElementById("txt").innerHTML = "";
    }
    else
    {
        if (window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        }
        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById("txt").innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET", "getdata.php?str="+str, true);
        xmlhttp.send();
    }
}

    document
        .getElementById('selection')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                selection = document.getElementById(this.value);

            if (vis !== null)
            {
                vis.className = 'inv';
            }
            if (selection !== null)
            {
                selection.className = 'vis';
            }

        });
</script>

<div id = "Employee" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Customer" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Item" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Location" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "LocationCustomer" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "LocationItems" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Orders" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "OrderItems" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "OrdersLocations" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Supplier" class = "inv">
<form action="delete.php" method="post">
<div>
    <div class="details">
    </br>
    </div>
</div>
<br/>
</form>
</div>

<div id = "SupplierItems" class = "inv">
<form action="delete.php" method="post">
<br/>
</form>
</div>

<form action="delete.php" method = "post">
<div id="txt"> </div>
</body>
</html>
