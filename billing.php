<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");

$resultd = mysqli_query($con,"SELECT * FROM purchase ");
$result = mysqli_query($con,"SELECT * FROM billing where bill_id='$_GET[bid]'");

while($row = mysqli_fetch_array($result))
  {
	$bill_id =  $row[bill_id];	
	$cust_id =  $row[cust_id];	
	$price =  $row[price];	
	$discount =  $row[discount];	
	$total =  $row[total];	
	$purch_date =  $row[purch_date];	
	
  }

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
        
        <h1>Invoice      </h1>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          
          <table width="329" border="0">
            <tr>
              <th width="177" height="29">Bill  ID:</th>
              <td width="63"><?php echo $bill_id; ?></td>
            </tr>
            <tr>
              <th height="29">Customer Name:</th>
              <td><?php 
		  $result1= mysqli_query($con,"SELECT * FROM customer where custid = '$cust_id'");
$row1 = mysqli_fetch_array($result1);
echo $row1[custfname]. " ". $row1[custlname];
		  
		  ?></td>
            </tr>
            <tr>
              <th height="29">Purchase Date:</th>
              <td><?php echo $purch_date; ?></td>
            </tr>
            
          </table>
          <p>&nbsp;</p>
          
          </form>
          
		  
          <table width="679" border="1">
              <tr>
                <th width="154" scope="col">Product name</th>
                <th width="81" scope="col">Quantity</th>
                <th width="126" scope="col">Product Cost</th>
                 <th width="111" scope="col">Discount</th>
                <th width="112" scope="col">Total </th>
              </tr>
              <?php
$check = mysqli_query($con,"SELECT * FROM purchase where bill_id = '$_GET[bid]'");
              while($ch = mysqli_fetch_array($check))
              {
			  ?>
              <tr bgcolor="#FFFFFF">
			<?php
            $checka = mysqli_query($con,"SELECT * FROM products where prod_id = '$ch[prod_id]'");
            $ch1 = mysqli_fetch_array($checka);
            ?>
                <td><?php echo $ch1[prodname]; ?></td>
                <td align="center"><?php
				 echo $proqty = $ch[qty]; ?></td>
				<?php
				 $totdiscount1 = 0;
					if($ch1[discount]!= 0)
					{
					  $discount 	= $ch1[price] * $ch1[discount]/100;
					  $tota 		= $ch1[price]-$discount ;
					  $totdiscount1 = $totdiscount + $discount ;	
					  $totdiscount = $totdiscount + $discount ;
					}
					else
					{
					 $tota = $ch1[price];	
					}
				?>
                <td>&nbsp; Rs. <?php  echo $procost = number_format($ch1[price], 2, '.', ''); ?></td>
                <td>&nbsp;<?php  echo $ch1[discount]; ?> % &nbsp;</td>
                <td align="right">&nbsp; <strong>Rs.</strong><?php 
				$totalcost = $proqty * $procost; 
				echo number_format($totalcost, 2, '.', '');

				
				$totalcost2 = $totalcost2 + $totalcost;

//coding to calculate discount				
$totaldiscount =  ($procost * $ch1[discount]/100) * $proqty;				
 $granddiscount = $granddiscount +$totaldiscount;
				?></td>
              </tr>
              <?php
              }
              ?>
              <tr bgcolor="#CCCCCC">
                <td colspan="4" align="right"><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>
                <td align="right">&nbsp; <strong>Rs.</strong> <?php echo  $totcost = number_format($totalcost2, 2, '.', ''); ?></td>
              </tr>
              <tr bgcolor="#CCCCCC">
                <td colspan="4" align="right"><strong>Discount&nbsp;&nbsp;&nbsp;</strong></td>
                <td align="right"><strong>Rs.</strong> <?php echo  
			$disccost = number_format($granddiscount, 2, '.', ''); ?></td>
              </tr>
              <tr bgcolor="#CCCCCC">
                <td colspan="4" align="right"><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>
                <td align="right"><strong>Rs.</strong><?php 
				$grandtot = $totcost-$disccost; 
				echo number_format($grandtot, 2, '.', '');
				?></td>
              </tr>
            </table>
          <p>&nbsp;</p>
</form>
  
        
         
        <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>