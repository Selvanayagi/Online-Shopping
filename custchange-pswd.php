<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(isset($_SESSION["loginid"]))
{
	//header("Location: login.php");
}


if(isset($_POST["Update"]))
{
$sql=mysqli_query($con,"UPDATE customer SET c_password = '$_POST[newpswd]' where email='$_POST[log_id]' AND c_password='$_POST[oldpswd]'");

if(mysqli_affected_rows() == 1)
{
$result1="<font color='green'><b>Customer password updated successfully...</b></font>";
}
else
{
	$result1 = "<font color='red'><b>Failed to update password...</b></font>";
}
}

?> 
<script type="text/javascript">
function validatecustchpswd()
{
	var x=document.form1.log_id.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	 if(document.form1.oldpswd.value=="")
	  {
	 	alert("Please enter your Old Password.");
		document.form1.oldpswd.focus();
		return false;
	  }
	 
	  else if(document.form1.newpswd.value=="")
	  {
	 	alert("Please enter your New Password.");
		document.form1.newpswd.focus();
		return false;
	  }
	 else if(document.form1.newpswd.value.length<8 || document.form1.newpswd.value.length>15 )
	 {
		alert("Minimum characters for password is 8 and maximum character is 15");
		document.form1.newpswd.focus();
		return false;
	 }
	 else if(document.form1.confirmpswd.value=="")
	{
		alert("Please re-enter your Password for Confrimation.");
		document.form1.confirmpswd.focus();
		return false;
	}
	
	else if(document.form1.newpswd.value != document.form1.  confirmpswd.value)
	{
		alert("Your Passwords does not match. Please re-enter.");
		document.form1.confirmpswd.value="";
       document.form1.newpswd.focus();
		return false;
	}
}
</script>

<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
 <?php
 include("sidebar.php");
 ?>
          
        </div>
        <div id="content" class="float_r">
        <h1>Customer password</h1>
        <font color="red">*</font><b>Enter all mandatory fields</b>
        <form id="form1" name="form1" method="post" action="" onsubmit="return validatecustchpswd()">
           <p><?php echo $result1; ?></p>
       <table width="593" border="0">
             <tr>
               <th width="151" height="36">Login ID</th>
               <td width="426"><input name="log_id" type="text" id="log_id" size="50" readonly value="<?php echo $_SESSION["loginid"] ?>" /></td>
            </tr>
             <tr>
               <th height="35"><font color="red">*</font>Old Password</th>
               <td><input name="oldpswd" type="password" id="oldpswd" size="50" /></td>
             </tr>
             <tr>
               <th height="34"><label for="newpswd"><font color="red">*</font>New Password</label></th>
               <td><input name="newpswd" type="password" id="newpswd" size="50" /></td>
             </tr>
             <tr>
               <th height="34"><font color="red">*</font>Confirm Password</th>
               <td><input name="confirmpswd" type="password" id="confirmpswd" size="50" /></td>
             </tr>
             <tr>
               
               <th height="39" colspan="2"><input type="submit" name="Update" id="Update" value="Update Password" /></th>
           </tr>
          </table>
<p>&nbsp;</p>
</form>
     <p>&nbsp;</p>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>