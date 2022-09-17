<!--<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categories</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<?php
						$resultrecx = mysqli_query($con,"SELECT * FROM category;");
						while($rows = mysqli_fetch_array($resultrecx))
						{
							echo "<li><a href='products.php?catids=$rows[cat_id]'>$rows[cat_name]</a></li>";
						}
						?>
      
                    </ul>
                </div>
            </div>
   		</div>-->