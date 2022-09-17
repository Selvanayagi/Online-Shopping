<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
 <?php
if(isset($_GET[delid]))
{
mysqli_query($con,"DELETE FROM message where  mess_id='$_GET[delid]'");

$aresult = "<b>Message deleted successfully</b> <br>";

}

?>
<script type="text/JavaScript">
 
function confirmDelete(){
var agree=confirm("Are you sure you want to delete this message");
if (agree)
     return true;
else
     return false ;
}
</script>
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
        <h1>Inbox </h1>
        <form id="form2" name="form2" method="post" action="">
          <p><a href="message.php">Compose message</a></p>
          <table width="679" border="2">
                    <tr>
                      <th width="45">&nbsp;</th>
                        <th width="110">From</th>
         <th width="333">Title</th>
                        <th width="161">Date</th>
                    </tr>
                   
     <?php
    //for suppliers
	 if(isset($_SESSION["supp_id"]))
	 {
    $result = mysqli_query($con,"SELECT * FROM message where (mess_type='CustomerSupplier' OR mess_type='AdministratorSupplier' ) AND receiver_id='$_SESSION[supp_id]'");
	 }
	 //for customers
	if(isset($_SESSION["custid"]))
	 {
    $result = mysqli_query($con,"SELECT * FROM message where (mess_type='SupplierCustomer' OR mess_type='AdministratorCustomer') AND receiver_id='$_SESSION[custid]'");
	 }


	  //for administrator
	if(isset($_SESSION["admin_id"]))
	 {
    $result = mysqli_query($con,"SELECT * FROM message where (mess_type='CustomerAdministrator' OR mess_type='SupplierAdministrator') AND receiver_id='Administrator'");
	 }
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td> <input name='read' type='checkbox' value='read'> <a href='inbox.php?delid=$row[mess_id]'  onclick='return confirmDelete()'> <img src='images/erase.ico' width='15' height='15'></a> </td>";
  echo "<td>";
	if($row[mess_type] == "AdministratorCustomer" || $row[mess_type] == "AdministratorSupplier" || $row[mess_type] == "AdminAdmin" )
	{
	 echo "Administrator";
	}
	else
	{
		
		if($row['mess_type'] == "CustomerAdministrator"  || $row['mess_type'] == "CustomerSupplier")
		{
	 	$resultt = mysqli_query($con,"SELECT * FROM customer where custid='$row[user_id]'");
		$recanst = mysqli_fetch_array($resultt);
		echo  $recanst[custfname]." ".$recanst[custlname];
		}
		else
		{
		$resultu = mysqli_query($con,"SELECT * FROM supplier where supp_id='$row[user_id]'");
		$recansu = mysqli_fetch_array($resultu);
		echo $recansu[compname];
		}
	}
  echo  "</td>"."<td>&nbsp;&nbsp;&nbsp;<a href='adminview_msg.php?msgid=$row[mess_id]'>" . $row['subject'] . "</a></td>";
  echo "<td>" .   
  $date = date("d-m-Y h:i:s", strtotime($row['date'])) 
 . "</td>";
  echo "</tr>";
  }


?>

                    
          </table>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
</form>
 

       </div> 
<div class="cleaner"></div>


 <p>&nbsp;</p>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>