<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM message where mess_id='$_GET[msgid]'");

while($row = mysqli_fetch_array($result))
  {
	  if($row[mess_type] == "SupplierCustomer")
	  {
	  $resulte = mysqli_query($con,"SELECT * FROM supplier where supp_id='$row[user_id]'");

	$rowe = mysqli_fetch_array($resulte);
	$name = $rowe[compname];
	 $from= $row[user_id];
	 $sub= $row[subject];
	 $description= $row[description];
	  }
	  else if($row[mess_type] == "AdministratorCustomer")
	  {
	$name = "Administrator";
	 $from= "Administrator"; 
	 $sub= $row[subject];
	 $description= $row[description];
	  }
	   else if($row[mess_type] == "AdministratorSupplier")
	  {
	 	$name = "Administrator";
	 $from= "Administrator"; 
	 $sub= $row[subject];
	 $description= $row[description];
	  }
	  	 else if($row[mess_type] == "CustomerAdministrator")
	  {
	  $resulte = mysqli_query($con,"SELECT * FROM customer where custid='$row[user_id]'");

	$rowe = mysqli_fetch_array($resulte);
	$name = $rowe[custfname]." ". $rowe[custlname];
	 $from= $row[user_id];
	 $sub= $row[subject];
	 $description= $row[description];
	  }
  else if($row[mess_type] == "SupplierAdministrator")
	  {
	  $resulte = mysqli_query($con,"SELECT * FROM supplier where supp_id='$row[user_id]'");

	$rowe = mysqli_fetch_array($resulte);
	$name = $rowe[compname];
	 $from= $row[user_id];
	 $sub= $row[subject];
	 $description= $row[description];
	  }
  }
?> 


<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
     <?php
			   //for suppliers
	 if(isset($_SESSION["supp_id"]))
	 {
   include("adminsidebar.php");
	 }
	 
	 //for customers
	if(isset($_SESSION["loginid"]))
	 {
   include("sidebar.php");
   	 }
	 
	  //for administrator
	if(isset($_SESSION["admin_id"]))
	 {
   include("adminsidebar.php");
	 }

 ?>
          
        </div>
        <div id="content" class="float_r">
        <h1>Message </h1>
        <form id="form1" name="form1" method="post" action="">
          <table width="418" border="0">
  <tr>
    <th width="105" height="33">From</th>
    <td width="303"><input name="from" type="hidden" id="from_id" size="50" readonly="readonly" value="<?php echo $from; ?>" />
    <input name="from" type="text" id="from_id" size="50" readonly="readonly" value="<?php echo $name; ?>" />
    </td>
  </tr>
  <tr>
    <th height="35">Title</th>
    <td><input name="title" type="text" id="title_id" size="50" readonly value="<?php echo $sub; ?>"/ ></td>
  </tr>
  <tr>
    <th height="96">Message</th>
    <td><textarea name="message" id="msg_id" cols="45" rows="5" readonly><?php echo $description; ?>
            </textarea></td>
  </tr>
</table>

          <p>&nbsp;</p>
</form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>