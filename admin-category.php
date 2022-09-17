<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">

function validatecat()
{
    if(document.form1.cat_name.value=="")
    {
 	 alert("Please enter the Category name.");
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
    	alert("Please enter the Category description.");
   	document.form1.cat_descript.focus();
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
       alert("Characters should be alphabet only");
	  	return false;
	 }
	  }
</script>
<?php
if(isset($_POST[Submit]))
{
	$sql="INSERT INTO category (cat_name,cat_des) 	VALUES	('$_POST[cat_name]', '$_POST[cat_descript]')";

	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error: ' . mysqli_error($con));
 	 }
$results= "<font color='#FF0000'><b>1 record added</b></font>";
}

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
        <h1>Main-Category        </h1>
        <font color="red">*</font><b>Enter all mandatory fields</b>
        <form id="form1" name="form1" method="post" action="" onsubmit="return validatecat()">
          <h2>Enter Category Details</h2>
          <p><?php echo $results; ?></p>
          <table width="514" height="125" border="0">
            <tr>
              <th width="190" height="40" scope="row"><font color="red">*</font>Category Name</th>
              <td width="314">
              <input name="cat_name" type="text" id="cat_name2" size="50" onkeypress="isNumberKey(event)"/></td>
            </tr>
            <tr>
              <th height="40" scope="row"><font color="red">*</font>Category Description</th>
              <td><textarea name="cat_descript" id="cat_descript" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
              <th height="41" colspan="2" scope="row"><input type="submit" name="Submit" id="Submit" value="Submit" /></td>
              
            </tr>
          </table>
          <p>&nbsp;</p>
        </form>
        <table width="623" border="2">
                    <tr>
                    <th width="91">Category ID</th>
                      <th width="105">Category name</th>
                        <th width="92">Description</th>
         <th width="152">&nbsp;No. of <br />
           Subcategories</th>
                        <th width="105">Actions</th>
                    </tr>
     <?php
    $result = mysqli_query($con,"SELECT * FROM category where  maincat_id='0'");


while($row = mysqli_fetch_array($result))
  {
	    $resultx = mysqli_query($con,"SELECT * FROM category where  maincat_id='$row[cat_id]'");
		 $countsc = mysqli_num_rows($resultx); 
  echo "<tr>";
  echo "<td>" . $row['cat_id'] . "</td>";
  echo "<td>" . $row['cat_name'] . "</td>";
  echo "<td>" . $row['cat_des'] . "</td>";
  echo "<td align='center'>" . $countsc . "</td>";
  echo "<td><a href='admincat-editacct.php?adid=$row[cat_id]'><img src='images/pencil_medium.ico' width='25' height='25'></a> <a href='admincat-editacct.php?delid=$row[cat_id]'> <img src='images/erase.ico' width='15' height='15'></a></td>";
  
  echo "</tr>";
  }


?>

                    
                </table>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>