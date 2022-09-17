<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>

<script type="text/javascript">
function validateeditcust()
{
	var x=document.form1.email_id.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	
	if(document.form1.cfirstname.value=="")
	   {
		alert("Please enter the First name.");
		document.form1.cfirstname.focus();
		return false;
	    }

	   else if(document.form1.cfirstname.value.length<4 || document.form1.cfirstname.value.length>11)
	    {
		alert("Customer First name should not be less than 4");
		document.form1.cfirstname.focus();
		return false;
	      }
	   else if(document.form1.clastname.value=="")
	    {
		alert("Please enter the Last name.");
		document.form1.clastname.focus();
		return false;
	   }
       else if(document.form1.clastname.value.length<4 || document.form1.clastname.value.length>11)
	   {
		alert("Customer Last name should not be less than 4");
		document.form1.clastname.focus();
		return false;
	    }		
		else if(document.form1.dob.value=="")
	    {
		alert("Please enter the Date of birth.");
		document.form1.dob.focus();
		return false;
	   }
		else if(document.form1.address.value=="")
	   {
		alert("Please enter the Address.");
		document.form1.address.focus();
		return false;
	    }
	   else if(document.form1.state.value=="")
	    {
		alert("Please select the State.");
		document.form1.state.focus();
		return false;
	   }
		else if(document.form1.country.value=="")
	   {
		alert("Please select the Country.");
		document.form1.country.focus();
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
			alert("Please re-enter the Password for Confrimation.");
			document.form1.cpswd.focus();
			return false;
		}
		else if(document.form1.cpswd.value.length<8 || document.form1.cpswd.value.length>15 )
		 {
			alert("Minimum characters for password is 8 and maximum character is 15");
			document.form1.cpswd.focus();
			return false;
		 }
		else if(document.form1.pswd.value != document.form1.cpswd.value)
		{
			alert("The Passwords does not match. Please re-enter.");
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
			if (charCode >= 65 && charCode < 91 )
			{              
				 return true;
			 }
			 else if (charCode > 96 && charCode < 122 )
				 {
				 return true;
			 }
			 else
			 {
				alert("Characters Should be alphabet only.");
				return false;
			 }
	  }

</script>
<script language="javascript" type="text/javascript">
function getXMLHTTP()
{ 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)
		{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
					}
		
		}
	return xmlhttp;
}
	
	function getstate(country) 
	{		
		
		var strURL="getstate.php?country="+country;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('stateids').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
</script>
<script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>
<?php

if(isset($_POST[Update]))
{
$db_date = $_POST[dob];
$dateofbirth = date("d-m-Y", strtotime($db_date));
$dts = date("d-m-Y");

	if($_POST["ChangePassword"]=="on")
	{
		mysqli_query($con,"UPDATE customer SET custfname= '$_POST[cfirstname]' ,custlname= '$_POST[clastname]' ,dob='$bdate',address='$_POST[address]',state='$_POST[state]',country= '$_POST[country]',contactno='$_POST[contact]',email='$_POST[email_id]',c_password='$_POST[pswd]' where custid ='$_POST[cids]'");
		$cresult = "<font color='#FF0000'><b>Customer profile and password Updated successfully</b></font>";
	}
	else
	{
mysqli_query($con,"UPDATE customer SET custfname= '$_POST[cfirstname]' ,custlname= '$_POST[clastname]' ,dob='$bdate',address='$_POST[address]',state='$_POST[state]',country= '$_POST[country]',contactno='$_POST[contact]',email='$_POST[email_id]' where custid ='$_POST[cids]'");
		$cresult = "<font color='#FF0000'><b>Customer profile Updated successfully</b></font>";
	}

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
$mresult = mysqli_query($con,"SELECT * FROM customer where custid='$ids'");

while ($myrow = mysqli_fetch_array($mresult)) {
$firstname = $myrow[custfname];
$lastname = $myrow[custlname];
$dob = $myrow[dob];
$address = $myrow[address];
$state = $myrow[state];
$country = $myrow[country];
$contact = $myrow[contactno];
$emailid = $myrow[email];
$password=$myrow[c_password];

}

//retrieve value from category table.
$mresult = mysqli_query($con,"SELECT * FROM customer");
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
        <form id="form1" name="form1" method="post" action="" onsubmit="return validateeditcust()">
          <h2>Edit  Customer Account</h2>
          <font color="red">*</font><b>Enter all mandatory fields</b>
          <p><?php echo $cresult; 
		  if($cresult != "customer profile deleted successfully")
		  {
		  ?></p>
          <table width="598" border="0">
  <tr>
    <th width="170" height="35"><label for="adm_name"><font color="red">*</font>First Name</label>
      <input name="cids" type="hidden" id="cids" size="50" value="<?php echo $_GET[adid]; ?>"  /></th>
    <td width="412">
    <input name="cfirstname" type="text" id="adm_nanme" size="50" value="<?php echo $firstname; ?>" onkeypress="return isNumberKey(event)" />
    </td>
  </tr>
  <tr>
    <th height="31"><font color="red">*</font>Last  Name</th>
    <td><input name="clastname" type="text" id="clastnanme" size="50" value="<?php echo $lastname; ?>" /></td>
  </tr>
  <tr>  
    <th height="36"><font color="red">*</font>Date of Birth</th>
    <td>
	
<input id="dob" name="dob" type="text" size="25" value="<?php echo $dob; ?>">
<a href="javascript:NewCal('dob','ddmmyyyy')"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
</td>
  </tr>
  <tr>
    <th height="33"><font color="red">*</font>Address</th>
    <td><input name="address" type="text" id="adm_nanme3" size="50" value="<?php echo $address; ?>"  /></td>
  </tr>
  <tr>
    <th height="33"><font color="red">*</font>Country</th>
    <td><select name="country" id="country" onChange="getstate(this.value)">
              <?php
			  $arr  = array("India","Australia","Sri lanka","Saudi Arabia","Japan");
			  ?>
         <option value="">Select</option>
         <?php
         foreach($arr as $value)
		 {
			 if($value == $country)
			 {
		       echo "<option value='$value' selected>$value</option>";
			 }
			 else
			 {
			   echo "<option value='$value'>$value</option>";
			 }
		 }
       ?>
       </select></td>
  </tr>
  <tr>
    <th height="35"><font color="red">*</font>State</th>
    <td><div id="stateids">
              <select name="state" id="state" >
              <?php
		       echo "<option value='$state' selected>$state</option>";
			 ?>
              </select>
              </div></td>
  </tr>
  <tr>
    <th height="36">Contact no </th>
    <td><input name="contact" type="text" id="adm_nanme6" size="50" value="<?php echo $contact; ?>" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /></td>
  </tr>
  <tr>
    <th height="32"><label for="email2"><font color="red">*</font>Email ID</label></th>
    <td><input name="email_id" type="text" id="log_id"  value="<?php echo $emailid; ?>" size="50"readonly="readonly"/></td>
  </tr>
  <tr>
    <th height="36"><div class="cleaner">Change password
  <input type="checkbox" name="ChangePassword" id="ChangePassword" />
</div></th>
    <th>&nbsp;</th>
    </tr>
  <tr>
    <th height="34"><font color="red">*</font>Password</th>
    <td><input name="pswd" type="password" id="pswd" size="50" /></td>
  </tr>
  <tr>
    <th height="32"><font color="red">*</font>Confirm Password</th>
    <td><input name="cpswd" type="password" id="cpswd" size="50" /></td>
  </tr>
  <tr>
    
    <th height="37" colspan="2"><input type="submit" name="Update" id="Update" value="Update Account" /></th>
  </tr>
          </table>
          <p>&nbsp;</p>
</form>
        <?php
		  }
		  ?>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h3>&nbsp;</h3>

</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>