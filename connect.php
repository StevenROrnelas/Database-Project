<?php
  /* define() creates named constants which can be used throughout your scripts
   * without a '$' before the name */ 

  define("USERNAME", "sornelas"); 	// change sspade to your username
  define("PASSWORD", "luw~6Sic");  	// modify password to 'your' password
  define("DATABASE", "CS342"); 	// change sspade to your username
  define("HOST", "localhost");  	// do not modify host

   // connect to the mysql server 
   $link = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
   if (!$link) {
      die('Could not connect: ' . mysql_error());
   }

   //access database/submit queries


   // close the connection in the outer script
   #COMMENT OUT FOR FUTURE EXAMPLES
   #mysqli_close($link);
   #echo "connection closed.<br/>";

?> 
