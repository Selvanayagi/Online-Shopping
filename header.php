<?php
if(!isset($_SESSION)) { session_start(); }
error_reporting(0);
include("dbconnect.php");
date_default_timezone_set('Asia/Kolkata');
$resultuser = mysqli_query($con,"SELECT * FROM customer where custid='$_SESSION[custid]'");
while ($myrowuser = mysqli_fetch_array($resultuser)) 
	{
	$cid = $myrowuser[custid];
	$cname = $myrowuser[custfname]. " ". $myrowuser[custlname];
	}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Arul Jothi</title>
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>


<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<link rel="stylesheet" type="text/css" media="all" href="css/jquery.dualSlider.0.2.css" />

<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.timers-1.2.js" type="text/javascript"></script>
<script src="js/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
        
        $(".carousel").dualSlider({
            auto:true,
            autoDelay: 6000,
            easingCarousel: "swing",
            easingDetails: "easeOutBack",
            durationCarousel: 1000,
            durationDetails: 600
        });
        
    });
    
</script>

</head>

<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    
    	<a href="index.php"><div id="site_title">
        	<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/nexus.jfif" width="191" height="54" /></h1>
        </div></a>
        
        <div id="header_right">
	       <strong>
		<?php
			if(isset($_SESSION["loginid"]))
			{
				echo "Welcome ".$cname;
			}
			?>
		<br/>
  		<a href="viewaccount.php">My Account</a>| <a href="shoppingcart.php">My Cart</a> |  
            <?php
			if(isset($_SESSION["loginid"]))
			{
				?>
               <a href="logout.php">Log out</a>
				<?php
			}
			else
			{
				?>
             <a href="login.php">Log In</a>
		| <a href="register.php">Register</a>
        <?php
			}
			?>
        </strong></div>
        
        
        
        
        
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menu">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php?selected=1" <?php if($_GET[selected]=="1") { echo "class='selected'"; } ?>>Home</a></li>
                <li><a href="products.php?selected=2" <?php if($_GET[selected]=="2") { echo "class='selected'"; } ?>>Products</a></li>
                <li><a href="about.php?selected=3" <?php if($_GET[selected]=="3") { echo "class='selected'"; } ?>>About</a></li>

                <li><a href="contact.php?selected=6" <?php if($_GET[selected]=="6") { echo "class='selected'"; } ?>>Contact</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        
        <div id="menu_second_bar">
        	
            <!-- delete the coding....-->
        	<div id="templatemo_search">
                <form name="search" method="post" action="products.php">
                  <input type="text" name="searchpr" id="searchpr" title="search"  class="txt_field" />
                  <input type="submit" name="Search" value=" Search " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
                </form>
            </div>
               <!-- delete the coding....-->
            <div class="cleaner"></div>
    	</div>
    </div> <!-- END of templatemo_menu -->