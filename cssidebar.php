<?php
include("categorysidebar.php");
?>
           <!-- <div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>            	<h3>Sellers</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	
                    	  <?php
						$resultrecy = mysqli_query($con,"SELECT * FROM supplier");
						while($rows = mysqli_fetch_array($resultrecy))
						{
						
							echo "<li><a href='products.php?supp_id=$rows[supp_id]'>$rows[compname]</a></li>";
						}
						?>
                   	  
                	</ul>
                </div>
            </div>
            </div>-->
