<?php
if(!isset($_SESSION)) { session_start(); }
include("header.php");
$results = mysqli_query($con,"SELECT * FROM products where prod_id = '$_GET[proid]'");
$dt = date("Y-m-d");
while($ros = mysqli_fetch_array($results))
{
	$prodid = $ros[prod_id];
	$catid=$ros[cat_id];
	$subcat=$ros[subcat_id];
	$suppid=$ros[supp_id];
	$prodname=$ros[prodname];
	$price=$ros[price];
	$discount=$ros[discount];
	$p_warranty=$ros[p_warranty];
	$stoc_status=$ros[stock_status];
	$devilery=$ros[deliveredin];
	$prod_speci=$ros[prod_specif];
	$images=$ros[images];
	$start=$ros[Start_at];
	$end=$ros[End_at];
	$status=$ros[status];
    			if($ros[images]=="")
				{
				$img = "images/products.jpg";
				}	
				else
				{
				$img = "uploads/".$ros[images];	
				}
												
}

$resultpp = mysqli_query($con,"SELECT compname FROM supplier where supp_id = '$suppid'");
while($rop = mysqli_fetch_array($resultpp))
{
	$compname = $rop[compname];
}

$results = mysqli_query($con,"SELECT * FROM products WHERE end_at>'$dt' AND status='Approved' order by RAND() LIMIT 0 , 3");

?>

    <div id="templatemo_main">
	  <div id="sidebar" class="float_l">
      	<div class="sidebar_box">
       	<?php
		include("cssidebar.php");
		?>
   		
        <div class="content"></div>
          </div>
      </div>
        <div id="content" class="float_r">
        	
            <h1><?php echo $prodname; ?></h1>
            <div class="content_half float_l">
        	<a  rel="lightbox[portfolio]" href="images/"><img src="<?php echo $img; ?>" alt="Image 01" height="300" width="300" /></a>
            </div>
            <div class="content_half float_r">
            <form method="get" action="shoppingcart.php" name="form1" id="form1">
				<table>
                    <tr>
                        <td height="30" width="160">Price:</td>
                        <td><?php echo $price; ?></td>
                    </tr>
                    <tr>
                        <td height="30">Discount:</td>
                        <td><?php echo $discount; ?></td>
                    </tr>
                    <tr>
                        <td height="30">Manufacturer:</td>
                        <td><?php echo $compname; ?></td>
                    </tr>
                    <tr>
                        <td height="30">Stock Status:</td>
                        <td><?php echo $stoc_status; ?></td>
                    </tr>
                    <tr>
                    	<td height="30">Warranty:</td>
                        <td><?php echo $p_warranty; ?>&nbsp;months</td>
                    </tr>
                    <tr>
                    	<td height="30">Delivered In:</td>
                        <td><?php echo $devilery; ?>&nbsp;days</td>
                    </tr>
                        
                    <tr><td height="30">Quantity</td><td>
                    <input type="text" name ="qty" value="1" style="width: 20px; text-align: right" />
                    <input type="hidden" name="proid" value="<?php echo $prodid; ?>" />
                    </td></tr>
                    
                </table>
                <div class="cleaner h20"></div>
                <?php
				if(isset($_SESSION["loginid"]))
				{
				?>
                <input type="submit" name="submit" value="Add to cart"  />
                
				<?php
                }
				else
				{
				?>
                  <input type="submit" name="submit" value="Add to cart"  />
                <?php
                }
                ?>
                </form>
			</div>
            <div class="cleaner h30"></div>
            
            <h5>Product Description</h5>
            <p><?php echo $prod_speci; ?></p>	
            
            <div class="cleaner h50"></div>
          <h4>Products</h4>
          <?php
            while($ros = mysqli_fetch_array($resultsw))
			{
				$prod_name=$ros[prodname];
				$pricew=$ros[price];
				$imagesw=$ros[images];	
				?>
          <?php
            }
			?>
           <?php
			$i=0;
			while($ros = mysqli_fetch_array($results))
			{
				if($ros[images]=="")
				{
					$img = "images/products.jpg";
				}
				else
				{
				$img = "uploads/".$ros[images];	
				}
				if($i==0)
				{	
				?>
            <div class="product_box"><a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a></a></a></a>
              <h3><?php echo $ros["prodname"]; ?></h3>
                <p class="product_price">Rs. <?php echo $ros["price"]; ?></p>
                <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Add to Cart</a>
                <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="detail">Detail</a>
            </div>       
            <?php
			$i=1;
				}
				else if($i==1)
				{
				?>
            <div class="product_box">
           	  <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
                <h3><?php echo $ros["prodname"]; ?></h3>
                <p class="product_price">Rs. <?php echo $ros["price"]; ?></p>
             <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Add to Cart</a>
              <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="detail">Detail</a>
            </div> 
            <?php
			$i=2;
				}
				else if($i==2)
				{
				?>       	
            <div class="product_box no_margin_right">
      <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
                <h3><?php echo $ros["prodname"]; ?></h3>
                <p class="product_price">Rs. <?php echo $ros["price"]; ?></p>
              <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>" class="add_to_card">Add to Cart</a>
              <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="detail">Detail</a>
            </div> 
            <?php
			$i=0;
				}
				?>    
            	<?php
			}
			?>
           
            
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>