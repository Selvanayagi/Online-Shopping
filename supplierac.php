<?php
if(!isset($_SESSION)) { session_start(); }
include("header.php");
if(!isset($_SESSION["splogin"]))
{
	header("Location: supplierlogin.php");
}
include("dbconnect.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box">
 <?php
 include("adminsidebar.php");
 $dt = date("Y-m-d");
 
 $resultb = mysqli_query($con,"SELECT * FROM products where supp_id=$_SESSION[supp_id]");
 
    $resultd = mysqli_query($con,"SELECT * FROM purchase where prod_id=$_SESSION[supp_id]");

    $resulte = mysqli_query($con,"SELECT * FROM billing where bill_id=$_SESSION[supp_id] AND deliv_date>'$dt'");
	
    $resultf = mysqli_query($con,"SELECT * FROM billing where bill_id=$_SESSION[supp_id] ");
 ?>
         <div class="content"></div>
          </div>
      
        <div id="content" class="float_r">
        
        <h1>Supplier Account</h1>
        <table style="border:1px solid #CCCCCC;" width="100%">
                
                   <tr>
                  <td width="20%" height="30"><div align="center"><strong>1</strong></div></td>
                  <td width="67%" style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of products - <?php echo mysqli_num_rows($resultb); ?></strong></a></td>
                  <td width="13%"><a href="admin-viewprod.php" class="more">View</a></td>
                </tr>
                <tr>
                  <td height="30"><div align="center"><strong>2</strong></div></td>
                  <td style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of Products sold - <?php 
				 
$resultpro= mysqli_query($con,"SELECT * FROM products where supp_id='$_SESSION[supp_id]' ");
$i=0;
    while($rowpro = mysqli_fetch_array($resultpro))
  {
	$result= mysqli_query($con,"SELECT * FROM purchase where prod_id='$rowpro[prod_id]'");

    	while($row = mysqli_fetch_array($result))
 	 {
		
		$i++;
		$result2= mysqli_query($con,"SELECT * FROM billing where bill_id = '$row[bill_id]'");
	
	  while($row = mysqli_fetch_array($result2))
 	 {
		
	 }
		
  	}


  }
 
				echo $i;  ?></strong></a></td>
                  <td><a href="purchasedproductsdetail.php" class="more">View</a></td>
                </tr>
                <tr>
                  <td height="30"><div align="center"><strong>3</strong></div></td>
                  <td style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>No of Products delivered - <?php 
				 
$resultpro= mysqli_query($con,"SELECT * FROM products where supp_id='$_SESSION[supp_id]' ");
$i=0;
    while($rowpro = mysqli_fetch_array($resultpro))
  {
	  $dt = date("Y-m-d");
	$result= mysqli_query($con,"SELECT * FROM purchase where prod_id='$rowpro[prod_id]'");

    	while($row = mysqli_fetch_array($result))
 	 {
		
		$i++;
		$result2= mysqli_query($con,"SELECT * FROM billing where bill_id = '$row[bill_id]' && deliv_date<$dt");
	
	  while($row = mysqli_fetch_array($result2))
 	 {
		
	 }
		
  	}


  }
 
				echo $i;  ?></strong></a></td>
                  <td><a href="purchasedproductsdetail.php" class="more">View</a></td>
                </tr>
                <tr>
                  <td height="30"><div align="center"><strong>4</strong></div></td>
                  <td style="padding: 0px 20px;"><a href="" rel="nofollow"><strong>Total payment received - Rs. <?php 
				 
$resultpro= mysqli_query($con,"SELECT * FROM products where supp_id='$_SESSION[supp_id]' ");
$i=0;
    while($rowpro = mysqli_fetch_array($resultpro))
  {
	  $dt = date("Y-m-d");
	$result= mysqli_query($con,"SELECT * FROM purchase where prod_id='$rowpro[prod_id]'");

    	while($row = mysqli_fetch_array($result))
 	 {
		
	
		$result2= mysqli_query($con,"SELECT * FROM billing where bill_id = '$row[bill_id]'");
	
	  while($row = mysqli_fetch_array($result2))
 	 {
		$i = $i + $row[total];
	 }
		
  	}


  }
 
				echo $i;  ?></strong></a></td>
                  <td><a href="purchasedproductsdetail.php" class="more">View</a></td>
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