<?php
if(!isset($_SESSION)) { session_start(); }
     if(isset($_SESSION["adlogin"]))
{
?>
      	<h3>Administrator Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list"><span class="bottom"></span>
                    	<li class="first"><a href="admindashboard.php">Home</a></li>
                    	<li class="first"><a href="admin-profile.php">Admin Profile</a></li>
                    	<li class="first"><a href="adminchange-pswd.php">Change Password</a></li>
                    	<li class="first"><a href="admin-accounts.php">Admin Accounts</a></li>
                        <li><a href="admin-category.php">Category</a></li>
                        <li><a href="admin-subcategory.php">Sub Category</a></li>
                        <li><a href="admin-viewcustomer.php">View Customers</a></li>
                        
                             <li><a href="addsupplier.php">Add Suppliers</a></li>
                        <li><a href="admin-viewsupplier.php">View Suppliers</a></li>
                        <li><a href="billingdetail.php">Reports</a></li>
                        <li><a href="logout.php">Logout</a></li>
                   
                        
                  </ul>
</div>
            </div>
<?php
}
  else  if(isset($_SESSION["splogin"]))
{
?>
      	<h3>Supplier Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list"><span class="bottom"></span>
                    	<li class="first"><a href="supplierac.php">Home</a></li>
                    	<li class="first"><a href="supplier-profile.php">Supplier Profile</a></li>
                    	<li class="first"><a href="supplierchange-pswd.php">Change Password</a></li>
                    
                        <li><a href="addproduct.php">Add Products</a></li>
                        <li><a href="admin-viewprod.php">View Products</a></li>
                             
                        <li><a href="logout.php">Logout</a></li>
                   
                        
                  </ul>
</div>
            </div>
<?php
}
?>