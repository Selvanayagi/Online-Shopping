<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");
include("header.php");
?>

  <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
   		
   		    <?php
 if(isset($_SESSION["adlogin"]))
{
 include("adminsidebar.php");
}
else if(isset($_SESSION["splogin"]))
{
 include("adminsidebar.php");
}
else
{
 include("sidebar.php"); 
}
 ?>
	      
    </div>
   		<div id="content" class="float_r">
        <h1>Billing Detail       </h1>
       <?php
	   $resultpro= mysqli_query($con,"SELECT * FROM products where supp_id='$_SESSION[supp_id]' ");

    while($rowpro = mysqli_fetch_array($resultpro))
  {
	   ?>
        <table width="681" border="2">

                    <tr>
                      <th colspan="2">Product name</th>
                      <th colspan="3">&nbsp;<?php echo $rowpro[prodname] ; ?></th>
                    </tr>
                    <tr>
                    	<th width="65">Purchase ID</th>
                      	<th width="119">Customer name</th>
                        <th width="58">Quantity</th>
                        <th width="112">Purchase Date</th>
                        
                    </tr>
     <?php

$result= mysqli_query($con,"SELECT * FROM purchase where prod_id='$rowpro[prod_id]'");
?>
   <tr >
                    	<th colspan="5">
                        <?php
						if(mysqli_num_rows($result) == 0)
						{
							echo "<h4>No products purchased</h4>";
						}
						?>
                        </th>
                   	</tr>
<?php
    while($row = mysqli_fetch_array($result))
  {
$result2= mysqli_query($con,"SELECT * FROM billing where bill_id = '$row[bill_id]'");
$row2 = mysqli_fetch_array($result2);
	  
$result1= mysqli_query($con,"SELECT * FROM customer where custid = '$row2[cust_id]'");
$row1 = mysqli_fetch_array($result1);  

$result3= mysqli_query($con,"SELECT * FROM products where prod_id = '$row[prod_id]'");
$row3 = mysqli_fetch_array($result3); 

  echo "<tr>";
  echo "<td>" . $row['purch_id'] . "</td>";
  echo "<td>";
echo $row1[custfname]. " ". $row1[custlname]."</a>";
  echo "</td>";
  echo "<td>" . $row['qty'] . "</td>";
  echo "<td>" .  $date = date("d-m-Y ", strtotime($row2['purch_date'])). "</td>";
  
  echo "</tr>";
  }


?>

                    
          </table>
          <br />
          <?php
  }
 ?>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 

        <div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>