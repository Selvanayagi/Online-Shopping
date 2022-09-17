<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">
function validateadminedit()
{
	var x=document.form1.email_id.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");

	if(document.form1.adm_name.value=="")
	   {
		alert("Please enter the Admin name.");
		document.form1.adm_name.focus();
		return false;
	    }
	   else if(document.form1.adm_name.value.length<4)
	    {
		alert("Admin name shoulld not be less than 4");
		document.form1.adm_name.focus();
		return false;
	      }
		 
	 else if(document.form1.email_id.value=="")
      {
       alert("Please enter the Email ID");
       document.form1.email_id.focus();
       return false;
     }
	else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
       alert("This is not a valid Login ID. Please re-enter.");
        return false;
    }
	 else if(document.form1.contactno.value=="")
	    {
		alert("Please enter the Contact no.");
		document.form1.contactno.focus();
		return false;
	      }
		else if(document.form1.contactno.value.length<5 || document.form1.contactno.value.length>11 )
  	{
		alert("Please enter a valid Contact no.");
		document.form1.contactno.focus();
		return false; 
	}
	
	
	if(document.form1.ChangePassword.checked == true)
	{
			 if(document.form1.ChangePassword.checked ==false)
		   {
				alert("Please enter all the details");
				return false;
		   }
		   else if(document.form1.pswd.value=="")
		  {
			alert("Please enter the Password.");
			document.form1.pswd.focus();
			return false;
		  }
		 else if(document.form1.pswd.value.length<8 || document.form1.pswd.value.length>15 )
		 {
			alert("Minimum characters for password is 8 and maximum character is 15");
			document.form1.pswd.focus();
			return false;
		 }
		 else if(document.form1.cpswd.value=="")
		{
			alert("Please re-enter your Password for Confrimation.");
			document.form1.cpswd.focus();
			return false;
		}
		else if(document.form1.pswd.value.length<8 || document.form1.pswd.value.length>15 )
		 {
			alert("minimum charaters for password is 8 and maximum character is 15");
			document.form1.pswd.focus();
			return false;
		 }
		else if(document.form1.pswd.value != document.form1.cpswd.value)
		{
			alert("Your Passwords does not match. Please re-enter.");
			document.form1.cpswd.value="";
		    document.form1.pswd.focus();
			return false;
		}
	}
	
}
function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode
		//alert(charCode);
         if (charCode >=65 && charCode < 91 )
      	 {              
		 return true;
	 }
	 else if (charCode > 96 && charCode < 122 )
      	 {
		 return true;
	 }
	 else
	 {
        alert("Characters Should be alphabet only");
	  	return false;
	 }
	  }
</script>
<?php

$aresult="";
if(isset($_POST[Update]))
{


if($_POST["ChangePassword"]=="on")
{
		mysqli_query($con,"UPDATE administrator SET name = '$_POST[adm_name]' ,a_password='$_POST[pswd]',email_id='$_POST[email_id]', contact_no='$_POST[contactno]' where login_id='$_POST[login_id]'");
		$aresult = "<font color='#FF0000'><b>Admin profile and password Updated successfully</b></font>";
}
else
{
	mysqli_query($con,"UPDATE administrator SET name = '$_POST[adm_name]' ,email_id='$_POST[email_id]', contact_no='$_POST[contactno]' where login_id='$_POST[login_id]'");
		$aresult = "<font color='#FF0000'><b>Admin profile Updated successfully</b></font>";
}

}
if(isset($_POST[Delete]))
{
mysqli_query($con,"DELETE FROM administrator where  login_id='$_POST[login_id]'");
$aresult = "<font color='#FF0000'><b>Admin profile deleted successfully</b></font> <br><a href='admin-accounts.php'>Click here to view admin account</a>";
}
if(isset($_GET[adid]))
{
	$ids =$_GET[adid];
}
else if(isset($_GET[delid]))
{
	$ids =$_GET[delid];
}


//retrieve value from administrator table.
$result = mysqli_query($con,"SELECT * FROM administrator where admin_id='$ids'");

while ($myrow = mysqli_fetch_array($result)) {
$adminname = $myrow[name];
$loginid = $myrow[login_id];
$password=$myrow[a_password];
$emailid = $myrow[email_id];
$contact = $myrow[contact_no];
}

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM administrator");
?> 


<?php
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
        <form id="form1" name="form1" method="post" action="" onsubmit="return validateadminedit()">
          <h2>Edit Admin Account</h2>
           <font color="red">*</font><b>Enter all mandatory fields</b>
          <p><?php echo $aresult; 
		  if($aresult != "Admin profile deleted successfully")
		  {
		  ?></p>
          <table width="610" border="0">
  <tr>
    <th width="221" height="28"><font color="red">*</font>Name</th>
    <td width="379"><input name="adm_name" type="text" id="adm_nanme" size="50" value=<?php echo $adminname; ?>  onkeypress="return isNumberKey(event)"/></td>
  </tr>
  <tr>
    <th height="31"><label for="logl_id"><font color="red">*</font>Login ID</label></th>
    <td><input name="login_id" type="text" id="log_id"  value="<?php echo $loginid; ?>" size="50" readonly="readonly"/></td>
  </tr>
  <tr>
    <th height="32"><?php
           if(isset($_GET["adid"]))
           {
           ?>
Change password
  <input type="checkbox" name="ChangePassword" id="ChangePassword" /></th>
    <th>&nbsp;</th>
    </tr>
  <tr>
    <th height="31"><font color="red">*</font>Password</th>
    <td><input name="pswd" type="password" id="pswd" size="50" /></td>
  </tr>
  <tr>
    <th height="30"><font color="red">*</font>Confirm Password</th>
    <td><input name="cpswd" type="password" id="cpswd" size="50" />
      <?php
          }
          ?></td>
  </tr>
  <tr>
    <th height="30"><font color="red">*</font>Email ID</th>
    <td><input name="email_id" type="text" id="email_id" size="50" value=<?php echo $emailid; ?> /></td>
  </tr>
  <tr>
    <th height="36"><font color="red">*</font>Contact no.</th>
    <td><input name="contactno" type="text" id="contactno" size="50" value=<?php echo $contact; ?> onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /></td>
  </tr>
  <tr>
    <th height="36" colspan="2"><?php
           if(isset($_GET["adid"]))
           {
           ?>
      <input type="submit" name="Update" id="Update" value="Update Account" />
      <?php
           }
           else if(isset($_GET["delid"]))
           {
           ?>
      <input type="submit" name="Delete" id="Delete" value="Delete" />
      <?php
            }
		  }
            ?></th>
    </tr>
</table>

          <p>&nbsp;</p>
</form>
        
        <p>&nbsp;</p>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>