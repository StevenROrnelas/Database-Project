<?php session_start();
require_once('utils.php');
require_once('connect.php');

if (isset($_POST['submit']))
{
    $table = mysqli_real_escape_string ($link, $_POST['table']);
    $table = $_POST['table'];
    $_SESSION['table'] = $table;
    $columns;
    $values;
    switch ($table)
    {
        case "Employee":
            $columns = "ID, Name, Salary, Position, SSN, DoB, LocationID, SDate, EDate, ManagersID, ManagersSDate, ManagersEDate";
            $employeeID = mysqli_real_escape_string ($link, $_POST['employeeID']);
            $employeeName = mysqli_real_escape_string ($link, $_POST['employeeName']);
            $employeeName = stripslashes($employeeName);
            $employeeSalary = mysqli_real_escape_string ($link, $_POST['employeeSalary']);
            $employeePosition = mysqli_real_escape_string ($link, $_POST['employeePosition']);
            $employeePosition = stripslashes($employeePosition);
            $employeeSSN = mysqli_real_escape_string ($link, $_POST['employeeSSN']);
            $employeeDoB = mysqli_real_escape_string ($link, $_POST['employeeDoB']);
            $employeeLocationID = mysqli_real_escape_string ($link, $_POST['employeeLocationID']);
            $employeeSDate = mysqli_real_escape_string ($link, $_POST['employeeSDate']);
            $employeeSDate = stripslashes($employeeSDate); 
            $employeeEDate = mysqli_real_escape_string ($link, $_POST['employeeEDate']);
            $employeeEDate = stripslashes($employeeEDate);
            $employeeManagersID = mysqli_real_escape_string ($link, $_POST['employeeManagersID']);
            $employeeManagerSDate = mysqli_real_escape_string ($link, $_POST['employeeManagerSDate']);
            $employeeManagerSDate = stripslashes($employeeManagerSDate);
            $employeeManagerEDate = mysqli_real_escape_string ($link, $_POST['employeeManagerEDate']);
            $employeeManagerEDate = stripslashes($employeeManagerEDate);

            $values = "$employeeID, '$employeeName', $employeeSalary, '$employeePosition', $employeeSSN, 
               $employeeDoB, $employeeLocationID, '$employeeSDate', '$employeeEDate', 
               $employeeManagersID, '$employeeManagerSDate', '$employeeManagerEDate'";
            break;

        case "Customer":
            $columns = "ID, Name, Phone, Address, Email";
            $customerID = mysqli_real_escape_string ($link, $_POST['customerID']);
            $customerName = mysqli_real_escape_string ($link, $_POST['customerName']);
            $customerName = stripslashes($customerName);
            $customerPhone = mysqli_real_escape_string($link, $_POST['customerPhone']);
            $customerPhone = stripslashes($customerPhone);
            $customerAddress = mysqli_real_escape_string($_POST['customerAddress']);
            $customerAddress = stripslashes($customerAddress);
            $customerEmail = mysqli_real_escape_string($link, $_POST['customerEmail']);
            $customerEmail = stripslashes($customerEmail);

            $values = "$customerId, '$customerName', '$customerPhone', '$customerAddress', '$customerEmail'";
            break;

        case "Location":
            $columns = "ID, NumEmployees, Manager, Address, Phone, Email";
            $locationID = mysqli_real_escape_string ($link, $_POST['locationID']);
            $locationEmployees = mysqli_real_escape_string ($link, $_POST['locationEmployees']);
            $locationManager = mysqli_real_escape_string ($link, $_POST['locationManager']);
            $locationAddress = mysqli_real_escape_string ($link, $_POST['locationAddress']);
            $locationAddress = stripslashes($locationAddress);
            $locationPhone = mysqli_real_escape_string ($link, $_POST['locationPhone']);
            $locationPhone = stripslashes($locationPhone);
            $locationEmail = mysqli_real_escape_string ($link, $_POST['locationEmail']);
            $locationEmail = stripslashes($locationEmail);

            $values = "$locationID, $locationEmployees, $locationManager, '$locationAddress', '$locationPhone', '$locationEmail'";
            break;

        case "LocationCustomer":
            $columns = "LocationID, CustomerID, TrackingNumber, DateShipped";
            $locationcustomerLocationID = mysqli_real_escape_string ($link, $_POST['locationcustomerLocationID']);
            $locationcustomerCustomerID = mysqli_real_escape_string ($link, $_POST['locationcustomerCustomerID']);
            $locationcustomerTrackingNo = mysqli_real_escape_string ($link, $_POST['locationcustomerTrackingNo']);
            $locationcustomerDateShipped = mysqli_real_escape_string ($link, $_POST['locationcustomerDateShipped']);
            $locationcustomerDateShipped = stripslashes($locationcustomerDateShipped);

            $values = "($locationcustomerLocationID, $locationcustomerCustomerID, $locationcustomerTrackingNo, '$locationcustomerDateShipped')"; 
            break;

        case "LocationItems":
            $columns = "LocationID, ItemID, Amount";
            $locationitemLocationID = mysqli_real_escape_string ($link, $_POST['locationitemLocationID']);
            $locationitemItemID     = mysqli_real_escape_string ($link, $_POST['locationitemItemID']);
            $locationitemAmount     = mysqli_real_escape_string ($link, $_POST['locationitemAmount']);

            $values = "$locationitemLocationID, $locationitemItemID, $locationitemAmount";
            break;


        case "Orders":
            $columns = "ID, Total, Destination, ShippingMethod, CustomerID, DatePlaced, EmployeeID, DateFilled";
            $orderID = mysqli_real_escape_string ($link, $_POST['orderID']);
            $orderTotal = mysqli_real_escape_string ($link, $_POST['orderTotal']);
            $orderDestination = mysqli_real_escape_string ($link, $_POST['orderDestination']);
            $orderDestination = stripslashes($orderDestination);
            $orderShippingMethod = mysqli_real_escape_string ($link, $_POST['orderShippingMethod']);
            $orderShippingMethod = stripslashes($orderShippingMethod);
            $orderCustomerID = mysqli_real_escape_string ($link, $_POST['orderCustomerID']);
            $orderDatePlaced = mysqli_real_escape_string ($link, $_POST['orderDatePlaced']);
            $orderDatePlaced = stripslashes($orderDatePlaced);
            $orderEmployeeID = mysqli_real_escape_string ($link, $_POST['orderEmployeeID']);
            $orderDateFilled = mysqli_real_escape_string ($link, $_POST['orderDateFilled']);
            $orderDateFilled = stripslashes($orderDateFilled);
            $values = "$orderID, $orderTotal, '$orderDestination', '$orderShippingMethod', $orderCustomerID,
                       '$orderDatePlaced', $orderEmployeeID, '$orderDateFilled'";
            break;

        case "OrderItems":
            $columns = "OrderID, ItemID, Amount";
            $orderitemsOrderID = mysqli_real_escape_string ($link, $_POST['orderitemsOrderID']);
            $orderitemsItemID = mysqli_real_escape_string ($link, $_POST['orderitemsItemID']);
            $orderitemsAmount = mysqli_real_escape_string ($link, $_POST['orderitemsAmount']);
           
            $values = "$orderitemsOrderID, $orderitemsItemID, $orderitemsAmount";
            break;

        case "OrdersLocations":
            $columns = "OrderID, LocationID, Destination";
            $orderslocationsOrderID = mysqli_real_escape_string ($link, $_POST['orderslocationsOrderID']);
            $orderslocationsLocationID = mysqli_real_escape_string ($link, $_POST['orderslocationsLocationID']);
            $orderslocationsDestination = mysqli_real_escape_string ($link, $_POST['orderslocationsDestination']);
            $orderslocationsDestination = stripslashes($orderslocationsDestinaton);

            $values = "$orderslocationsOrderID, $orderslocationsLocationID, '$orderslocationsDestination'";
            break;

        case "Supplier":
            $columns = "Name, Phone, Address, Email";
            $supplierName = mysqli_real_escape_string ($link, $_POST['supplierName']);
            $supplierName = stripslashes($supplierName);
            $supplierPhone = mysqli_real_escape_string ($link, $_POST['supplierPhone']);
            $supplierPhone = stripslashes($supplierPhone);
            $supplierAddress = mysqli_real_escape_string ($link, $_POST['supplierAddress']);
            $supplierAddress = stripslashes($supplierAddress);
            $supplierEmail = mysqli_real_escape_string ($link, $_POST['supplierEmail']);
            $supplierEmail = stripslashes($supplierEmail);

            $values = "'$supplierName', '$supplierPhone', '$supplierAddress', '$supplierEmail'";
            break;

        case "SupplierItems":
            $columns = "Supplier, ItemID, SDate, EDate";

            $supplieritemsName = mysqli_real_escape_string ($link, $_POST['supplieritemsName']);
            $supplieritemsName = stripslashes($supplieritemsName);
            $supplieritemsItemID = mysqli_real_escape_string ($link, $_POST['supplieritemsItemID']);
            $supplieritemsSDate = mysqli_real_escape_string ($link, $_POST['supplieritemsSDate']);
            $supplieritemsSDate = stripslashes($supplieritemsSDate);
            $supplieritemsEDate = mysqli_real_escape_string ($link, $_POST['supplieritemsEDate']);
            $supplieritemsEDate = stripslashes($supplieritemsSDate);

            $values = "'$supplieritemsName', $supplieritemsItemID, '$supplieritemsSDate', '$supplieritemsEDate'";
            break;
    }

    $valuesArray = explode(',', $values);
    $columnsArray = explode(',', $columns);
    $whereClause = $_POST['whereClause'];
    print_r($valuesArray);
  //  print_r($columnsArray);

    echo "<br/>";
    $setString;
    for ($i = 0; $i < count($columnsArray); $i++)
    {
        $valuesArray[$i] = stripslashes($valuesArray[$i]);
        $valuesArray[$i] = str_replace("'", "", $valuesArray[$i]);
        $valuesArray[$i] = trim($valuesArray[$i]);
        if ($valuesArray[$i] == ' ' || $valuesArray[$i] == '(' || $valuesArray[$i] == ')')
            continue;
        if (empty($valuesArray[$i]))
            continue;
        print_r($valuesArray[$i]);
        echo "<br/>";
        if (!empty($setString))
            $setString .=", ";
        $setString .= "$columnsArray[$i] = $valuesArray[$i]";
    }

    print_r($setString);
    echo "<br/>";
    $sql = "UPDATE $table SET $setString WHERE $whereClause";
    $result = mysqli_query($link, $sql);

    if ($result != 0)
    {
        $_SESSION['update_submitted'] = true;
        unset($values);
        unset($columns);
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

    header("Location: updatedata.php");
}
?>

<html>
    <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>Update data </title>
<style>
    .inv{
        display: none;
}
    h3
    {
        text-align:center;
    }
    .mytextbox
    {
        width: 25%;
        text-align: center;
    }
    .mydetails
    {
        text-align: center;
    }

</style>
</head>
<body>
<div class ="mydetails">
<form action="update.php" method = "post">
<select id="selection" name="table" ><option></option>
    <option value="Employee">Update Employee table</option>
    <option value="Customer">Update Customer table </option>
    <option value="Item">Update Item table </option>
    <option value="Location">Update Location table </option>
    <option value="LocationCustomer">Update LocationCustomer table </option>
    <option value="LocationItems">Update LocationItems table </option>
    <option value="Orders">Update Orders table </option>
    <option value="OrderItems">Update OrderItems table </option>
    <option value="OrdersLocations">Update OrderLocations table </option>
    <option value="Supplier">Update Supplier table </option>
    <option value="SupplierItems">Update SupplierItems table </option>
</select>
    </form>
</div>
    <script>

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

<!-- ............Employee Table......... -->
<div id = "Employee" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>
<table class="responstable">
    <th>ID</th>        
    <th>Name</th>      
    <th>Salary</th>     
    <th>Position</th>   
    <th>SSN</th>       
    <th>Date of Birth</th>   

    <tr>
        <td><input type="text" name="employeeID"></td>
        <td><input type="text" name="employeeName"></td>
        <td><input type="text" name="employeeSalary"></td>
        <td><input type="text" name="employeePosition"></td>
        <td><input type="text" name="employeeSSN"></td>
        <td><input type="text" name="employeeDoB"></td>
    </tr>

    <th>LocationID</th>      
    <th>Starting Date</th>   
    <th>Ending Date </th>   
    <th>Manager's ID</th>  
    <th>Started supervising</th>
    <th>Started supervising</th>

    <tr>
        <td> <input type="text" name="employeeLocationID"></td>
        <td> <input type="text" name="employeeSDate"</td>
        <td> <input type="text" name="employeeEDate"></td>
        <td> <input type="text" name="employeeManagersID"></td>
        <td> <input type="text" name="employeeManagerSDate"</td>
        <td> <input type="text" name="employeeManagerEDate"</td>
    </tr>

</table>
<input type="hidden" name="table" value="Employee">
<!--<input type="submit" name="submit" value="Update"/>
-->
</form>
</div>

<!-- ............Customer Table......... -->
<div id = "Customer" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

  <table class="responstable">
    <th>CustomerID</th>        
    <th>Name</th>      
    <th>Phone number</th>     
    <th>Address</th>   
    <th>Email Address</th>
    <tr>
        <td><input type="text" name="customerID"></td>
        <td><input type="text" name="customerName"></td>
        <td><input type="text" name="customerPhone"></td>
        <td><input type="text" name="customerAddress"></td>
        <td><input type="text" name="customerEmail"></td>
    </tr>

</table>
<input type="hidden" name="table" value="Customer">
</form>
</div>

<!-- ...........Item Table......... -->
<div id = "Item" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

  <table class="responstable">
    <th>Item ID</th>        
    <th>Item name</th>      
    <th>Item category</th>     
    <th>MSRP</th>   
    <th>Current Price</th>
    <tr>
        <td><input type="text" name="itemID"></td>
        <td><input type="text" name="itemName"></td>
        <td><input type="text" name="itemCategory"></td>
        <td><input type="text" name="itemMSRP"></td>
        <td><input type="text" name="itemCurrentPrice"></td>
    </tr>

</table>
<input type="hidden" name="table" value="Item">
</form>
</div>


<!-- ............Location Tables.......... -->
<div id = "Location" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>LocationID</th>        
    <th>Number of Employees</th>      
    <th>Manager's ID</th>     
    <th>Location's phone number</th>   
    <th>Location's email address</th>   

    <tr>
        <td><input type="text" name="locationID"></td>
        <td><input type="text" name="locationNumEmployees"></td>
        <td><input type="text" name="locationManager"></td>
        <td><input type="text" name="locationPhone"></td>
        <td><input type="text" name="locationEmail"></td>
    </tr>


</table>
<input type="hidden" name="table" value="Location">
</form>
</div>


<div id = "LocationCustomer" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>LocationID</th>        
    <th>CustomerID</th>      
    <th>Tracking Number</th>     
    <th>Date Shipped</th>   

    <tr>
        <td><input type="text" name="locationcustomerLocationID"></td>
        <td><input type="text" name="locationcustomerCustomerID"></td>
        <td><input type="text" name="locationcustomerTrackingNo"></td>
        <td><input type="text" name="locationcustomerDateShipped"></td>
    </tr>


</table>
<input type="hidden" name="table" value="LocationCustomer">
</form>
</div>


<div id = "LocationItems" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>LocationID</th>        
    <th>ItemID</th>      
    <th>Amount in stock</th>     

    <tr>
        <td><input type="text" name="locationitemLocationID"></td>
        <td><input type="text" name="locationitemItemID"></td>
        <td><input type="text" name="locationitemAmount"></td>
    </tr>


</table>
<input type="hidden" name="table" value="LocationItems">
</form>
</div>



<!-- .........Order tables......... -->
<div id = "Orders" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>OrderID</th>        
    <th>Total</th>      
    <th>Destination</th>     
    <th>ShippingMethod</th>   

    <tr>
        <td><input type="text" name="orderID"></td>
        <td><input type="text" name="orderTotal"></td>
        <td><input type="text" name="orderDestination"></td>
        <td><input type="text" name="orderShippingMethod"></td>
    </tr>

    <th>CustomerID</th>       
    <th>Date Placed</th>      
    <th>Employee ID</th>   
    <th>Date filled </th>   

    <tr>
        <td> <input type="text" name="orderCustomerID"></td>
        <td> <input type="text" name="orderDatePlaced"></td>
        <td> <input type="text" name="orderEmployeeID"</td>
        <td> <input type="text" name="orderDateFilled"></td>
    </tr>

    
</table>
<input type="hidden" name="table" value="Orders">
</form>
</div>


<div id = "OrderItems" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>OrderID</th>        
    <th>ItemID</th>      
    <th>Amount ordered</th>     

    <tr>
        <td><input type="text" name="orderitemsOrderID"></td>
        <td><input type="text" name="orderitemsItemID"></td>
        <td><input type="text" name="orderitemsAmount"></td>
    </tr>


</table>
<input type="hidden" name="table" value="OrderItems">
</form>
</div>

<div id = "OrdersLocations" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>OrderID</th>        
    <th>LocationID</th>      
    <th>Destination</th>     

    <tr>
        <td><input type="text" name="orderslocationsOrderID"></td>
        <td><input type="text" name="orderslocationsLocationID"></td>
        <td><input type="text" name="orderslocationsDestination"></td>
    </tr>


</table>
<input type="hidden" name="table" value="OrdersLocations">
</form>
</div>

<!-- ..........Supplier tables ..........-->
<div id = "Supplier" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>Supplier name</th>        
    <th>Supplier phone number</th>      
    <th>Supplier address</th>     
    <th>Supplier email address</th>     

    <tr>
        <td><input type="text" name="supplierName"></td>
        <td><input type="text" name="supplierPhone"></td>
        <td><input type="text" name="supplierAddress"></td>
        <td><input type="text" name="supplierEmailAddress"></td>
    </tr>


</table>
<input type="hidden" name="table" value="Supplier">
</form>
</div>

<div id = "SupplierItems" class = "inv">
<form action="update.php" method="post">
<h3>Update where</h3>
<div>
    <div class="mydetails">
    <input type="text" name="whereClause" class="mytextbox">
    </br>
    <input type="submit" name="submit" value="Update">
    </div>
</div>
</br>

 <table class="responstable">
    <th>Supplier name</th>        
    <th>Item ID</th>      
    <th>Supply start date</th>     
    <th>Supply end date</th>     

    <tr>
        <td><input type="text" name="supplieritemsName"></td>
        <td><input type="text" name="supplieritemsItemID"></td>
        <td><input type="text" name="supplieritemsSDate"></td>
        <td><input type="text" name="supplieritemsEDate"></td>
    </tr>


</table>
<input type="hidden" name="table" value="SupplierItems">
</form>
</div>


</form>    

</body>
</html>
