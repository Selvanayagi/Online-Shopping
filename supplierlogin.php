<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(isset($_SESSION["splogin"]))
{
	header("Location: supplierac.php");
}

if(isset($_POST[Supplierlogin]))
{

	$resultsupp = mysqli_query($con,"SELECT * FROM supplier where login_id='$_POST[email]' and s_password ='$_POST[password]'");
    if(mysqli_num_rows($resultsupp) == 1)
	{
			$dt = date('Y-m-d H:i:s');
	$result1 = mysqli_query($con,"UPDATE supplier SET lastlogin='$dt' where login_id='$_POST[email]'");
		$arroes = mysqli_fetch_array($resultsupp);
		$_SESSION["supp_id"] 	=$arroes["supp_id"];
		$_SESSION["compregno"] 	=$arroes["compregno"];
		$_SESSION["compname"]	 =$arroes["compname"];
		$_SESSION["complogo"] =$arroes["complogo"];
		$_SESSION["address"] =$arroes["address"];
		$_SESSION["state"] =$arroes["state"];
		$_SESSION["country"] =$arroes["country"];
		$_SESSION["lastlogin"] =$arroes["lastlogin"];
		$_SESSION["created_at"] =$arroes["created_at"];
		$_SESSION["status"] =$arroes["status"];
		$_SESSION["splogin"] = $_POST["email"];
	header("Location: supplierac.php");
	}
	else
	{
		$errmsg =  "<font color='#FF0000'><b> Invalid Id or password entered.. Please try again..<b></font>";
	}
}

?> 
<script language="javascript">
function validatesplogin()
{
	var x=document.form1.email.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	if(document.form1.email.value=="")
	{
		alert("Please enter Email id");
		document.form1.email.focus();

		return false;
	}
	else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
       alert("Not a valid e-mail address");
        return false;
    }
	
	else if(document.form1.password.value=="")
	{
		alert("Please enter password");
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
		<?php include("categorysidebar.php"); ?>
        </div>
        <div id="content" class="float_r">
        <h1>Supplier Login</h1>
          <form id="form1" name="form1" method="post" action="" onsubmit="return validatesplogin()">
        	<h2>Please enter userid and password</h2>
            <font color="red">*</font><b>Enter all mandatory fields</b>
            <p><?php echo $errmsg; ?></p>
            <table width="508" border="0">
  <tr>
    <th width="121" height="36"><font color="red">*</font>Email Id:</th>
    <td width="371"><input name="email" type="text" id="email" size="50" /></td>
  </tr>
  <tr>
    <th><p>&nbsp;</p>
      <p> <font color="red">*</font>Password:</p></th>
    <td><input name="password" type="password" id="password" size="50" /></td>
  </tr>
  <tr>
    <th height="35">&nbsp;</th>
    <td><input type="submit" name="Supplierlogin" id="Supplierlogin" value="Login here" /></td>
  </tr>
</table>

            <p>&nbsp;</p>
          </form>
        <p>&nbsp;</p>
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