<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(isset($_SESSION["adlogin"]))
{
	header("Location: admindashboard.php");
}

if(isset($_POST[Submit]))
{
	$result = mysqli_query($con,"SELECT * FROM administrator where login_id='$_POST[email]' and a_password='$_POST[password]'");
	
	if(mysqli_num_rows($result) == 1)
	{
		$rowarray = mysqli_fetch_array($result);
		
		$_SESSION["admin_id"] = $rowarray["admin_id"];
		$_SESSION["adlogin"] = $_POST["email"];
		header("Location: admindashboard.php");
	}
	else
	{
		$errmsg =  "<font color='#FF0000'><b> Invalid Id or password entered.. Please try again..<b></font>";
	}
}
?> 
<script language="javascript">
function validateadlogin()
{
	var x=document.form1.email.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	if(document.form1.email.value=="")
	{
		alert("Please enter Admin Login ID");
		document.form1.email.focus();

		return false;
	}
	else
	if(document.form1.password.value=="")
	{
		alert("Please enter the password");
		document.form1.password.focus();

		return false;
	}
}
</script>
<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
   		  <div class="sidebar_box">
   		<?php
		include("cssidebar.php");
		?>
   		    <div class="content"></div>
          </div>
      </div>
        <div id="content" class="float_r">
        <h1>Administrator Login Page</h1>
          <form id="form1" name="form1" method="post" action="" onsubmit="return validateadlogin()">
        	<h2>Please enter userid and password</h2>
            <font color="red">*</font><b>Enter all mandatory fields</b>
            <p><?php echo $errmsg; ?></p>
            <table width="500" height="125" border="0">
              <tr>
                <th width="102" height="40" scope="row">
                <font color="red">*</font>Login Id:</th>
                <td width="388">
                <input name="email" type="text" id="email" size="50" /></td>
              </tr>
              <tr>
                <th height="40" scope="row"><font color="red">*</font>Password:</th>
                <td><input name="password" type="password" id="password" size="50" /></td>
              </tr>
              <tr>
                <th height="41" colspan="2" scope="row"><input type="submit" name="Submit" id="Submit" value="Login here"  /></th>
                
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