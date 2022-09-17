<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");


$resultf = mysqli_query($con,"SELECT * FROM customer where email ='$_SESSION[forgotpd]'");

	while($arrrecf = mysqli_fetch_array($resultf))
	{
		$email = $arrrecf[email];
	}

if(isset($_POST[Update]))
{
$resultrr=mysqli_query($con,"UPDATE customer SET c_password = '$_POST[newpswd]' where email='$_POST[email]'");
	
$errmsgf="<font color='#00FF00'><b> Password Updated Successfully<b></font>";

}
	
include("header.php");
?>
 <script language="javascript">
function forgtuptvalidate()
{
	 if(document.form1.newpswd.value=="")
	  {
	 	alert("Password should not be blank..");
		document.form1.newpswd.focus();
		return false;
	  }
	 else if(document.form1.newpswd.value.length<8 || document.form1.newpswd.value.length>15 )
	 {
		alert("minimum charaters for password is 8 and maximum character is 15");
		document.form1.newpswd.focus();
		return false;
	 }
	 else if(document.form1.cpswd.value=="")
	{
		alert("confrim password should not be blank..");
		document.form1.cpswd.focus();
		return false;
	}
	
	else if(document.form1.newpswd.value != document.form1.cpswd.value)
	{
		alert("Password not matching..");
		document.form1.cpswd.value="";
       document.form1.newpswd.focus();
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
          <form id="form1" name="form1" method="post" action="" onsubmit="return forgtuptvalidate()">
        	<h2>Now enter your new password here.</h2>
            <p><font color="red">*</font><b>Enter all mandatory fields</b></p>
            <p>
              
              <?php echo $errmsgf; ?>
            </p>
            <table width="500" height="171" border="0">
          <tr>
            <th width="146" height="40" scope="row">
            Email Id
            </th>
            <td width="344">
            <input name="email" type="text" id="email" size="50" value="<?php echo $_GET[email]; ?>" readonly/>
            </td>
          </tr>
          
          <tr>
            <th height="40" scope="row"><font color="red">*</font>New Password</th>
            <td><input name="newpswd" type="password" id="password" size="50" /></td>
          </tr>
          <tr>
            <th height="40" scope="row"><font color="red">*</font>Confirm Password</th>
            <td><input name="cpswd" type="password" id="password2" size="50" /></td>
          </tr>
          <tr>
            <th height="41" colspan="2" scope="row">       
            <input type="submit" name="Update" id="Update" value="Update Password" class="buttonabc" /></th>
            
          </tr>
        </table>
        
          </form>
          <div class="cleaner h20">
            <p>Don't have an account? <a href="register.php"><strong>Sign Up</strong></a>          </p>
          </div>
          <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>