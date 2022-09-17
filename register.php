<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");
?>
<script type="text/javascript">
function validateform()
{
	var x=document.form1.email.value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
	
	if(document.form1.fname.value=="")
	   {
		alert("Please enter your First name.");
		document.form1.fname.focus();
		return false;
	    }
	   else if(document.form1.fname.value.length<4)
	    {
		alert("First name shoulld not be less than 4");
		document.form1.fname.focus();
		return false;
	      }
		  else if(document.form1.add.value.length<10)
	    {
		alert("Address shoulld not be less than 20");
		document.form1.fname.focus();
		return false;
	      }
	   else if(document.form1.lname.value=="")
	    {
		alert("Please enter the Last name.");
		document.form1.lname.focus();
		return false;
	   }
       else if(document.form1.lname.value.length<4)
	   {
		alert("Last name shoulld not be less than 4");
		document.form1.lname.focus();
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
	  else if(document.form1.email.value=="")
      {
       alert("Please enter your Email ID");
       document.form1.email.focus();
       return false;
     }
	else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
       alert("This is not a valid Email ID. Please re-enter.");
        return false;
    }
	  else if(document.form1.password.value=="")
	  {
	 	alert("Please enter your Password.");
		document.form1.password.focus();
		return false;
	  }
	 else if(document.form1.password.value.length<8 || document.form1.password.value.length>15 )
	 {
		alert("Minimum characters for password is 8 and maximum character is 15");
		document.form1.password.focus();
		return false;
	 }
	 else if(document.form1.cpassword.value=="")
	{
		alert("Please re-enter your Password for Confrimation.");
		document.form1.cpassword.focus();
		return false;
	}
	
	else if(document.form1.password.value != document.form1.  cpassword.value)
	{
		alert("Your Passwords does not match. Please re-enter.");
		document.form1.cpassword.value="";
       document.form1.password.focus();
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
$d = date('Y-m-d H:i:s');
$results=mysqli_query($con,"INSERT INTO customer (custfname,custlname,dob,address,contactno,email,c_password,created_at)
VALUES
('$_POST[fname]','$_POST[lname]','$_POST[dob]','$_POST[add]','$_POST[contact]','$_POST[email]','$_POST[password]','$d')");
$querry = mysqli_query($con,$result);
}
?> 

<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<?php
			include("cssidebar.php");
			?>
        </div>
        <div id="content" class="float_r">
        <h1>Registration        </h1>
        <p>
          <?php
        if(isset($_POST["Submit"]))
		{
			echo "<font color='#FF0000'><b> Registered successfully</b></font>";
		}
		else
		{
?>
          
        </p>
        <form  id="form1" name="form1" method="post" action=""  onsubmit="return validateform()">
       	  <h2>Sign up for FREE!</h2>
          <font color="red">*</font><b>Enter all mandatory fields</b>
        <table width="500" height="233" border="0" >
        <tr>
        <th width="206" scope="row">
        <p> <font color="red">*</font>Name
        </th>
        <td width="297">
          <input name="fname" type="text" id="fname" size="20" onkeypress="isNumberKey(event)" /> 
          <input name="lname" type="text" id="lname" size="20" onkeypress="isNumberKey(event)" />
          </td>
          </tr>
        </p>
        
        <tr>
        <th scope="row">
        <p><font color="red">*</font>Contact No. 
        </th>
        <td>
          <input name="contact" type="text" id="contact" size="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
          </td>
          </tr>
        </p>
        
        <tr>
        <th scope="row">
        <p><font color="red">*</font>Email Address</th>
        <td>
  <input name="email" type="text" id="email" size="50" />
  		</td>
        </tr>
        </p>
		<p>
		<tr>
              <th height="40" scope="row"><font color="red">*</font>Date of Birth</td>
              <td><script language="javascript" type="text/javascript" src="datetimepicker.js">
</script><input id="dob" name="dob" type="text" size="25" value="<?php echo $dateofbirth; ?>"><a href="javascript:NewCal('dob','ddmmyyyy')"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
</td>
            </tr>
			</p>
		<p>
		<tr>
              <th height="40" scope="row"><font color="red">*</font>Address</td>
              <td><textarea name="add" id="addid " cols="45" rows="5" ><?php echo $address; ?></textarea></td>
            </tr>
        </p>
        <tr>
        <th scope="row">
        <p>  <font color="red">*</font>Password</th>
        <td>
          <input name="password" type="password" id="password" size="50" />
          </td>
          </tr>
        </p>
        
        <tr>
        <th scope="row">
        <p><font color="red">*</font>Confirm Password
        </th>
        <td>
          <input name="cpassword" type="password" id="cpassword" size="50" />
          </td>
         </tr>
        </p>
     <tr>
     <th height="44" colspan="2" scope="row">
          <input type="submit" name="Submit" id="Submit" value="Sign Up Now"  />
          </th>
          </tr>
          </table>
        </form>
        <?php
		}
		?>
        <p>&nbsp;</p>
<div class="cleaner h20">
  <p>&nbsp;</p>
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