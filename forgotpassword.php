<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(isset($_POST[Submit]))
{
	$resultf = mysqli_query($con,"SELECT * FROM customer where email='$_POST[email]' and dob='$_POST[dob]'");

	if(mysqli_num_rows($resultf) == 1)
	{

		header("Location: forgot_updtpswd.php?email=$_POST[email]");
	}
	else
	{
		$errmsgf = "<font color='#FF0000'><b> Invalid email id or DOB entered.. Please try again..<b></font>";
	}
}
	
include("header.php");
?>
   <script language="javascript">
function validatepass()
{
	if(document.forpass.email.value=="")
	{
		alert("Please enter Email ID");
		document.forpass.email.focus();
        return false;
	}
	else if(document.forpass.dob.value=="")
	{
		alert("Please enter Date of birth");
		document.forpass.dob.focus();
        return false;
	}
	
	
}
</script> 
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<?php
			include("cssidebar.php");
			?>
        </div>
        <div id="content" class="float_r">
        <h1>Forgot your password?</h1>
        <font color="red">*</font><b>Enter all mandatory fields</b>
          <form id="form1" name="forpass" method="post" action="" onsubmit="return validatepass() ">
        	<h2>Please enter Email Id and Date of Birth</h2>
        <?php echo $errmsgf; ?>
        <table width="500" height="125" border="0">
          <tr>
            <th width="102" height="40" scope="row">
            <font color="red">*</font>Email ID</th>
            <td width="388">
            <input name="email" type="text" id="email" size="50" />
            </td>
          </tr>
          
          <tr>
            <th height="40" scope="row"><font color="red">*</font>DOB</th>
            <td><input name="dob" type="dob" id="dob" size="50" /></td>
          </tr>
          <tr>
            <th height="41" colspan="2" scope="row"><input type="submit" name="Submit" id="Submit" value="Change Password" class="buttonabc" /></th>
            
          </tr>
        </table>
        <p>&nbsp;</p>
          </form>
          <div class="cleaner h20">
            <p>Don't have an account? <a href="register.php"><strong>Sign Up</strong></a></p>
  <p>&nbsp;</p>
</div>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>