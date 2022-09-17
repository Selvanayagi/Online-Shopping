<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");
include("header.php");
?>

  <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
   		
   		    <?php
 if(isset($_SESSION["adlogin"]))
{
 include("adminsidebar.php");
}
else if(isset($_SESSION["splogin"]))
{
 include("adminsidebar.php");
}
else
{
 include("sidebar.php"); 
}
 ?>
	      
    </div>
   		<div id="content" class="float_r">
        <h1>Billing Detail       </h1>

        <table width="642" border="2">
                    <tr>
                    <th width="62">Bill Id</th>
                      <th width="118">Customer name</th>
                        <th width="60">Price</th>
         <th width="87">Discount</th>
                        <th width="56">Total</th>
                        <th width="102">Purchase Date</th>
                        
                    </tr>
     <?php
 if(isset($_SESSION[custid]))
 {
	if($_GET[billst] == "ord")
	{				 
	$result= mysqli_query($con,"SELECT * FROM billing where cust_id='$_SESSION[custid]'");
	}
	else if($_GET[billst] == "del")
	{
		$dt = date("Y-m-d");
	$result= mysqli_query($con,"SELECT * FROM billing where cust_id='$_SESSION[custid]' AND deliv_date<'$dt'");	
	}
}
else
{
$result= mysqli_query($con,"SELECT * FROM billing");
}
    while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['bill_id'] . "</td>";
  echo "<td>";
  $result1= mysqli_query($con,"SELECT * FROM customer where custid = '$row[cust_id]'");
$row1 = mysqli_fetch_array($result1);
echo "<a href='billing.php?bid=$row[bill_id]'>".$row1[custfname]. " ". $row1[custlname]."</a>";
  echo "</td>";
  echo "<td>" . $row['price'] . "</td>";
  echo "<td>" . $row['discount'] . "</td>";
  echo "<td>" . $row['total'] . "</td>";
  echo "<td>" .  $date = date("d-m-Y ", strtotime($row['purch_date'])). "</td>";
  
  echo "</tr>";
  }


?>

                    
          </table>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	Order Report 
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>

<script src="custom/js/report.js"></script>

        <div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>