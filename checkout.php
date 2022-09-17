<?php
if (!isset($_SESSION)) {
	session_start();
}
include("header.php");
include("dbconnect.php");
if (!isset($_SESSION["loginid"])) {
	header("Location: login.php");
}

$check = mysqli_query($con, "SELECT * FROM cart where custid = '$cid'");

if (isset($_POST['purchasest'])) {
	$tomorrow = mktime(0, 0, 0, date("m"), date("d") + 5, date("Y"));
	$edate = date("Y/m/d", $tomorrow);

	$dt = date("Y-m-d");
	$sql = "INSERT INTO billing(cust_id,price,discount,total,purch_date) VALUES ('$_SESSION[custid]','$_POST[price]','$_POST[disccost]', '$_POST[grtot]', '$dt')";
	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	}

	$ids = mysqli_insert_id($con);
	
	$checkbill = mysqli_query($con, "SELECT * FROM cart where custid = '$_SESSION[custid]'");
	while ($recs =  mysqli_fetch_array($checkbill)) {
		$sql = "INSERT INTO purchase (bill_id,prod_id,qty) VALUES('$ids','$recs[prod_id]','$recs[qty]')";
		
		if (!mysqli_query($con, $sql)) {
			die('Error: ' . mysqli_error($con));
		}
		$ordersucc = "Orders placed successfully..";
		
		//mai
		$msg = '<html><body>';
		$msg .= '<h1>Customer Id:' . "$_SESSION[custid]" . '</h1>';
		$msg .= '<h1>Customer Email:' . "$_SESSION[loginid]" . '</h1>';
		$msg .= '<h1>Purchase Date' . "$dt" . '</h1>';
		$msg .= '<br><br>';
		$msg .= '<table border=1>';
		$msg .= '<tr>';
		$msg .= '<th>Product Name</th>';
		$msg .= '<th>Quantity</th>';
		$msg .= '<th>Product Cost</th>';
		$msg .= '<th>Discount</th>';
		$msg .= '<th>Total</th></tr>';
		while ($ch = mysqli_fetch_array($check)) {
			$checka = mysqli_query($con, "SELECT * FROM products where prod_id = '$ch[prod_id]'");
			$ch1 = mysqli_fetch_array($checka);
			$msg .= '<td>' . "$ch1[prodname]" . '</td>';
			$proqty = $ch['qty'];
			$msg .= '<td align="center">' . "$ch[qty]" . '</td>';
			$totdiscount1 = 0;
			
			if ($ch1['discount'] != 0) {
				$discount 	= $ch1['price'] * $ch1['discount'] / 100;
				$tota 		= $ch1['price'] - $discount;
				$totdiscount1 = $totdiscount + $discount;
				$totdiscount = $totdiscount + $discount;
			} else {
				$tota = $ch1['price'];
			}
			$procost = number_format($ch1['price'], 2, '.', '');
			$msg .= '<td>' . "$ch1[price]" . '</td>';
			$msg .= '<td>' . "$ch1[discount]" . '</td>';
			$msg .= '<td align="right">&nbsp; <strong>Rs.</strong>';
			$totalcost = $proqty * $procost;
			$msg .= "$totalcost";
			$totalcost2 = $totalcost2 + $totalcost;
			//coding to calculate discount				
			$totaldiscount =  ($procost * $ch1['discount'] / 100) * $proqty;
			$granddiscount = $granddiscount + $totaldiscount;
			$msg .= '</td></tr>';
		}echo '$discount';
		$msg .= '<tr bgcolor="#CCCCCC">';
		$msg .= '<td colspan="4" align="right"><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>';
		$totcost = number_format($totalcost2, 2, '.', '');
		$msg .= '<td align="right">&nbsp; <strong>Rs.</strong>' . "$totalcost2" . '</td></tr>';
		$msg .= '<tr bgcolor="#CCCCCC">';
		$msg .= '<td colspan="4" align="right"><strong>Discount&nbsp;&nbsp;&nbsp;</strong></td>';
		$disccost = number_format($granddiscount, 2, '.', '');
		$msg .= '<td align="right"><strong>Rs.</strong>' . "$granddiscount" . '</td></tr>';
		$msg .= '<tr bgcolor="#CCCCCC">';
		$msg .= '<td colspan="4" align="right"><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>';
		$msg .= '<td align="right"><strong>Rs.</strong>';
		$grandtot = $totcost - $disccost;
		$gt = $grandtot;
		$msg .= "$grandtot" . '</td></tr></table>';


		$msg .= '</table>';
		$msg .= '</body></html>';
	}
	$headers = "From:snaveenkumarsakthivel@gmail.com " . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" .
			'Content-Type: text/html; charset=utf-8';
		if ((mail("snaveenkumarsakthivel@gmail.com;$_SESSION[loginid]", "New Order", $msg, $headers)) == true) {
			mysqli_query($con, "DELETE FROM cart where custid='$_SESSION[custid]'");
			mysqli_query($con, "UPDATE products SET stock_status= stock_status - $qty where prod_id= $prod_id");
		} else {
			echo "<h1>error</h1>";
		}
}
?>
<div id="templatemo_main">
	<?php
	include("categorysidebar.php");
	?>

	<div id="content" class="float_r">
		<form method="post" action="" name="form1" id="form1">
			<h2>Checkout</h2>
			<h5><strong>BILLING DETAILS</strong></h5>
			<?php
			if ($ordersucc == "Orders placed successfully..") {
				echo "<h1>" . $ordersucc . "</h1>";
				echo $msg;
			} else {
			?>
				<table width="679" border="1">
					<tr>
						<th width="154" scope="col">Product name</th>
						<th width="81" scope="col">Quantity</th>
						<th width="126" scope="col">Product Cost</th>
						<th width="111" scope="col">Discount</th>
						<th width="112" scope="col">Total </th>
					</tr>
					<?php
					while ($ch = mysqli_fetch_array($check)) {
					?>




						<?php
						$checka = mysqli_query($con, "SELECT * FROM products where prod_id = '$ch[prod_id]'");
						$ch1 = mysqli_fetch_array($checka);
						?>
						<td><?php echo $ch1['prodname']; ?></td>
						<td align="center"><?php
											echo $proqty = $ch['qty']; ?></td>
						<?php
						$totdiscount1 = 0;
						if ($ch1['discount'] != 0) {
							$discount 	= $ch1['price'] * $ch1['discount'] / 100;
							$tota 		= $ch1['price'] - $discount;
							$totdiscount1 = $totdiscount + $discount;
							$totdiscount = $totdiscount + $discount;
						} else {
							$tota = $ch1['price'];
						}
						?>
						<td>&nbsp; Rs. <?php echo $procost = number_format($ch1['price'], 2, '.', ''); ?></td>
						<td>&nbsp;<?php echo $ch1['discount']; ?> % &nbsp;</td>
						<td align="right">&nbsp; <strong>Rs.</strong><?php
																		$totalcost = $proqty * $procost;
																		echo number_format($totalcost, 2, '.', '');


																		$totalcost2 = $totalcost2 + $totalcost;


																		//coding to calculate discount				
																		$totaldiscount =  ($procost * $ch1['discount'] / 100) * $proqty;
																		$granddiscount = $granddiscount + $totaldiscount;
																		?></td>
						</tr>
					<?php
					}
					?>
					<tr bgcolor="#CCCCCC">
						<td colspan="4" align="right"><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>
						<td align="right">&nbsp;

							Rs. <?php echo  $totcost = number_format($totalcost2, 2, '.', ''); ?>
							<input type="hidden" name="price" id="price" value="<?php echo $totcost; ?>" />
						</td>
					</tr>
					<tr bgcolor="#CCCCCC">
						<td colspan="4" align="right"><strong>Discount&nbsp;&nbsp;&nbsp;</strong></td>
						<td align="right">Rs. <?php echo
													$disccost = number_format($granddiscount, 2, '.', '');
												?>
							<input type="hidden" name="disccost" id="disccost" value="<?php echo $disccost; ?>" />
						</td>
					</tr>
					<tr bgcolor="#CCCCCC">
						<td colspan="4" align="right"><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>
						<td align="right">Rs. <?php
												$grandtot = $totcost - $disccost;
												echo number_format($grandtot, 2, '.', '');
												?>
							<input type="hidden" name="grtot" id="grtot" value="<?php echo $grandtot; ?>" />
						</td>
					</tr>
				</table>

				<div class="cleaner h50"></div>
				<b>Please make sure you have entered your accurate address in your profile, before you click on &quot;Confirm Order&quot;. If u need to make any changes, please <a href="viewaccount.php">Click here</a>. And make the required changes.</b>
				<h4>TOTAL:<strong> Rs. <?php
										echo number_format($grandtot, 2, '.', '');
										?></strong></h4>
				<p>
					<input type="submit" name="purchasest" id="purchasest" value="Confirm order" />
				</p>
				<p>
				<?php
			}
				?>
            
				</p>
				<p>
		</form>
		</p>
	</div>
	<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->

<?php
include("footer.php");
?>