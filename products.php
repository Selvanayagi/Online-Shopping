<?php
if(!isset($_SESSION)) { session_start(); }
include("header.php");
include("dbconnect.php");

$dt = date("Y-m-d");

if(isset($_GET[catids]))
{
$results = mysqli_query($con,"SELECT * FROM products ");
}
else if(isset($_GET[supp_id]))
{
	$results = mysqli_query($con,"SELECT * FROM products ");
}
else if(isset($_POST["Search"]))
{
	$results= mysqli_query($con,"SELECT * FROM  products WHERE  keyword LIKE  '%$_POST[searchpr]%' ");
}
else
{
$results = mysqli_query($con,"SELECT * FROM products  ");
}

if(isset($_GET[proid]))
{
$sql="INSERT INTO cart (custid,prod_id,qty)
VALUES
('$cid','$_GET[proid]',1)";
}

mysqli_query($con,"UPDATE cart SET qty = '$_POST[qty]' where custid='$cid' AND prod_id='$_GET[proid]");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<?php
			include("cssidebar.php");
			?>
            
   		</div>
        <div id="content" class="float_r">
        	<h1>New Products</h1>
            
            <?php
			if(mysqli_num_rows($results) == 0)
			{
				echo "<h3>Products not found</h3>";
			}
			$i=0;
			while($ros = mysqli_fetch_array($results))
			{
				if($ros['images']=="")
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
            <div class="product_box">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&qty=1"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a></a></a></a>
              <h3><?php echo $ros["prodname"]; ?></h3>
                <p class="product_price">Rs. <?php echo $ros["price"]; ?></p>
                <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>&qty=1" class="add_to_card">Add to Cart</a>
                <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="detail">Detail</a>
            </div>       
            <?php
			$i=1;
				}
				else if($i==1)
				{
				?>
            <div class="product_box">
           	  <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&qty=1"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
                <h3><?php echo $ros["prodname"]; ?></h3>
                <p class="product_price">Rs. <?php echo $ros["price"]; ?></p>
              <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>&qty=1" class="add_to_card">Add to Cart</a>
              <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>" class="detail">Detail</a>
            </div> 
            <?php
			$i=2;
				}
				else if($i==2)
				{
				?>       	
            <div class="product_box no_margin_right">
      <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>&qty=1"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
                <h3><?php echo $ros["prodname"]; ?></h3>
                <p class="product_price">Rs. <?php echo $ros["price"]; ?></p>
              <a href="shoppingcart.php?proid=<?php echo $ros["prod_id"]; ?>&qty=1" class="add_to_card">Add to Cart</a>
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