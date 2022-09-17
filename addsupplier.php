<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">

function validateaddsupp()
{
   var x=document.form1.loginid.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");

     if(document.form1.compid.value=="")
    {
      alert("Please enter the Company Id.");
      document.form1.compid.focus();
      return false;
    }
  
   else if(document.form1.comp_name.value=="")
    {
 	 alert("Please enter the Company name.");
 	document.form1.comp_name.focus();
 	return false;
    }
   else if(document.form1.comp_name.value.length<4|| document.form1.comp_name.value.length>15 )
    {
	alert("Company name shoulld not be less than 4");
	document.form1.comp_name.focus();
	return false;
    }
     else if(document.form1.loginid.value=="")
      {
       alert("Please enter the Login ID.");
       document.form1.loginid.focus();
       return false;
     }
	else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
       alert("This is not a valid Login ID. Please re-enter.");
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
     alert("Minimum charaters for password is 8 and maximum characters is 15");
     document.form1.pswd.focus();
     return false;
	 }
   else if(document.form1.cpswd.value=="")
   {
	alert("Please re-enter your Password for Confrimation.");
	document.form1.cpswd.focus();
	return false;
   }
 
	else if(document.form1.pswd.value != document.form1.cpswd.value)
	{
		alert("Your Passwords does not match. Please re-enter.");
		document.form1.cpswd.value="";
        document.form1.pswd.focus();
		return false;
	}

	else if(document.form1.comp_addrs.value=="")
    {
    	alert("Please enter the Company address.");
   	document.form1.comp_addrs.focus();
    	return false;
    }
	else if(document.form1.country.value=="")
    {
   	 alert("Please select the Country.");
    	document.form1.country.focus();
    	return false;
    }
   else if(document.form1.state.value=="")
    {
   	 alert("Please select the State.");
    	document.form1.state.focus();
    	return false;
    }
   else if(document.form1.contact.value=="")
    {
	alert("Please enter the Contact no.");
	document.form1.contact.focus();
	return false;
    }
   else if(document.form1.contact.value.length<5 || document.form1.contact.value.length>11 )
  	{
		alert("Please enter a valid Contact no.");
		document.form1.contact.focus();
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

if(isset($_POST[Submit]))
{

	//upload image code starts here
if (($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg")
&& ($_FILES["file"]["size"] < 200000000))
{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
   $filename =  $_FILES["file"]["name"];
      }
    }
  }
$d = date('Y-m-d H:i:s');
	$sql="INSERT INTO supplier (compregno,compname,complogo,address,state,country,contact_no,login_id,s_password,created_at,status)
	VALUES
	('$_POST[compid]','$_POST[comp_name]','$filename','$_POST[comp_addrs]','$_POST[state]','$_POST[country]','$_POST[contact]','$_POST[loginid]','$_POST[pswd]','$d','Approved')";

	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error: ' . mysqli_error($con));
 	 }
	$result= "<font color='#FF0000'><b> 1 Supplier added </b></font>";
}


?> 

<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getstate(country) {		
		
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
        <h1>Add Supplier </h1>
        <font color="red">*</font><b>Enter all mandatory fields</b>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return validateaddsupp()">
 <p><?php echo $result; ?></p>
          <table width="569" border="0">
            <tr>
    <th width="180" height="35"><font color="red">*</font>Company ID</th>
    <td width="379"><input type="text" name="compid" id="compid" /></td>
  </tr>
  <tr>
    <th height="32"><label for="prod_name3"><font color="red">*</font>Company Name</label></th>
    <td><input type="text" name="comp_name" id="comp_name"  onkeypress="return isNumberKey(event)"/></td>
  </tr>
  <tr>
    <th height="28"><font color="red">*</font>Login ID</th>
    <td><input type="text" name="loginid" id="loginid" /></td>
  </tr>
  <tr>
    <th height="29"><font color="red">*</font>Password</th>
    <td><input type="password" name="pswd" id="pswd" /></td>
  </tr>
  <tr>
    <th height="29"><font color="red">*</font>Confirm Password</th>
    <td><input type="password" name="cpswd" id="cpswd" /></td>
  </tr>
  <tr>
    <th height="34"><font color="red">*</font>Logo</th>
    <td><input type="file" name="file" id="file" /></td>
  </tr>
  <tr>
    <th height="97"><font color="red">*</font>Company Address</th>
    <td><textarea name="comp_addrs" id="comp_addrs" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <th height="31"><font color="red">*</font>Country</th>
    <td><select name="country" id="country" onChange="getstate(this.value)">
      <option value="">Select</option>
      <option value="India">India</option>
          </select></td>
  </tr>
  <tr>
    <th height="33"><font color="red">*</font>State</th>
    <td><div id="stateids">
              <select name="state" id="state">
              <option value="">Select</option>
			  <option value="Tamilnadu">TamilNadu</option>
              </select>
          </div></td>
  </tr>
  <tr>
    <th height="36"><font color="red">*</font>Contact no.</th>
    <td><input type="text" name="contact" id="contact" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /></td>
  </tr>
  <tr>
    
    <th height="44" colspan="2">
      
        <input type="submit" name="Submit" id="Submit" value="Add Supplier" />
      </th>
  </tr>
</table>
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