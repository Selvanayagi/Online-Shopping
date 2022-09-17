<?php

include("dbconnect.php");
include("header.php");
?>
<div id="content" class="float_r">
	<h1>Billing Detail </h1>

	<table width="642" border="2" align="center">
		<tr>
			
			<th width="62">Date</th>
			<th width="118">Customer ID</th>
			<th width="56">Total</th>
			

		</tr>
		<?php
		if ($_POST) {

			$startDate = $_POST['startDate'];

			$endDate = $_POST['endDate'];





			$sql = "SELECT * FROM billing WHERE purch_date >= '$startDate' AND purch_date <= '$endDate' ";

			$query = mysqli_query($con,$sql);
			if ($query) {
												?>

				<tr>
					<?php
					
					while ($result=mysqli_fetch_array($query)) {
						
						echo '<tr>
											
				<td><center>' . $result['purch_date'] . '</center></td>
				<td><center>' . $result['cust_id'] . '</center></td>
				<td><center>' . $result['price'] . '</center></td>
				
			</tr>';
					}
					?>

				</tr>
		<?php
			}
			echo '</table></div>';
		} else {
			echo "error";
		}
		?>