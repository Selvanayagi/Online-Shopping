<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["loginid"])))
{
	header("Location: login.php");
}
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
   include("sidebar.php");
   	
	 
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
    

	 //for customers
	if(isset($_SESSION["custid"]))
	 {
    $result = mysqli_query($con,"SELECT * FROM message where mess_type='SupplierCustomer' AND receiver_id='$_SESSION[custid]'");
	 }
	 if(isset($_SESSION["custid"]))
	 {
    $result = mysqli_query($con,"SELECT * FROM message where mess_type='AdministratorCustomer' AND receiver_id='$_SESSION[custid]'");
	 }

	 
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td> <input name='read' type='checkbox' value='read'> <a href='inboxcst.php?delid=$row[mess_id] '  onclick='return confirmDelete()'> <img src='images/erase.ico' width='15' height='15'></a> </td>";
  echo "<td>";
	if($row[mess_type] == "SupplierCustomer" || $row[mess_type] == "AdministratorCustomer" )
	{
	 echo "Administrator";
	}
	else
	{
		echo  $row['user_id'];
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