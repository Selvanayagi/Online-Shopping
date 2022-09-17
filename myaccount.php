<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(!isset($_SESSION["loginid"]))
{
	header("Location: login.php");
}

?> 

<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            <?php
			include("sidebar.php");
			?>
          
   		</div>
        <div id="content" class="float_r">
        <h1>My account</h1>
        <p>&nbsp;</p>
<div class="cleaner h20">
  <p>Don't have an account? <a href="register.php"><strong>Sign Up</strong></a></p>
  <p>&nbsp;</p>
</div>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>