	<?php include("header.php"); ?>
	
<script language="javascript">
function fchk()
{
//Validation for Email ID
	ml = document.cand.txt5.value;
		pos1 = ml.indexOf("@")
		pos = ml.indexOf(" ")
		pos2 = (pos1+1)
		server = ml.substring(pos2);
		server_pos = server.lastIndexOf(".")
		reqtype = server.substring(server_pos+1)
		type_end = reqtype.substring(reqtype.length-1)
		//Email ID
//	    return false
      if(document.cand.txt1.value=="")
	{
		alert("Please enter userid");
		document.cand.txt1.focus();
		document.cand.txt1.select();
		return false;
	}
	else if(document.cand.pass.value=="")
	{
		alert("Please enter password");
		document.cand.pass.focus();
		document.cand.pass.select();
		return false;
	}
	
  else if(document.cand.pass1.value=="")
    {
alert("Please enter confirm password");
document.cand.pass1.focus();
document.cand.pass1.select();
return false;
    }
   else if(document.cand.pass.value != document.cand.pass1.value)
    {
alert("Password and confirm password is not matching");
document.cand.pass1.value="";
document.cand.pass.focus();
document.cand.pass.select();

return false;
    }

else if(document.cand.txt2.value=="")
	{
		alert("Please enter first name");
		document.cand.txt2.focus();
		document.cand.txt2.select();
		return false;
	}
   else if(document.cand.txt3.value=="")
	{
		alert("Please enter middle name");
		document.cand.txt3.focus();
		document.cand.txt3.select();
		return false;
	}
		else if(document.cand.txt4.value=="")
	{
		alert("Please enter Last name");
		document.cand.txt4.focus();
		document.cand.txt4.select();
		return false;
	}
	else if(document.cand.con.value=="")
	{
		alert("Please select your contact number");
		document.cand.con.focus();
		return false;
	}
	
	else if(document.cand.con.length<5 || document.cand.con.length>11 )
  	{
		alert("Email cannot be blank");
		return false; 
	}
	else if(ml == "")
	{
		document.cand.txt5.focus();
		document.cand.txt5.select();
		alert("Email cannot be blank");
		return false;                
	}

	else if(ml.length<8)
	{
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("Email length cannot be less than 8 characters");
			return false;  
	}
		else if(ml.indexOf("@")==-1)
		{
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("The Email Address must contain '@' sign");
			return false;  
		}
		else if(pos1<1)
		{
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("Email address cannot start with '@' sign");
			return false;  
		}  
		else if(ml.indexOf(".")==-1)
		{
			document.cand.txt5.focus();
			alert("The Email Address must contain '.' sign");
			return false;  
		}
		else if(pos!=-1)
		{
			document.cand.txt5.focus();

			alert("The Email Address cannot contain spaces");
			return false;  
		}
		else if(server.indexOf("@")!=-1)
		{
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("A valid Email must contain only one '@' sign");
			return false;  
		}
		else if(server.indexOf(".")==0)
		{
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("There should some text between '@' and '.' sign");
			return false;  
		} 
		else if(reqtype=="")
		{  
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("Email Id should end with character(like .com,.net,.org)");
			return false;  
		}
		else if(type_end.toUpperCase()<"A" || type_end.toUpperCase()>"Z")
		{
			document.cand.txt5.focus();
			document.cand.txt5.select();
			alert("Email Id should not end with number or symbol");
			return false;  
		}

else if(document.cand.dt.value=="")
    {
alert("Please select your Date of Birth");
document.cand.dt.focus();
 return false;
    }

 else if(document.cand.mnth.value=="")
    {
alert("Please select your Month of Birth");
document.cand.mnth.focus();
 return false;
    }

 else if(document.cand.yr.value=="")
    {
alert("Please select your Year of Birth");
document.cand.yr.focus();
 return false;
    }
      else if((document.cand.yr.value <= 1960)|| (document.cand.yr.value >= 1996))
    {
alert("not valid candidate");
document.location="index.php";
 return false;
    }
  else if(document.cand.gen.value=="")
    {
alert("Please select your Gender");
document.cand.gen.focus();
 return false;
    }

	else if(document.cand.addr.value=="")
	{
		alert("please enter the address");
		return false;
	}
	else if(document.cand.addr.value.length<10)
	{
		alert("please enter more than 10 character for your address");
		return false;
	}
	else if(document.cand.country.value=="")
	{
		alert("please select the country");
		return false;
	}
		else if(document.cand.rel.value=="")
	{
		alert("please select the religion");
		return false;
	}
	
   else if(document.cand.quest.value=="")
	{
		alert("please select the Secret Question");
		return false;
	}
	else if(document.cand.txt6.value=="")
	{
		alert("please enter the Secret Answer");
		return false;
	}
	else if(document.cand.ha.value=="")
	{
		alert("please enter the hear about");
		return false;
	}
	else
	{
		return true;
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
                             alert("should be alphabet");
	  	return false;
	 }
     }
</script>
<center>
<body>
<form action="candregs.php" method="post" name="cand" onsubmit="return fchk()"> 
<table border=1 width="1000"  align="center" bgcolor="#FFFFFF">
<tr>
  <th colspan="2"><b><i><font color="black">Job Seeker Registration Page</font></i></b></th></tr>
<tr> <td colspan="2"><center>All fields marked </font>'<font color="red">*</font>'are mandatory</center></tr>

<tr><td>User ID:'<font color="red">*</font>'</td><td><input type="text" name="txt1"><br>(UserID should not be less than four and more than eight char and first character must be alaphabet.)</tr>

<tr><td>Password:'<font color="red">*</font>'</td>
<td><input type="password" name="pass"><br>(Password should not be less than 4 and more than 8 character.)</tr>
<tr><td>Confirm Password:'<font color="red">*</font>'</td>
<td><input type="password" name="pass1"><br>
(Confirm your password by re-entering the password.)</tr>
<tr><td>First Name:'<font color="red">*</font>'</td>
<td><input type="text" name="txt2" onKeyPress="return isNumberKey(event)"></tr>
<tr><td>Middle Name:'<font color="red">*</font>'</td>
<td><input type="text" name="txt3" onKeyPress="return isNumberKey(event)"></tr>
<tr><td>Last Name:'<font color="red">*</font>'</td>
<td><input type="text" name="txt4"></tr>
<tr><td>Contact:'<font color="red">*</font>'</td>
<td><input type="text" name="con" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" ></tr>
<tr><td>E-mail:'<font color="red">*</font>'</td>
<td><input type="text" name="txt5"></tr>
<tr><td>Date Of Birth:'<font color="red">*</font>'</td>
<td><select name="dt">
<option value="">Date</option>
<?php
for($d=1; $d<=31; $d++)
{
echo "<option value='$d'>$d</option>";
}
?>
</select>
<select name="mnth">
<option value="">Month</option>
<?php
for($m=1; $m<=12; $m++)
{
echo "<option value='$m'>$m</option>";
}
?>
</select>
<select name="yr">
<option value="">Year</option>
<?php
for($y=1950; $y<=2005; $y++)
{
echo "<option value='$y'>$y</option>";
}
?>
</select></td></tr>
<tr><td>Gender:'<font color="red">*</font>'</td>
<td><select name="gen">
<option value="">Select the Gender</option>
<option value="Male">Male
<option value="Female">Female
</select></td></tr>
<tr><td>Address:'<font color="red">*</font>'</td>
<td><textarea name="addr" rows="5" cols="20"></textarea>
<tr><td>Country:'<font color="red">*</font>'</td>
<td><select name="country">
		<option value="">Select the Country</option>
		<option value="Austria">Austria</option>
                <option value="Australia">Australia</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Brazil">Brazil</option>
                <option value="Brunei">Brunei</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="Egypt">Egypt</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="GreenLand">GreenLand</option>
                <option value="Great Britian">Great Britian</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kenya">Kenya</option>
                <option value="Korea-North">Korea-North</option>
                <option value="Korea-South">Korea-South</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Libya">Libya</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mexico">Mexico</option>
                <option value="Nepal">Nepal</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Philippines">Philippines</option>
                <option value="Qatar">Qatar</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Singapore">Singapore</option>
                <option value="South Africa">South Africa</option>
                <option value="Spain">Spain</option>
                <option value="SriLanka">SriLanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Sweden">Sweden</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="USA">USA</option>
                <option value="Zambabwe">Zambabwe</option>
				              </SELECT>
</select></td></tr>
<tr><td>Religion:'<font color="red">*</font>'</td>
<td><select name="rel">
<option value="">Select the Religion</option>
<option value="Hindu">Hindu
<option value="Christian">Christian
<option value="Muslim">Muslim
</select></td></tr>
<td> Hint Question:'<font color="red">*</font>'</td>
<td><select name="quest"><?php 
		 include("sel.php");
		 ?>
		 </td></tr>
<tr><td>Hint Answer:'<font color="red">*</font>'</td>
<td><input type="text" name="txt6"></td></tr>
<tr><td>HearAbout:'<font color="red">*</font>'</td>
<td><select name="ha">
<option value="">Select the Source</option>
<option value="Through magazines">Through magazines
<option value="through ad's">through ad's
<option value="College Visit">College Visit
</select></td></tr>
<tr><td>IDCreatedOn:'<font color="red">*</font>'</td>
<td><label> <?php echo " &nbsp; ". date("Y-m-d"); ?> </label></td></tr>

<tr><td colspan="2">
<center>
  <input type="submit" value="submit">
    <input type="reset" value="Reset"></center></td></tr>


</table>
<?php include("footer.php");?>