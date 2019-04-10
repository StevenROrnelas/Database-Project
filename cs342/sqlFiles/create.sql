CREATE TABLE Employee
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name    VARCHAR (100),
    Salary   DECIMAL (10,2),
    Position VARCHAR (40),
    SSN INT(11),
    DoB DATE,
    LocationID INT,
    SDate DATE,
    EDate DATE,
    ManagersID INT,
    ManagersSDate DATE,
    ManagersEDate DATE

);

CREATE TABLE Location
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NumEmployees    INT,
    Manager         INT,
    Address VARCHAR(100),
    Phone VARCHAR(100),
    Email VARCHAR(100)
);

CREATE TABLE Item
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ItemName VARCHAR(100),
    Category VARCHAR(100),
    MSRP   DECIMAL (10,2),
    CurrentPrice   DECIMAL (10,2)
);

CREATE TABLE Orders
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Total DECIMAL (10,2),
    Destination VARCHAR(100),
    ShippingMethod VARCHAR(100),
    CustomerID INT,
    DatePlaced DATE,
    EmployeeID INT,
    DateFilled DATE
);

CREATE TABLE Supplier
(
    Name  VARCHAR(100) PRIMARY KEY,
    Phone VARCHAR(100),
    Address VARCHAR(100) UNIQUE,
    Email VARCHAR(100)
);

CREATE TABLE Customer
(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Phone VARCHAR(100),
    Address VARCHAR(100),
    Email VARCHAR(100)
);

CREATE TABLE OrderItems
(
    OrderID INT references Orders(ID),
    ItemID  INT references Inventory(ItemID),
    Amount INT,
    CONSTRAINT pk_OrderItems PRIMARY KEY (OrderID, ItemID)
);

CREATE TABLE SupplierItems
(
    Supplier VARCHAR(100) references Supplier(Name),
    ItemID INT references Inventory(ItemID),
    SDate DATE,
    EDate DATE,
    CONSTRAINT pk_SupplierItems PRIMARY KEY (Supplier, ItemID)
);

CREATE TABLE LocationItems
(
    LocationID INT references Location(ID),
    ItemID INT references Item(ID),
    Amount INT,
    CONSTRAINT pk_LocationItems PRIMARY KEY (LocationID, ItemID)
);

CREATE TABLE OrdersLocations
(
    OrderID INT UNIQUE references Orders(ID),
    LocationID INT references Location(ID),
    Destination VARCHAR(100),
    CONSTRAINT pk_OrderLocations PRIMARY KEY (OrderID, LocationID)
);

CREATE TABLE LocationCustomer
(
    LocationID INT references Location(ID),
    CustomerID INT references Customer(ID),
    TrackingNumber INT,
    DateShipped Date,
    CONSTRAINT pk_LocationCustomer PRIMARY KEY (LocationID, CustomerID)
);
