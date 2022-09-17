<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");

if(isset($_POST[Update]))
{
	mysqli_query($con,"UPDATE administrator SET name = '$_POST[adm_name]' ,email_id='$_POST[email_id]' , contact_no='$_POST[contactno]' where login_id='admin'");
$result1="<font color='#FF0000'><b>Profile updated successfully..</b></font>";
}

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM administrator where login_id='admin'");

while ($myrow = mysqli_fetch_array($result)) {
$adminname = $myrow[name];
$loginid = $myrow[login_id];
$emailid = $myrow[email_id];
$contact = $myrow[contact_no];
}
?> 
<script type="text/javascript">
function validateadminprof()
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
       alert("This is not a valid Email ID. Please re-enter.");
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
        <form id="form1" name="form1" method="post" action="" onsubmit="return validateadminprof()">
          <h2>Update Your Profile</h2>
          <font color="red">*</font><b>Enter all mandatory fields</b>
          <p><?php echo $result1; ?></p>
          <table width="500" height="125" border="0">
            <tr>
              <th width="168" height="40" scope="row"><font color="red">*</font>Admin Name</th>
              <td width="322">
              <input name="adm_name" type="text" id="adm_id" size="50" value="<?php echo $adminname; ?>" onkeypress="isNumberKey(event)"/>
              </td>
            </tr>
            <tr>
              <th height="40" scope="row">Login ID</th>
              <td>
              <input name="log_id" type="text" id="log_id" value="<?php echo $loginid; ?>" size="50" readonly="readonly" />
              </td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Email ID</th>
              <td>
              <input name="email_id" type="text" id="email_id" size="50" value="<?php echo $emailid; ?>"/>
              </td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Contact no.</th>
              <td>
              <input name="contactno" type="text" id="contactno" size="50" value="<?php echo $contact; ?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
              </td>
            </tr>
            <tr>
              <th height="41" colspan="2" scope="row"><input type="submit" name="Update" id="Update" value="Update" /></th>
              
            </tr>
          </table>
          
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h3>&nbsp;</h3>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>