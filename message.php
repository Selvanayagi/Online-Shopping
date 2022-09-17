<?php
if(!isset($_SESSION)) { session_start(); }
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
	
	function getsubcat(catid) {		

		var strURL="getusers.php?catid="+catid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subcatdiv').innerHTML=req.responseText;						
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
   <script type="text/javascript">
function validatemsg()
{
	if(document.testform.cat.value=="")
	   {
		alert("please enter all fields");
		document.testform.cat.focus();
		return false;
	    }
	 else if(document.testform.title.value=="")
	    {
		alert("Title should not be blank..");
		document.testform.title.focus();
		return false;
	   }
       else if(document.testform.title.value.length<4)
	   {
		alert("Title shoulld not be less than 4");
		document.testform.testform.focus();
		return false;
	    }
	  else if(document.testform.message.value=="")
	    {
		alert("Message should not be blank..");
		document.testform.message.focus();
		return false;
	   }
}
	</script>
<?php
include("dbconnect.php");
$dttim = date("Y/m/d h:i:s");

//for suppliers
 if(isset($_SESSION["supp_id"]))
 {
		//$sender = $_SESSION["supp_id"];	
$sender = $_SESSION["supp_id"];

 }
if(isset($_SESSION["custid"]))
 {
		$msgtype = "CustomerAdministrator";
$result = mysqli_query($con,"SELECT * FROM message where mess_type='AdminSupplier' AND receiver_id='$_SESSION[adlogin]'");
 }
 
if(isset($_POST["Send_msg"]))
{
	 
	 if(isset($_SESSION["admin_id"]))
	{
	$sender = "Administrator";
	//header("Location: adminlogin.php");
	}	
	
	if($_POST['cat']== "Customer")
	{
		$msgtype = "AdminCustomer";
	}	
	if(isset($_SESSION["custid"]))
	{
	$msgtype = "CustomerAdministrator";
	$sender = $_SESSION["custid"];
	}
	
	if($_POST['cat']== "Suppliers")
	{	
			$msgtype = "AdminSupplier";	
	}


/*if(isset($_POST["Send_msg"]))
{
	//for suppliers
	 if(isset($_SESSION["supp_id"]))
	 {
   $sender = $_SESSION["supp_id"];
	 }
	 //for customers
	if(isset($_SESSION["loginid"]))
	 {
   $sender = $_SESSION["loginid"];
	 }
	 
	  //for administrator
	if(isset($_SESSION["admin_id"]))
	 {
   $sender = $_SESSION["admin_id"];
	 }*/

	if(isset($_SESSION["custid"]))
	{
		if($_POST[subcat] == 101)
		{
$admincat = "Administrator";
		}
	$sql="INSERT INTO message(mess_type,receiver_id,user_id,subject,description,date)
	VALUES ('$msgtype', '$admincat', '$sender','$_POST[title]','$_POST[message]','$dttim')";
	}
	elseif($_POST[cat] == "SupplierAdministrator")
	{
			 $recr = $_SESSION["supp_id"];
	$sql="INSERT INTO message(mess_type,receiver_id,user_id,subject,description,date)
	VALUES ('$_POST[cat]', 'Administrator', '$sender','$_POST[title]','$_POST[message]','$dttim')";
	}
	else
	{
	$sql="INSERT INTO message(mess_type,receiver_id,user_id,subject,description,date)
	VALUES ('$_POST[cat]', '$_POST[subcat]', '$sender','$_POST[title]','$_POST[message]','$dttim')";
	}
	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error1: ' . mysqli_error($con));
 	 }
	$result1= "Message sent successfully";
}

//retrieve value from message table.
$result = mysqli_query($con,"SELECT * FROM message");
?> 
<?php
include("header.php");
?>
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
        <?php
	//for suppliers
	 if(isset($_SESSION["supp_id"]))
	 {
   include("adminsidebar.php");
	 }
	 //for customers
	if(isset($_SESSION["loginid"]))
	 {
   include("sidebar.php");
	 }
	 
	  //for administrator
	if(isset($_SESSION["admin_id"]))
	 {
   include("adminsidebar.php");
	 }

 ?>
      </div> 
          
        </div>
        <div id="content" class="float_r">
        <h1>Message </h1>
        <form id="form1" name="testform" method="post" action="" onsubmit="return validatemsg()" >

<?php echo $result1; ?>
</br>
<a href="inbox.php">View message</a></p>
<table width="610" border="0">
  
  <tr>
    <td><?php
if(isset($_SESSION["loginid"]))
{
	//echo "To : Administrator";
	echo "<input type='hidden' name='subcat' value='101' >";
}
else
{
?>
Send to</td>
    <td>
  <?php
  //for suppliers
	 if(isset($_SESSION["supp_id"]))
	 {

   ?>
      <select name="cat" onchange="getsubcat(this.value)">
      <option value=''>Select One</option>
      <option value="SupplierCustomer">Customer</option>
      <option value="SupplierAdministrator">Administrator</option>
    </select>
   <?php
	 }
	 
	 //for customers
	if(isset($_SESSION["loginid"]))
	 {
   ?>
      <select name="cat" onchange="getsubcat(this.value)">
      <option value=''>Select One</option>
      <option value="CustomerAdministrator">Administrator</option>
    </select>
   <?php
	 }
	  //for administrator
	if(isset($_SESSION["admin_id"]))
	 {
   ?>
    <select name="cat" onchange="getsubcat(this.value)">
      <option value=''>Select One</option>
      <option value="AdministratorSupplier">Supplier</option>
      <option value="AdministratorCustomer">Customer</option>
    </select>
   <?php
	 }

 ?>
    
    
 </td>
  </tr>
  <tr>
    <td colspan="2">
    <div id="subcatdiv">
			
	</div>
<?php
}
?></td>
    </tr>
  <tr>
    <td>Title</td>
    <td><input name="title" type="text" id="title_id" size="50" /></td>
  </tr>
  <tr>
    <td>Message</td>
    <td><textarea name="message" id="msg_id" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Send_msg" id="Send" value="Send Message" /></td>
  </tr>
</table>
<p>&nbsp;</p>
          
<p>

          </p>
          <p>&nbsp;</p>
          
        </form>
       
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
     <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>