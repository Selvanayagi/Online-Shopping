<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">

function validatesubcat()
{
	  if(document.form1.main_cat.value=="")
    {
     alert("Please select your main category");
       document.form1.main_cat.focus();
        return false;
    }
    else if(document.form1.cat_name.value=="")
    {
 	 alert("Category name should not be blank..... ");
 	document.form1.cat_name.focus();
 	return false;
    }
   else if(document.form1.cat_name.value.length<4)
    {
	alert("Category name shoulld not be less than 4");
	document.form1.cat_name.focus();
	return false;
    }
     
	else if(document.form1.cat_descript.value=="")
    {
    	alert("Category description should not be blank.... ");
   	document.form1.cat_descript.focus();
    	return false;
    }
	
}
/*function isNumberKey(evt)
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
	  }*/
</script>
<?php

if(isset($_POST["Submit"]))
{
	$sql="INSERT INTO category (cat_name,cat_des,maincat_id)
	VALUES
	('$_POST[cat_name]', '$_POST[cat_descript]','$_POST[main_cat]')";

	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error: ' . mysqli_error($con));
 	 }
	$resultb= "1 record added";
}

//retrieve value from category table.
$resulta = mysqli_query($con,"SELECT * FROM category where maincat_id='0'");
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
        <h1>Sub-Category        </h1>
        <form id="form1" name="form1" method="post" action="" onsubmit="return validatesubcat()">
          <h2>Enter Sub-Category Details</h2>
          <font color="red">*</font><b>Enter all mandatory fields</b>
          <p><?php echo $resultb; ?></p>
          <table width="587" border="0">
  <tr>
    <th width="221"><font color="red">*</font>Main Category</th>
    <td width="356"><select name="main_cat" id="main_cat">
      <option value="">Select</option>
      <?php
	while($row = mysqli_fetch_array($resulta))
  {
  echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
  }
?>
    </select></td>
  </tr>
  <tr>
    <th><font color="red">*</font>Category Name</th>
    <td><input name="cat_name" type="text" id="cat_name2" size="50" /></td>
  </tr>
  <tr>
    <th><font color="red">*</font>Category Description</th>
    <td><textarea name="cat_descript" id="cat_descript" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <th height="41" colspan="2" scope="row"><input type="submit" name="Submit" id="Submit" value="Submit" /></td>
    </tr>
</table>

        </form>
           <?php
    $resultq = mysqli_query($con,"SELECT * FROM category where maincat_id ='0'");

	while($rowq = mysqli_fetch_array($resultq))
  {	 
  	
	?>
        <table width="585" border="2">
                    <tr>
                      <th>Main Category name</th>
                      <td colspan="2">&nbsp; <?php echo $rowq["cat_name"] ; ?></td>
                    </tr>
                    <tr>
                    <th width="216">Sub Category name</th>
                        <th width="278">Description</th>
         <th width="67">Actions</th>
                    </tr>
                    <?php
   $resultr = mysqli_query($con,"SELECT * FROM category where maincat_id=$rowq[cat_id] ");

	while($rowr = mysqli_fetch_array($resultr))
  				{	 
                    echo "<tr>";
                     echo " <td>&nbsp; $rowr[cat_name] </td>";
                    echo "  <td>&nbsp;  $rowr[cat_des] </td>";
                    echo " <td>&nbsp;  <a href='adminsubcat-editacct.php?editid=$rowr[cat_id]'><img src='images/pencil_medium.ico' width='25' height='25'></a> <a href='adminsubcat-editacct.php?delid=$rowr[cat_id]'><img src='images/erase.ico' width='15' height='15'></a> </td>";
                   echo " </tr>";
				}
                 ?>    
                </table>
                      <br />
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