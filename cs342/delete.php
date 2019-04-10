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
    <title>Delete data </title>
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
    <option value="Employee">Delete from Employee table</option>
    <option value="Customer">Delete from Customer table </option>
    <option value="Item">Delete from Item table </option>
    <option value="Location">Delete from Location table </option>
    <option value="LocationCustomer">Delete from LocationCustomer table </option>
    <option value="LocationItems">Delete from LocationItems table </option>
    <option value="Orders">Delete from Orders table </option>
    <option value="OrderItems">Delete from OrderItems table </option>
    <option value="OrdersLocations">Delete from OrderLocations table </option>
    <option value="Supplier">Delete from Supplier table </option>
    <option value="SupplierItems">Delete from SupplierItems table </option>
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
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="Employee">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Customer" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="Customer">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Item" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="Item">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Location" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="Location">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "LocationCustomer" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="LocationCustomer">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "LocationItems" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="LocationItems">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Orders" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="Orders">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "OrderItems" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="OrderItems">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "OrdersLocations" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="OrdersLocations">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "Supplier" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="Supplier">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<div id = "SupplierItems" class = "inv">
<form action="delete.php" method="post">
<h3>Delete where</h3>
<div>
    <div class="details">
    <input type="text" name ="whereClause" class="textbox">
    </br>
    <input type="hidden" name="table" value="SupplierItems">
    <input type="submit" name="submit" value="Delete"/>
    </div>
</div>
<br/>
</form>
</div>

<form action="delete.php" method = "post">
<div id="txt"> </div>
</body>
</html>
