<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">

function validateeditcat()
{
   if(document.form1.cat_id.value=="")
    {
      alert("Category Id should not be blank... ");
      document.form1.cat_id.focus();
      return false;
    }
  
   else if(document.form1.catname.value=="")
    {
 	 alert("Please enter the Category name. ");
 	document.form1.catname.focus();
 	return false;
    }
   else if(document.form1.catname.value.length<4)
    {
	alert("Category name shoulld not be less than 4");
	document.form1.catname.focus();
	return false;
    }
     
	else if(document.form1.description.value=="")
    {
    	alert("Please enter the Category description. ");
   	document.form1.description.focus();
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
if(isset($_POST["Update"]))
{
	mysqli_query($con,"UPDATE category SET cat_name = '$_POST[catname]',cat_des='$_POST[description]' where cat_id='$_POST[cat_id]'");
		$aresult = "<font color='#FF0000'><b>Category Updated successfully</b></font>";


}
if(isset($_POST["Delete"]))
{
mysqli_query($con,"DELETE FROM category where cat_id='$_POST[cat_id]'");
$affrows = mysqli_affected_rows();
mysqli_query($con,"DELETE FROM category where maincat_id='$_POST[cat_id]'");

$aresult = "<font color='#FF0000'><b>Category deleted successfully </b></font><br>
<a href='admin-category.php'>Click here to go back to view category</a>";
}
if(isset($_GET[adid]))
{
	$ids =$_GET[adid];
}
else if(isset($_GET[delid]))
{
	$ids =$_GET[delid];
}


//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM category where cat_id='$ids'");

while ($myrow = mysqli_fetch_array($result)) {
$catid = $myrow[cat_id];
$catname = $myrow[cat_name];
$description = $myrow[cat_des];

}

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM category");
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
       <form id="form1" name="form1" method="post" action="" onsubmit="return validateeditcat()">
         <h2>Edit Category Account</h2>
        <p> <?php 
		  echo $aresult; 
		  if($affrows != 1)
		  {
		  ?></p>
          <font color="red">*</font><b>Enter all mandatory fields</b>
         <table width="557" border="0">
           
           <tr>
             <th width="176" height="33">Category id</th>
             <td width="365"><input name="cat_id" type="text" id="cat_id" size="50" readonly value="<?php echo $catid; ?>" /></td>
           </tr>
           <tr>
             <th height="30"><font color="red">*</font>Category Name</th>
             <td><input name="catname" type="text" id="cat_name" size="50" value=<?php echo $catname; ?> onkeypress="isNumberKey(event)"/></td>
           </tr>
           <tr>
             <th height="33"><font color="red">*</font>Description</th>
             <td><input name="description" type="text" id="description"  value="<?php echo $description; ?>" size="70" /></td>
           </tr>
           <tr>
             <td height="34">&nbsp;</td>
             <td><?php
          if(isset($_GET["adid"]))
          {
          ?>
               <input type="submit" name="Update" id="Update" value="Update Account" />
               <?php
          }
          else if(isset($_GET["delid"]))
          {
          ?>
               <input type="submit" name="Delete" id="Delete" value="Delete" />
             <?php
          }
		}
         ?></td>
           </tr>
         </table>
         
</form>
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