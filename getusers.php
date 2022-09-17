<?php
include("dbconnect.php");
if($_GET['catid']== "Customer" || $_GET['catid']== "SupplierCustomer" || $_GET['catid']== "SupplierCustomer" ||  $_GET['catid']== "AdministratorCustomer" )
{

	$query="SELECT * FROM customer";
	$result=mysqli_query($con,$query);
	?>
	Customers : <select name="subcat">
	<option value="">Select Customer</option>
	<?php
	while($row=mysqli_fetch_array($result)) 
	{
	?>
	<option value="<?php echo $row[custid]; ?>"><?php echo $row[email]; ?></option>
	<?php
	} 
	echo "</select>";
}

if($_GET['catid'] == "Suppliers" || $_GET['catid'] == "AdministratorSupplier" )
{
	$query="SELECT * FROM supplier where status!='Deleted'";
	$result=mysqli_query($con,$query);
	?>
	Suppliers : <select name="subcat">
	<option value="">Select Supplier</option>
	<?php
	while($row=mysqli_fetch_array($result)) 
	{
	?>
	<option value="<?php echo $row[supp_id]; ?>"><?php echo $row[compname]; ?></option>
	<?php
	} 
		echo "</select>";
}


?>


</select>