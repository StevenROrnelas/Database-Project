<?php session_start();
require_once ('connect.php');
require_once ('utils.php');
require_once ('lib.php');
$file = fopen("insert.sql", "w") or die ("Unable to openfile!");

function generateEmployees  (mysqli $link, &$num)
{

    for ($i = 0; $i < $num; $i++)
    {

		$SSN = 0;
        //Global is needed here because otherwise the array from lib.php
        //are not part of the function's scope

        global $FirstNames, $LastNames, $Positions;

        $ID = mt_rand(1, 1000000);

        //Do a count-1 so that we don't go past the final index of the arrays
        $Name = $FirstNames[mt_rand(0,count($FirstNames)-1)] . " ". $LastNames[mt_rand(0,count($LastNames)-1)];

        //Multiply and divide by 100 in order to get the cents i.e. .21 for the salary.
        $Salary = mt_rand(20000*100, 150000*100) /100;

        $Position = $Positions[mt_rand(0, count($Positions)-1)];

        //Loop 9 times to get the 9 digits in a social security number
        for ($k = 0; $k < 9; $k++)
        {
            $SSN .= mt_rand(0,9);
        }

        //Generate a random date in Year, Month, Date format
        $DoB = mt_rand( strtotime("Jan 01 1950"), strtotime("Dec 31 1996"));
        $DoB = date("Y-m-d", $DoB);

        //Location Data
        $LocationID = mt_rand(1, 20);
        $SDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $SDate = date("Y-m-d", $SDate);

        $EDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $EDate = date("Y-m-d", $EDate);

        //If an ending date that is before the starting date was generated, try again
        while (strtotime($EDate) < strtotime($SDate))
        {
            $EDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
            $EDate = date("Y-m-d", $EDate);
        }

        //Manager Data
        $sql = "SELECT * FROM employee WHERE Position = 'Manager' ORDER BY RAND() LIMIT 1" or die (mysqli_error($link));
        $result = mysqli_query($link,$sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $ManagersID = $row[0];
		
		if ($ManagersID == NULL)
			$ManagersID = 0;

        $ManagersSDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $ManagersSDate = date("Y-m-d", $ManagersSDate);

        $ManagersEDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $ManagersEDate = date("Y-m-d", $ManagersEDate);

        //If an ending date that is before the starting date was generated, try again
        while (strtotime($ManagersEDate) < strtotime($ManagersSDate))
        {
            $ManagersEDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
            $ManagersEDate = date("Y-m-d", $ManagersEDate);
        }

        $sql = "INSERT INTO employee (ID, Name, Salary, Position, SSN, DoB, LocationID, SDate,
                                      EDate, ManagersID, ManagersSDate, ManagersEDate)
                              VALUES ($ID, '$Name', $Salary, '$Position', $SSN, '$DoB',
                                      $LocationID, '$SDate', '$EDate', $ManagersID, '$ManagersSDate',
                                      '$ManagersEDate')";
					
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));


        //Unset variables so that in each subsequent loop it starts fresh
        unset($SSN);
        unset($SDate);
        unset($EDate);
        unset($ManagersSDate);
        unset($ManagersEDate);
    }
}

function generateLocations  (mysqli $link, &$num)
{
    global $BusinessAddresses, $EmailAddresses;

    for ($i = 0; $i < $num; $i++)
    {
        $ID = mt_rand(1, 20);
        $NumEmployees = mt_rand(10, 200);

        //Get a manager
        $sql = "SELECT * FROM employee WHERE Position = 'Manager' ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_row($result);
        $Manager = $row[0];

        $Address = $BusinessAddresses[mt_rand(0, count($BusinessAddresses) - 1)];
        $Phone = mt_rand (10000000000, 19999999999);
        $Email = $EmailAddresses[mt_rand(0, count ($EmailAddresses) - 1)];

        $sql = "INSERT INTO Location (ID, NumEmployees, Manager, Address, Phone, Email)
            VALUES ($ID, $NumEmployees, $Manager, '$Address', $Phone, '$Email')";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        if (!$result)
            $i--;
    }
}

function generateItems  (mysqli $link, &$num)
{
    global $ItemNames, $ItemCategories;

    for ($i = 0; $i < $num; $i++)
    {
        $ID = mt_rand(1, 1000000);

        $ItemName = $ItemNames[mt_rand(0, count($ItemNames) - 1)];
        $ItemCategory = $ItemCategories[mt_rand(0, count($ItemCategories) - 1)];

        $MSRP = mt_rand(1*100, 1000*100) /100;
        $CurrentPrice = mt_rand(1*100, 1000*100) /100;

        $sql = "INSERT INTO Item (ID, ItemName, Category, MSRP, CurrentPrice)
            VALUES ($ID, '$ItemName', '$ItemCategory', $MSRP, $CurrentPrice)";

        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        if (!$result)
            $i--;
    }

}

function generateOrders     (mysqli $link, &$num)
{
    global $Addresses, $ShippingMethods;

    for ($i = 0; $i < $num; $i++)
    {
        $ID = mt_rand(1, 1000000);
        $Total = mt_rand(1*100, 10000*100) / 100;
        $Destination = $Addresses[mt_rand(0, count($Addresses) - 1)];
        $ShippingMethod = $ShippingMethods[mt_rand(0, count($ShippingMethods) - 1)];
        
        $sql = "SELECT ID from Customer ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $CustomerID = $row[0];
        
        $DatePlaced = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $DatePlaced = date("Y-m-d", $DatePlaced);

        if (strtotime($DateShipped) < strtotime($DatePlaced))
        {
            $DateShipped = mt_rand (strtotime ($DatePlaced), strtotime("Oct 30 2015"));
            $DateShipped = date("Y-m-d", $DateShipped);
        }

        $sql = "SELECT ID from employee ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $EmployeeID = $row[0];

        $DateFilled = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $DateFilled = date("Y-m-d", $DateFilled);

        if (strtotime($DateFilled) < strtotime($DatePlaced))
        {
            $DateFilled = mt_rand (strtotime ($DatePlaced), strtotime("Oct 30 2015"));
            $DateFilled = date("Y-m-d", $DateFilled);
        }

        $sql = "INSERT INTO orders (ID, Total, Destination, ShippingMethod,
                                    CustomerID, DatePlaced, EmployeeID, DateFilled)
                            VALUES ($ID, $Total, '$Destination', '$ShippingMethod',
                                    $CustomerID, '$DatePlaced', $EmployeeID, '$DateFilled')";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        //if ($result == 0)
         //   $i -= 1;
    }


}

function generateSuppliers  (mysqli $link, &$num)
{
    for ($i = 0; $i < $num; $i++) 
    {
        //global as usual
        global $BusinessNames, $BusinessAddresses, $EmailAddresses;

        $SupplierName = $BusinessNames[mt_rand(0, count($BusinessNames) - 1)];
        $SupplierAddress = $BusinessAddresses[mt_rand(0, count($BusinessAddresses) - 1)];
        $Phone = mt_rand (10000000000, 19999999999);
        $Email = $EmailAddresses[mt_rand(0, count($EmailAddresses) - 1)];

        $sql = "INSERT INTO Supplier (Name, Phone, Address, Email)
            VALUES ('$SupplierName', $Phone, '$SupplierAddress', '$Email')";

        $result = mysqli_query($link, $sql);
        if ($result == 0)
            $i -= 1;
    }
}

function generateCustomers  (mysqli $link, &$num)
{
    for ($i = 0; $i < $num; $i++)
    {
        global $FirstNames, $LastNames, $Addresses, $EmailAddresses;

        $ID = mt_rand(1, 1000000);

        //Get random first name and concatenate with a last name, count - 1 to stay within array boundaries
        $Name = $FirstNames[mt_rand(0, count($FirstNames) - 1)] . " ". $LastNames[mt_rand(0, count($LastNames) - 1)];

        //randomize phone number.. start with 1 000 000 0000 since no phone number starts with 0
        $Phone = mt_rand (10000000000, 19999999999);

        $Address = $Addresses[mt_rand(0, count($Addresses) - 1)];

        $Email = $EmailAddresses[mt_rand(0, count($EmailAddresses) - 1)];

        $sql = "INSERT INTO Customer (ID, Name, Phone, Address, Email)
            VALUES ($ID, '$Name', $Phone, '$Address', '$Email')";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
    }
}

function generateOrderItems (mysqli $link, &$num)
{
    for ($i = 0; $i < $num; $i++)
    {
        $sql = "SELECT ID from Orders ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $OrdersID = $row[0];


        $sql = "SELECT ID from Item ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $ItemID = $row[0];

        $Amount = mt_rand(0, 100);

        $sql = "INSERT INTO OrderItems (OrderID, ItemID, Amount)
                VALUES ($OrdersID, $ItemID, $Amount)";
        $result = mysqli_query($link, $sql);
    }
}

function generateSupplierItems (mysqli $link, &$num)
{
    for ($i = 0; $i < $num; $i++)
    {
        $sql = "SELECT Name from Supplier ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $SupplierName = $row[0];

        $sql = "SELECT ID from Item ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $ItemID = $row[0];

        $SDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $SDate = date("Y-m-d", $SDate);

        $EDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
        $EDate = date("Y-m-d", $EDate);

        //If an ending date that is before the starting date was generated, try again
        while (strtotime($EDate) < strtotime($SDate))
        {
            $EDate = mt_rand (strtotime ("Jan 01 1980"), strtotime("Oct 30 2015"));
            $EDate = date("Y-m-d", $EDate);
        }

        $sql = "INSERT INTO SupplierItems (Supplier, ItemID, SDate, EDate)
            VALUES ('$SupplierName', $ItemID, '$SDate', '$EDate')";
        $result = mysqli_query($link, $sql);       
        
    }
}

function generateLocationItems (mysqli $link, &$num)
{
    for ($i = 0; $i < $num; $i++)
    {
        $sql = "SELECT ID FROM Location ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $LocationID = $row[0];

        $sql = "SELECT ID FROM Item ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $ItemID = $row[0];

        $Amount = mt_rand(0, 1000);

        $sql = "INSERT INTO LocationItems (LocationID, ItemID, Amount)
            VALUES ($LocationID, $ItemID, $Amount)";
        $result = mysqli_query($link, $sql); 
    }
}

function generateLocationOrder (mysqli $link, &$num)
{
    global $Addresses;
    for ($i = 0; $i < $num; $i++)
    {
        $sql = "SELECT ID FROM Location ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $LocationID = $row[0];
        
        $sql = "SELECT ID FROM Orders ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $OrderID = $row[0];
        
        $sql = "SELECT Destination FROM Orders WHERE ID = $OrderID ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $Destination = $row[0];

        print ($Destination);
        $sql = "INSERT INTO OrdersLocations (OrderID, LocationID, Destination)
            VALUES ($OrderID, $LocationID, '$Destination')";
        $result = mysqli_query($link, $sql); 
    }
}

function generateLocationCustomer (mysqli $link, &$num)
{
    for ($i = 0; $i < $num; $i++)
    {
        $sql = "SELECT ID FROM Location ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $LocationID = $row[0];

        $sql = "SELECT ID FROM Customer ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $CustomerID = $row[0];

        $TrackingNo = mt_rand(0, 1000000);

        $sql = "SELECT * FROM orders WHERE CustomerID = $CustomerID ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $DatePlaced = $row[5];

        $DateShipped = mt_rand(strtotime($DatePlaced), strtotime("Oct 30 2015"));
        $DateShipped = date("Y-m-d", $DateShipped);

        $sql = "INSERT INTO LocationCustomer (LocationID, CustomerID, TrackingNumber, DateShipped)
                VALUES ($LocationID, $CustomerID, $TrackingNo, '$DateShipped')";
        $result = mysqli_query($link, $sql); 

        unset($DatePlaced);
        unset($DateShipped);
    }
}

        
?>


<?php 
/*if (!$_SESSION['EmployeesGenerated'] || !$_SESSION['LocationsGenerated'] ||
    !$_SESSION['ItemsGenerated'] || !$_SESSION['OrdersGenerated']    ||
    !$_SESSION['SuppliersGenerated'] || !$_SESSION['CustomersGenerated'] ||
    !$_SESSION['OrderItemsGenerated'] || !$_SESSION['SupplierItemsGenerated'] ||
    !$_SESSION['LocationItemsGenerated'] || !$_SESSION['LocationCustomerGenerated'] ||
    !$_SESSION['LocationOrderGenerated']
)*/
{?>
<html>
    <head>
        <title> Generate sample database data </title>
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
                <h3> Generate some data </h3>
                <hr />

            <form action = "generate.php" method = "post">

                Enter the amount of items to generate: <input name = "generateNum" type = "text" />
                <input name = "generateEmployees" type = "submit" value = "Generate Employees" />
                <input name = "generateLocations" type = "submit" value = "Generate Locations" />
                <input name = "generateItems" type = "submit" value = "Generate Items" />
                <input name = "generateSuppliers" type = "submit" value = "Generate Suppliers" />
                <input name = "generateCustomers" type = "submit" value = "Generate Customers" />
                <input name = "generateOrders"    type = "submit" value = "Generate Orders" />            
                <input name = "generateOrderItems"    type = "submit" value = "Generate OrderItems" />          
                <input name = "generateSupplierItems"    type = "submit" value = "Generate SupplierItems" />
                <input name = "generateLocationItems"    type = "submit" value = "Generate LocationItems" /> 
                <input name = "generateLocationCustomer" type = "submit" value = "Generate LocationCustomer" />
                <input name = "generateLocationOrder" type = "submit" value = "Generate LocationOrders" />

            </form>
        </div>
    </body>
</html>
<?php
}

$num = $_POST['generateNum'];

if (isset($_POST['generateEmployees'])) {
    generateEmployees ($link, $num);
}

if (isset($_POST['generateLocations'])) {
    generateLocations ($link, $num);
}

if (isset($_POST['generateItems'])) {
    generateItems ($link, $num);
}

if (isset($_POST['generateSuppliers'])) {
    generateSuppliers ($link, $num);
}

if (isset($_POST['generateCustomers'])) {
    generateCustomers ($link, $num);
}

if (isset($_POST['generateOrders'])) {
    generateOrders ($link, $num);
}

if (isset($_POST['generateOrderItems'])) {
    generateOrderItems ($link, $num);
}

if (isset($_POST['generateSupplierItems'])) {
    generateSupplierItems ($link, $num);
}

if (isset($_POST['generateLocationItems'])) {
    generateLocationItems ($link, $num);
}

if (isset($_POST['generateLocationCustomer'])){
    generateLocationCustomer ($link, $num);
}

if (isset($_POST['generateLocationOrder'])){
    generateLocationOrder ($link, $num);
}
?>

