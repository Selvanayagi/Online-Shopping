<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<?php
if(isset($_GET[delid]))
{
mysqli_query($con,"DELETE FROM administrator where  admin_id='$_GET[delid]'");

$aresult = "<font color='#FF0000'><b>Administrator profile deleted successfully </b> </font><br>";

}

$retcomp = mysqli_query($con,"select * from supplier ");
?>
<script type="text/JavaScript">
 
function confirmDelete(){
var agree=confirm("Are you sure you want to delete this Admin?");
if (agree)
     return true;
else
     return false ;
}
</script>
<script type="text/javascript">
function validateadminacct()
{
	var x=document.form1.email_id.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	
	if(document.form1.admin_name.value=="")
	   {
		alert("Please enter the Admin name.");
		document.form1.admin_name.focus();
		return false;
	    }
	   else if(document.form1.admin_name.value.length<4)
	    {
		alert("Admin name shoulld not be less than 4");
		document.form1.admin_name.focus();
		return false;
	      }
		 else if(document.form1.login_id.value=="")
      {
       alert("Please enter the Login ID");
       document.form1.login_id.focus();
       return false;
     }
	
	  else if(document.form1.password.value=="")
	  {
	 	alert("Please enter the Password.");
		document.form1.password.focus();
		return false;
	  }
	 else if(document.form1.password.value.length<8 || document.form1.password.value.length>15 )
	 {
		alert("Minimum character for password is 8 and Maximum character is 15");
		document.form1.password.focus();
		return false;
	 }
	 else if(document.form1.Confirm_password.value=="")
	{
		alert("Please re-enter your Password for Confrimation.");
		document.form1.Confirm_password.focus();
		return false;
	}
	else if(document.form1.Confirm_password.value.length<8 || document.form1.Confirm_password.value.length>15 )
	 {
		alert("Minimum character for password is 8 and Maximum character is 15");
		document.form1.Confirm_password.focus();
		return false;
	 }
	else if(document.form1.password.value != document.form1.  Confirm_password.value)
	{
		alert("Your Passwords does not match. Please re-enter.");
		document.form1.Confirm_password.value="";
        document.form1.password.focus();
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
       alert("This is not a valid E-mail ID.");
        return false;
    }
	 else if(document.form1.contactno.value=="")
	    {
		alert("Please enter the Contact no..");
		document.form1.contactno.focus();
		return false;
	    }
		else if(document.form1.contactno.value.length<5 || document.form1.contactno.value.length>11 )
  	{
		alert("Please enter a valid Contact no.");
		document.form1.contactno.focus();
		return false; 
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
         alert("Characters should be alphabet only");
	  	return false;
	 }
}
</script>
<?php
if(isset($_POST[Addadmin]))
{

$sql="INSERT INTO administrator (name,login_id,a_password,email_id,contact_no)
VALUES
('$_POST[admin_name]', '$_POST[login_id]' ,'$_POST[password]','$_POST[email_id]','$_POST[contactno]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
$resultad = "<font color='#FF0000'><b>1 Admin added</b></font>";


}
if(!(isset($_SESSION["adlogin"])))
{
	//header("Location: adminlogin.php");
}

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
        <h1>Admin Account</h1>
 <?php
 echo $resultad;
 ?>
 </br>
<font color="red">*</font><b>Enter all mandatory fields</b>

<form id="form1" name="form1" method="post" action="" onsubmit="return validateadminacct()">
  <table width="500" height="125" border="0">
    <tr>
      <th width="168" height="40" scope="row"><font color="red">*</font>Admin Name</th>
      <td width="322">
      <input name="admin_name" type="text" id="admin_name" size="50" onkeypress="isNumberKey(event)"/>
      </td>
    </tr>
    <tr>
      <th height="40" scope="row"><font color="red">*</font>Login Id</th>
      <td><input name="login_id" type="text" id="login_id" size="50"  /></td>
    </tr>
    <tr>
      <th height="40" scope="row"><font color="red">*</font>Password</th>
      <td><input name="password" type="password" id="password" size="50" /></td>
    </tr>
    <tr>
      <th height="40" scope="row"><font color="red">*</font>Confirm password</th>
      <td><input name="Confirm_password" type="password" id="Confirm_password" size="50" /></td>
    </tr>
    <tr>
      <th height="40" scope="row"><font color="red">*</font>Email Id</th>
      <td><input name="email_id" type="text" id="email_id" size="50" /></td>
    </tr>
    <tr>
      <th height="40" scope="row"><font color="red">*</font>Contact No</th>
      <td><input name="contactno" type="text" id="contactno" size="50" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /></td>
    </tr>
    <tr>
      <th height="41" colspan="2" scope="row">
      <input type="submit" name="Addadmin" id="Addadmin" value="Add" />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="reset" name="refresh" id="refresh" value="Reset" /></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <label for="login_id"></label>
  </p>
  <p>&nbsp;</p>
</form>

        
        </p>
        <table width="580" border="2">
                    <tr>
                      <th width="126">Admin name</th>
                        <th width="91">Login ID</th>
         				<th width="100">Email ID</th>
                        <th width="101">Contact no.</th>
                <?php
                if($_SESSION["admin_id"] == "101")      
				{
                 echo "<th width='126'>Edit</th>";
				}
				?>
                    </tr>
           
                  
     <?php
    $result = mysqli_query($con,"SELECT * FROM administrator where admin_id!=101");

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['login_id'] . "</td>";
  echo "<td>" . $row['email_id'] . "</td>";
  echo "<td>" . $row['contact_no'] . "</td>";
   if($_SESSION["admin_id"] == "101")      
 {
    echo "<td><a href='admin-editaccnt.php?adid=$row[admin_id]'>
	<img src='images/pencil_medium.ico' width='25' height='25'></a> 
	<a href='admin-accounts.php?delid=$row[admin_id]' onclick='return confirmDelete()'> 
	<img src='images/erase.ico' width='15' height='15'></a></td>";
  }
  echo "</tr>";
  }


?>

                    
          </table>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>