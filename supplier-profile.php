<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["splogin"])))
{
	header("Location: supplierlogin.php");
}
include("dbconnect.php");

if(isset($_POST[Update]))
{
      move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
	$filename =  $_FILES["file"]["name"];

	if($filename != "")
	{
		mysqli_query($con,"UPDATE supplier SET compname = '$_POST[comp_name]', contact_no='$_POST[contactno]',complogo = '$filename', address = '$_POST[comp_addrs]', state = '$_POST[state]', country = '$_POST[country]' where login_id='$_SESSION[splogin]'");
		if(mysqli_affected_rows() == 1)
		{
		$result1="<font color='#FF0000'><b> Profile updated successfully.</b></font>";
		}
	}
	else
	{
		mysqli_query($con,"UPDATE supplier SET compname = '$_POST[comp_name]', contact_no='$_POST[contactno]',address = '$_POST[comp_addrs]', state = '$_POST[state]', country = '$_POST[country]' where login_id='$_SESSION[splogin]'");
		if(mysqli_affected_rows() == 1)
		{
		$result1="Profile updated successfully...";
		}	
	}
}


//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM supplier where login_id='$_SESSION[splogin]'");

while ($myrow = mysqli_fetch_array($result))
{
$compname = $myrow[compname];
$loginid = $myrow[login_id];
$complogoa = $myrow[complogo];
$contact = $myrow[contact_no];
$addrs = $myrow[address];
$country = $myrow[country];
$state = $myrow[state];
}
?> 
<script type="text/javascript">
function validatespprof()
{
	 if(document.form1.comp_name.value=="")
	   {
		alert("company name should not be blank..");
		document.form1.comp_name.focus();
		return false;
	    }
	   else if(document.form1.comp_name.value.length<4)
	    {
		alert("Company name shoulld not be less than 4");
		document.form1.comp_name.focus();
		return false;
	      }
		else if(document.form1.comp_addrs.value=="")
	   {
		alert("Company address should not be blank..");
		document.form1.comp_addrs.focus();
		return false;
	    }
	   else if(document.form1.comp_addrs.value.length<4)
	    {
		alert("Company address shoulld not be less than 4");
		document.form1.comp_addrs.focus();
		return false;
	      }  
	else if(document.form1.country.value=="")
    {
      alert("Please select your country");
       document.form1.country.focus();
         return false;
    }
	else if(document.form1.state.value=="")
    {
            alert("Please select your state");
           document.form1.state.focus();
          return false;
    }
	 else if(document.form1.contactno.value=="")
	    {
		alert("contact no. should not be blank..");
		document.form1.contactno.focus();
		return false;
	      }
		else if(document.form1.contactno.value.length<5 || document.form1.contactno.value.length>11 )
  	{
		alert("Not valid number");
		document.form1.contactno.focus();
		return false; 
	}
	  
}
</script>
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
         alert("should be alphabet");
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
        <h1>Supplier Profile </h1>
        <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" onsubmit="return validatespprof()">
          <h2>Update Your Profile</h2>
          <font color="red">*</font><b>Enter all mandatory fields</b>
          <p><?php echo $result1; ?>
          </p>
          <table width="529" border="0">
            <tr>
              <th width="191" height="35" scope="row"><font color="red">*</font>Login ID</th>
              <td width="328"><input name="log_id" type="text" id="log_id" value="<?php echo $loginid; ?>" size="50" readonly="readonly" /></td>
            </tr>
            <tr>
              <th height="36" scope="row"><label for="comp_name"><font color="red">*</font>Company Name</label></th>
              <td><input name="comp_name" type="text" id="comp_id" size="50" value="<?php echo $compname; ?>" onkeypress="isNumberKey(event)-"/></td>
            </tr>
            <tr>
              <th height="188" scope="row"><font color="red">*</font>Logo</th>
              <td><input type="file" name="file" id="file" />
              <br />
              <?php
	
			  if($complogoa=="")
			  {
			  	$clogo = "images/noimage.jpg";
			  }
			  else
			  {
				$clogo = "upload/".$complogoa ;
			  }
			  ?>
              <img src="<?php echo $clogo;?>" width="158" height="148" /></td>
            </tr>
            <tr>
              <th height="98" scope="row"><font color="red">*</font>Company Address </th>
              <td><textarea name="comp_addrs" id="comp_addrs" cols="45" rows="5"><?php echo $addrs; ?></textarea></td>
            </tr>
            <tr>
              <th height="35" scope="row"><font color="red">*</font>Country</th>
              <td>
              <select name="country" id="country" onChange="getstate(this.value)">
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
       </select>
              </td>
            </tr>
            <tr>
              <th height="34" scope="row"><font color="red">*</font>State</th>
              <td>
              <div id="stateids">
              <select name="state" id="state" >
              <?php
		       echo "<option value='$state' selected>$state</option>";
			 ?>
              </select>
              </div></td>
            </tr>
            <tr>
              <th height="32" scope="row"><label for="contactno2"><font color="red">*</font>Contact no.</label>              </th>
              <td><input name="contactno" type="text" id="contactno" size="50" value="<?php echo $contact; ?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /></td>
            </tr>
            <tr>
                
              <th height="34" colspan="2"><input type="submit" name="Update" id="Update" value="Update" /></th>
            </tr>
          </table>
       
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