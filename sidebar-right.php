<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>A Full-Width Page Layout | Icebrrrg by OD</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
    <link rel="stylesheet" href="stylesheets/flexslider.css">
    <link rel="stylesheet" href="stylesheets/prettyPhoto.css">
    
    <!-- CSS
  ================================================== -->
 	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="js/scripts.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<header id="header" class="site-header" role="banner">
    <div id="header-inner" class="container sixteen columns over">
    <hgroup class="one-third column alpha">
    <h1 id="site-title" class="site-title">
    <a href="home.html" id="logo"><img src="images/some-logo.png" alt="Icebrrrg logo" height="63" width="200" /></a>
    </h1>
    </hgroup>
    <nav id="main-nav" class="two thirds column omega">
    <ul id="main-nav-menu" class="nav-menu">
    <li id="menu-item-1">
    <a href="home.html">Home</a>
    </li>
    <li id="menu-item-2">
    <a href="full-width.php">Reports</a>
    </li>
    <li id="menu-item-3">
    <a href="sidebar-right.php">View Data</a>
    </li>
    <li id="menu-item-4">
    <a href="updates.html">Updates</a>
    </li>
    <li id="menu-item-6">
    <a href="index.html">Log Out</a>
    </li>
    </ul>
    </nav>
    </div>
    </header>

	<div class="container">
    
        <article class="sixteen columns main-content">
        <center><h1>View Data</h1></center>
        
        <?php require_once  ('listdatabase.php');?>
    
    </div>


<footer>

</div>

<div id="footer-base">
<div class="container">
<div class="eight columns">
</div>
<div class="eight columns far-edge">
</div>
</div>
</div>


</footer>
<!-- End Document
================================================== -->

</body>


</html>

