<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(!isset($_SESSION["adlogin"]))
{
	header("Location: adminlogin.php");
}
?>
<script type="text/javascript">
function validatechpswd()
{
	
	 if(document.form1.oldpswd.value=="")
	  {
	 	alert("Please enter the Old Password.");
		document.form1.oldpswd.focus();
		return false;
	  }
	 
	  else if(document.form1.newpswd.value=="")
	  {
	 	alert("Please enter the New Password.");
		document.form1.newpswd.focus();
		return false;
	  }
	 else if(document.form1.newpswd.value.length<8 || document.form1.newpswd.value.length>15 )
	 {
		alert("Minimum characters for password are 8 and maximum characters are 15");
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

if(isset($_POST["Update"]))
{
$sql=mysqli_query($con,"UPDATE administrator SET a_password = '$_POST[newpswd]' where login_id='$_POST[log_id]' AND a_password='$_POST[oldpswd]'");
if(mysqli_affected_rows() == 1)
{
$result1="<font color='green'><b>Admin password updated successfully...</b></font>";
}
else
{
	$result1 = "<font color='red'><b>Failed to update password...</b></font>";
}
}

?> 


><?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
 <?php
 include("adminsidebar.php");
 ?>
          
        </div>
        <div id="content" class="float_r">
        <h1>Admin Profile </h1>
        <form id="form1" name="form1" method="post" action="" onsubmit="return validatechpswd()">
          <h2>Change Password</h2>
          <font color="red">*</font><b>Enter all mandatory fields</b>
          <p><?php echo $result1; ?></p>
          <table width="500" height="125" border="0">
            <tr>
              <th width="190" height="40" scope="row">Login ID</th>
              <td width="300">
              <input name="log_id" type="text" id="log_id" size="50" value="<?php echo $_SESSION["adlogin"]; ?>" readonly/>
              </td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Old Password</th>
              <td>
              <input name="oldpswd" type="password" id="oldpswd" size="50" /></td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>New Password</th>
              <td><input name="newpswd" type="password" id="newpswd" size="50" /></td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Confirm Password</th>
              <td><input name="confirmpswd" type="password" id="confirmpswd" size="50" /></td>
            </tr>
            <tr>
              <th height="41" colspan="2" scope="row">
                 <input type="submit" name="Update" id="Update" value="Update Password" /></th>
              
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>