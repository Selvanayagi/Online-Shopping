<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");
if(!isset($_SESSION["loginid"]))
{
	header("Location: login.php");
}
include("header.php");

$resultsp = mysqli_query($con,"SELECT * FROM cart where prod_id = '$_GET[proid]' AND custid='$cid'");
$proqty = mysqli_num_rows($resultsp);

if(isset($_POST[updcart]))
{
	mysqli_query($con,"UPDATE cart set qty='$_POST[prodqty]' where prod_id = '$_GET[proid]'");
}
else
{
	if(isset($_GET[proid]))
	{
	if($proqty == 0)
	{
			$sql="INSERT INTO cart (custid,prod_id,qty) VALUES ('$cid','$_GET[proid]','$_GET[qty]')";
			if (!mysqli_query($con,$sql))
			 {
			 die('Error: ' . mysqli_error($con));
			 }
			 $cartres ="Product added to cart successfully";
	}
	else
	{
		mysqli_query($con,"UPDATE cart SET qty = qty + 1 where prod_id='$_GET[proid]' AND custid='$cid'");
		 $cartres ="cart updated successfully";
	}
	}

}
//mysqli_query($con,"UPDATE");



if(isset($_GET[prodelid]))
{
	mysqli_query($con,"DELETE FROM cart where  cartid='$_GET[prodelid]'");
}

$resultsp = mysqli_query($con,"SELECT * FROM products where prod_id = '$_GET[proid]'");

while($rosp = mysqli_fetch_array($resultsp))
{
	$prodid  = $rosp[prod_id];
	$catid   =$rosp[cat_id];
	$subcat =$rosp[subcat_id];
	$suppid=$rosp[supp_id];
	$prodname=$rosp[prodname];
	$price=$rosp[price];
	$discount=$rosp[discount];
	$p_warranty=$rosp[p_warranty];
	$stoc_status=$rosp[stock_status];
	$devilery=$rosp[deliveredin];
	$prod_speci=$rosp[prod_specif];
	$images=$rosp[images];
	$start=$rosp[Start_at];
	$end=$rosp[End_at];
	$status=$rosp[status];
    			if($rosp[images]=="")
				{
				$img = "images/products.jpg";
				}	
				else
				{
				$img = "upload/".$rosp[images];	
				}
												
}

$resultssp = mysqli_query($con,"SELECT * FROM cart where custid = '$cid'");
$countid = mysqli_num_rows($resultssp);
?>

    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<?php
			include("cssidebar.php");
			?>
            </div>
   		</div>
        <div id="content" class="float_r">
        	<h1>Shopping Cart</h1>
            <p> </p>
         <?php
		 
		 if($countid != 0)
		 {
			 echo $cartres; 
        ?>
        <form method="post" action="" name="form1" id="form1">
<?php
$resultssq = mysqli_query($con,"SELECT * FROM cart where custid = '$cid'");
if(mysqli_num_rows($resultssq) == 0)
{
echo "<h3>NO products in cart</h3>";

}
else
{
?>
        	<table width="680px" cellspacing="0" cellpadding="5">
                   	  	<tr bgcolor="#ddd">
                        	<th width="164" align="left">Image </th> 
                        	<th width="178" align="left">Product name </th> 
                       	  	<th width="89" align="center">Quantity </th> 
                        	<th width="53" align="right">Price </th> 
                        	<th width="53" align="right">Total </th> 
                        	<th width="81"> </th>
                      	</tr>
                        <?php

                        while($rowa = mysqli_fetch_array($resultssq))
                        {
							$img="";
							$resultssb = mysqli_query($con,"SELECT * FROM products where prod_id = '$rowa[prod_id]'");
                        	while($rowb = mysqli_fetch_array($resultssb))
                        	{
								if($rowb[images]=="")
								{
								$img = "images/products.jpg";
								}
								else
								{
								$img = "uploads/".$rowb[images];	
								}
						?>
                    	<tr>
                        	<td><a  rel="lightbox[portfolio]" href="images/">
                            <img src="<?php echo $img; ?>" alt="Image 01" height="114" width="150" />
                            </a></td> 
                        	<td><?php echo $rowb[prodname]; ?></td> 
                            <td align="center"><input type="number" min="1"  value="<?php echo $rowa[qty]; ?>" style="width:40px; text-align: right" name="prodqty" /> </td>
                            <td align="right"><?php echo $rowb[price]; ?></td> 
                            <td align="right"><?php echo $costs =  $rowb[price] * $rowa[qty] ; ?></td>
                            <td align="center"> <a href="shoppingcart.php?prodelid=<?php echo $rowa[cartid]; ?>">Remove</a> </td>
						</tr>
                        <?php
						$grandtotal = $grandtotal + $costs ;
						
							}
                        }
						?>
                        <tr>
                        	<td colspan="3" align="right"  height="30px"><input type="submit" name="updcart" id="updcart" value="Update cart"/>                        	  &nbsp;&nbsp; </td>
                            <td align="right" style="background:#ddd; font-weight:bold"> Total </td>
                            <td colspan="2" align="left" style="background:#ddd; font-weight:bold">Rs. <?php echo $grandtotal; ?>  </td>
                        </tr>
					</table>
<?php
		 }
?>           
        </form>
                    <div style="float:right; width: 215px; margin-top: 20px;">
                    
					<p><a href="checkout.php">Proceed to checkout</a></p>
                    <p><a href="products.php">Continue shopping</a></p>
               <?php
		 }
		 else
		 {
			 echo "<center><h3>No items found in Cart</h3></center>";
		 	 echo "<center><h3><a href='products.php'>Click here to view products</h3></center>";
		 }
		 ?>
         
           </div>
        <div class="cleaner"></div>
     <!-- END of templatemo_main -->
    
  <?php
include("footer.php");
?>