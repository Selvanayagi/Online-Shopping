<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(!isset($_SESSION["adlogin"]))
{
	header("Location: adminlogin.php");
}

?> 

<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
 <?php
 include("adminsidebar.php");
 $resulta = mysqli_query($con,"SELECT * FROM customer");
 $resultb = mysqli_query($con,"SELECT * FROM products");
  $resultc = mysqli_query($con,"SELECT * FROM supplier");	
    $resultd = mysqli_query($con,"SELECT * FROM purchase");

    $resulte = mysqli_query($con,"SELECT * FROM billing where deliv_date!= '0000-00-00'");
    $resultf = mysqli_query($con,"SELECT SUM(total) FROM billing");	
	$arrecs = mysqli_fetch_array($resultf);
 ?>
         <div class="content"></div>
          </div> 
        
        <div id="content" class="float_r">
        <h1>Admin Dashboard</h1>
        <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                  <td height="30"><div align="center"><strong>1</strong></div></td>
                  <td style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of Customers - <?php echo mysqli_num_rows($resulta); ?></strong></a></td>
                  <td><a href="admin-viewcustomer.php" class="more">View</a></td>
                </tr>
                <tr>
                    <td width="176" height="30"><div align="center"><strong>2</strong></div></td>
                    <td width="370" style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of suppliers - <?php echo mysqli_num_rows($resultc); ?></strong></a></td>
                    <td width="148"><a href="admin-viewsupplier.php" class="more">View</a></td>
                </tr>
                <tr>
                  <td height="30"><div align="center"><strong>3</strong></div></td>
                  <td style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of products - <?php echo mysqli_num_rows($resultb); ?></strong></a></td>
                  <td><a href="admin-viewprod.php" class="more">View</a></td>
                </tr>
                <tr>
                  <td height="30"><div align="center"><strong>4</strong></div></td>
                  <td style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of Products sold - <?php echo mysqli_num_rows($resultd); ?></strong></a></td>
                  <td><a href="billingdetail.php" class="more">View</a></td>
                </tr>
                
                
            </table>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>