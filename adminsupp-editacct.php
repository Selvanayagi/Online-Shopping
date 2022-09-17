<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">
function validateeditsupp()
{

	if(document.form1.cmpname.value=="")
	   {
		alert("Please enter the Company name.");
		document.form1.cmpname.focus();
		return false;
	    }
	   else if(document.form1.cmpname.value.length<4)
	    {
		alert("Company name shoulld not be less than 4");
		document.form1.cmpname.focus();
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
		if(document.form1.country.value=="")
	   {
		alert("Please select the Country.");
		document.form1.country.focus();
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
	  
	else if(document.form1.ChangePassword.checked ==false)
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
	else if(document.form1.cpswd.value.length<8 || document.form1.cpswd.value.length>15 )
	 {
		alert("Minimum characters for password is 8 and maximum character is 15");
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
}
function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode
		//alert(charCode);
         if (charCode > 65 && charCode < 91 )
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
		mysqli_query($con,"UPDATE supplier SET compname = '$_POST[cname]' ,address='$_POST[address]',state='$_POST[state]',country= '$_POST[country]',contact_no='$_POST[contact]',login_id='$_POST[email_id]',s_password='$_POST[pswd]', where supp_id ='$_POST[sup_id]'");
		$aresult = "supplier profile and password Updated successfully";
}
else
{
	mysqli_query($con,"UPDATE supplier SET compname= '$_POST[cname]' ,address='$_POST[address]',state='$_POST[state]',country= '$_POST[country]',contact_no='$_POST[contact]',login_id='$_POST[email_id]' where supp_id ='$_POST[sup_id]'");
		$aresult = "supplier profile Updated successfully";
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
$result = mysqli_query($con,"SELECT * FROM supplier where supp_id='$ids'");

while ($myrow = mysqli_fetch_array($result)) {
$supid = $myrow[supp_id];
$cimg = $myrow[complogo];
$cmpname = $myrow[compname];
$address = $myrow[address];
$state = $myrow[state];
$country = $myrow[country];
$contact = $myrow[contact_no];
$loginid = $myrow[login_id];
$password=$myrow[s_password];

}

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM supplier");
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
        <h1>Edit  Supplier Account</h1>
        <font color="red">*</font><b>Enter all mandatory fields</b>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validateeditsupp()">
          <p><?php echo $aresult; 
		  if($aresult != "supplier profile deleted successfully")
		  {
		  ?>         
</p>
          <table width="612" border="0">
            <tr>
    <th width="198" height="37"><label for="cmp_name"><font color="red">*</font>Company Name</label>
      <input name="sup_id" type="hidden" id="sup_id" size="50" value=<?php echo $supid; ?>  /></th>
    <td width="398"><input name="cmpname" type="text" id="adm_nanme" size="50" value="<?php echo $cmpname; ?>"  onkeypress="return isNumberKey(event)"/></td>
  </tr>
  <tr>
    <th height="120"><font color="red">*</font>Company Logo</th>
    <td><label for="fileField5"></label>
      <input type="file" name="fileField" id="fileField5" />
      <br />
      <img src="upload/<?php echo $cimg ; ?>" width="100" height="75"/></td>
  </tr>
  <tr>
    <th height="43"><font color="red">*</font>Address </th>
    <td><input name="address" type="text" id="adm_nanme3" size="50" value="<?php echo $address; ?>"  /></td>
  </tr>
  <tr>
    <th height="40"><font color="red">*</font>Country</th>
    <td><select name="country" id="country" onChange="getstate(this.value)">
      <option value="">Select</option>
      <option value="India">India</option>
      <option value="Australia">Australia</option>
      <option value="Sri lanka">Sri lanka</option>
      <option value="Saudi Arabia">Saudi Arabia</option>
      <option value="Japan">Japan</option>
    </select></td>
  </tr>
  <tr>
    <th height="34"><font color="red">*</font>State</th>
    <td><select name="state" id="state">
      <option value="">Select</option>
    </select></td>
  </tr>
  <tr>
    <th height="33"><font color="red">*</font>Contact no</th>
    <td><input name="contact" type="text" id="adm_nanme6" size="50" value="<?php echo $contact; ?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /></td>
  </tr>
  <tr>
    <th height="33"><label for="login2">loginl ID</label></th>
    <td><input name="login_id" type="text" id="log_id"  value="<?php echo $loginid; ?>" size="50" readonly="readonly"/></td>
  </tr>
  <tr>
    <th height="34"><font color="red">*</font>Change password
      <input type="checkbox" name="ChangePassword" id="ChangePassword" /></th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th height="36"><font color="red">*</font>Password</th>
    <td><input name="pswd" type="password" id="pswd" size="50" /></td>
  </tr>
  <tr>
    <th height="35"><label for="cpswd2"><font color="red">*</font>Confirm Password</label></th>
    <td><input name="cpswd" type="password" id="cpswd" size="50" /></td>
  </tr>
  <tr>
    <th height="40" colspan="2"><input type="submit" name="Update" id="Update" value="Update Account" />
      </th>
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
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>