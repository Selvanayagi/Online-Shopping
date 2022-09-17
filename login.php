<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");
if(isset($_SESSION["loginid"]))
{
	header("Location: index.php");
}
if(isset($_POST[Submit]))
{
	$result = mysqli_query($con,"SELECT * FROM customer where email='$_POST[email]' and c_password='$_POST[password]'");
$arrrec = mysqli_fetch_array($result);
	if(mysqli_num_rows($result) == 1)
	{	
	$dt = date('Y-m-d H:i:s');
	$result1 = mysqli_query($con,"UPDATE customer  SET lastlogin='$dt' where email='$_POST[email]'");
		$_SESSION["custid"] = $arrrec["custid"];
 		$_SESSION["loginid"] = $_POST["email"];
		header("Location: index.php");
	}
	else
	{
		$errmsg = "<font color='#FF0000'><b> Invalid user id or password entered.. Please try again..<b></font>";
	}
}
	?>
    
<script language="javascript">
function validatelogin()
{
	var x=document.form1.email.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	if(document.form1.email.value=="")
	{
		alert("Please enter your Email id");
		document.form1.email.focus();

		return false;
	}
	else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
       alert("Not a valid E-mail address");
        return false;
    }
	
	else if(document.form1.password.value=="")
	{
		alert("Please enter your Password");
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
        	<?php
			include("cssidebar.php");
			?>
        </div>
        <div id="content" class="float_r">
        <h1>Login</h1>
          <form id="form1" name="form1" method="post" action="" onsubmit="return validatelogin()">
        	<h2>Please enter userid and password</h2>
            <p><font color="red">*</font><b>Enter all mandatory fields</b>            </p>
            <p><?php echo $errmsg; ?></p>
            <table width="500" height="125" border="0">
          <tr>
            <th width="102" height="40" scope="row">
           <font color="red">*</font><b></b> Email Id
            </th>
            <td width="388">
            <input name="email" type="text" id="email" size="50" />
            </td>
          </tr>
          
          <tr>
            <th height="40" scope="row"><font color="red">*</font><b></b>Password</th>
            <td><input name="password" type="password" id="password" size="50" /></td>
          </tr>
          <tr>
            <th height="41" colspan="2" scope="row"><p>
              <input type="submit" name="Submit" id="Submit" value="Login here"/>
            </p>
            <p><a href="forgotpassword.php">Forgot Password?? Click here!!</a> </p></th>
            
          </tr>
        </table>
        
          </form>
          <div class="cleaner h20">
            <p>Don't have an account? <a href="register.php"><strong>Sign Up</strong></a></p>
          </div>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>