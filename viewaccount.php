<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");

if(!isset($_SESSION["loginid"]))
{
	header("Location: login.php");
}

if(isset($_POST[Update]))
{
	$db_date = $_POST[dob];
$dateofbirth = date("Y-m-d", strtotime($db_date));
$dts = date("Y-m-d");

	mysqli_query($con,"UPDATE customer SET 
 custfname = '$_POST[fname]' , custlname = '$_POST[lname]' , dob = '$dateofbirth' , address = '$_POST[add]' , state = '$_POST[state]' , country ='$_POST[country]' , contactno = '$_POST[cntct]' , email = '$_POST[email]' where email = '$_SESSION[loginid]'");
 $msg = "<font color='#FF0000'><b> Account Updated Successfully<b></font>";

}
//retrieve value from customer table.
$result = mysqli_query($con,"SELECT * FROM customer where email ='$_SESSION[loginid]'");

while ($myrow = mysqli_fetch_array($result))
{
	$firstname = $myrow[custfname];
	$lastname = $myrow[custlname];
	$dob = $myrow[dob];
	$dateofbirth = date("d-m-Y", strtotime($dob));
	$dts = date("d-m-Y");
	$address = $myrow[address];
	$contact= $myrow[contactno];
	$email= $myrow[email];
}

?> 
<script type="text/javascript">
function validateviewacct()
{
	var x=document.form1.email.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	
	
	if(document.form1.fname.value=="")
	   {
		alert("First name should not be blank..");
		document.form1.fname.focus();
		return false;
	    }
	   else if(document.form1.fname.value.length<4 || document.form1.fname.value.length>11)
	    {
		alert("First name shoulld not be less than 4");
		document.form1.fname.focus();
		return false;
	      }
		  else if(document.form1.lname.value=="")
	   {
		alert("Last name should not be blank..");
		document.form1.lname.focus();
		return false;
	    }
	   else if(document.form1.lname.value.length<5 || document.form1.lname.value.length>11)
	    {
		alert("Last name should not be less than 5");
		document.form1.lname.focus();
		return false;
	      }
		 else if(document.form1.dob.value=="")
	   {
		alert("Date of birth  should not be blank..");
		document.form1.dob.focus();
		return false;
	    }
		   else if(document.form1.add.value=="")
	   {
		alert("Address should not be blank..");
		document.form1.add.focus();
		return false;
	    }
	   else if(document.form1.add.value.length<4)
	    {
		alert("Address should not be less than 4");
		document.form1.add.focus();
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
	 else if(document.form1.cntct.value=="")
	    {
		alert("contact no. should not be blank..");
		document.form1.cntct.focus();
		return false;
	      }
		else if(document.form1.cntct.value.length<5 || document.form1.cntct.value.length>11 )
  	{
		alert("Not valid number");
		document.form1.cntct.focus();
		return false; 
	}
	 else if(document.form1.email.value=="")
      {
       alert("Please enter the email id");
       document.form1.email.focus();
       return false;
     }
	else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
       alert("Not a valid e-mail address");
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
 include("sidebar.php");
 ?>
          
        </div>
        <div id="content" class="float_r">
        
        <h1>My account</h1>
        <p><font color="red">*</font><b>Enter all mandatory fields</b></p>
        <p>
          <?php
		echo $msg;
		?>
        </p>
        <form id="form1" name="form1" method="post" action="" onsubmit="return validateviewacct()">
          <table width="500" height="125" border="0">
            <tr>
              <th width="146" height="40" scope="row"><font color="red">*</font>First Name</td>
              <td width="344"><input name="fname" type="text" id="email3" value="<?php echo $firstname; ?>" size="50" onkeypress="return isNumberKey(event)"/></td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Last Name</td>
              <td><input name="lname" type="text" id="email2" value="<?php echo $lastname; ?>"size="50" onKeyPress="return isNumberKey(event)"/></td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Date of Birth</td>
              <td><script language="javascript" type="text/javascript" src="datetimepicker.js">
</script><input id="dob" name="dob" type="text" size="25" value="<?php echo $dateofbirth; ?>"><a href="javascript:NewCal('dob','ddmmyyyy')"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
</td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Address</td>
              <td><textarea name="add" id="addid " cols="45" rows="5" ><?php echo $address; ?></textarea></td>
            </tr>
            
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Contact no</td>
              <td><input name="cntct" type="text" id="contact" size="50" value="<?php echo $contact; ?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"/></td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Email Id</td>
              <td><input name="email" type="text" id="email" size="50" value="<?php echo $email; ?>"/></td>
            </tr>
            <tr>
              <th height="41" colspan="2" scope="row"><input type="submit" name="Update" id="Submit" value="Update my account "  /></td>
              
            </tr>
          </table>
        </form>
        <p>
          
        </p>
       
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>