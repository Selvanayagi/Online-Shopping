<?php
if(!isset($_SESSION)) { session_start(); }
include("header.php");
include("dbconnect.php");

$results = mysqli_query($con,"SELECT * FROM products  ");
$dt = date("Y-m-d");
if(isset($_GET[proid]))
{
$sql="INSERT INTO cart (custid,prod_id,qty)
VALUES
('$cid','$_GET[proid]',1)";
}

mysqli_query($con,"UPDATE cart SET qty = '$_POST[qty]' where custid='$cid' AND prod_id='$_GET[proid]");
?>
<?php
if(isset($_GET[catids]))
{
$results = mysqli_query($con,"SELECT * FROM products where end_at>'$dt' AND status='Approved' AND cat_id='$_GET[catids]'  order by RAND() DESC LIMIT 0 , 6");
}
else
{
$results = mysqli_query($con,"SELECT * FROM products where end_at>'$dt' AND status='Approved' order by RAND() DESC LIMIT 0 , 6");
}
  ?>  
    <div id="templatemo_middle" class="carousel">
    	<div class="panel">
				
				<div class="details_wrapper">
					
					<div class="details">
					
						<div class="detail">
							<h2><a href="#">Cements</a></h2>
                            <p>A cement is a binder, a substance used for construction that sets, hardens, and adheres to other materials to bind them together. ... Cement mixed with fine aggregate produces mortar for masonry, or with sand and gravel, produces concrete.</p>
						</div><!-- /detail -->
						
						<div class="detail">
						  <h2><a href="#">Steel Rod</a></h2>
                            <p>Metal Rod. Metal rods are metals and alloys designed in the pattern of round bars or rod, rectangular or flat bars, square bars, hexagons, and other patterns of bar stock. ... Reinforcing bars are also a type of metal rods that are used to give strength or internally sustain the concrete and masonry structures.</p>
</div>
						<!-- /detail -->
						
						<div class="detail">
							<h2><a href="#">Paint</a></h2>
                            <p>Paint is any pigmented liquid, liquefiable, or mastic composition that, after application to a substrate in a thin layer, converts to a solid film. It is most commonly used to protect, color, or provide texture to objects. ... Most paints are either oil-based or water-based and each have distinct characteristics.</p>
						</div><!-- /detail -->
						
					</div><!-- /details -->
					
				</div><!-- /details_wrapper -->
				
				<div class="paging">
					<div id="numbers"></div>
					<a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
					<a href="javascript:void(0);" class="next" title="Next">Next</a>
				</div><!-- /paging -->
				
				<a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
				<a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>
				
			</div><!-- /panel -->
	
			<div class="backgrounds">
				
				<div class="item item_1">
					<img src="images/slider/acc.png" alt="Slider 01" />
				</div><!-- /item -->
				
				<div class="item item_2">
					<img src="images/slider/tata.jpeg" alt="Slider 02" />
				</div><!-- /item -->
				
				<div class="item item_3">
					<img src="images/slider/asianpaints.jpeg" alt="Slider 03" />
				</div><!-- /item -->
				
			</div><!-- /backgrounds -->
    </div> <!-- END of templatemo_middle -->
    
    <!--
	<div id="templatemo_main">
   		
           <div id="content" class="float_r">
        	<h1>New Products</h1>
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
            <div class="product_box"><a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>">
            <img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a></a></a></a>
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
           	  <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
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
      <a href="productdetail.php?proid=<?php echo $ros["prod_id"]; ?>"><img src="<?php echo $img; ?>" alt="Image 02" height="150" width="200"/></a>
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
      </div> -->
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    <?php
	include("footer.php");
	?>