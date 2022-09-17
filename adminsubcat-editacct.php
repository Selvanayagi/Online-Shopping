<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
include("header.php");
?>
 <script type="text/javascript">
function validateeditsubcat()
{
   if(document.form1.main_cat.value=="")
    {
     alert("Please select your main category");
       document.form1.main_cat.focus();
        return false;
    }
  
   else if(document.form1.catname.value=="")
    {
 	 alert("Please enter the Category name.");
 	document.form1.catname.focus();
 	return false;
    }
   else if(document.form1.catname.value.length<4)
    {
	alert("Category name should not be less than 4");
	document.form1.catname.focus();
	return false;
    }
     
	else if(document.form1.description.value=="")
    {
    	alert("Please enter the Category description.");
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
       alert("Characters Should be alphabet only");
	  	return false;
	 }
	  }
</script>
<?php
$aresult="";

if(isset($_POST[Update]))
{
	mysqli_query($con,"UPDATE category SET cat_name = '$_POST[catname]' ,cat_des='$_POST[description]', maincat_id='$_POST[main_cat]' where cat_id='$_POST[catid]'");

$aresult = "<font color='#FF0000'><b>Subcategory Updated successfully..</b></font>";


}

if(isset($_POST[Delete]))
{
	mysqli_query($con,"DELETE FROM category where  cat_name='$_POST[catname]'");
	if(mysqli_affected_rows() == 1)
	{
		$delrecords = 1;
	}
	$aresult = "<font color='#FF0000'><b>Sub-category deleted successfully <br><a href='admin-subcategory.php'>Click here to view Sub-category</a>";

}
if(isset($_GET[adid]))
{
	$ids =$_GET[adid];
}
else if(isset($_GET[delid]))
{
	$ids =$_GET[delid];
}

if(isset($_GET[editid]))
{
	$editids = $_GET[editid];
	
}
else
{
	$editids = $_GET[delid];
}

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM category where cat_id='$editids'");

$myrow = mysqli_fetch_array($result); 
$catid = $myrow[cat_id];
$catname = $myrow[cat_name];
$description = $myrow[cat_des];
$maincatid = $myrow[maincat_id];

//retrieve value from category table.
$resultcat = mysqli_query($con,"SELECT * FROM category where maincat_id='0'");


?>

    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
 <?php
 include("adminsidebar.php");
 ?>
          
        </div>
        <div id="content" class="float_r">
       <form id="form1" name="form1" method="post" action="" onsubmit="return validateeditsubcat()">
         
         <h2>Edit Subcategory</h2>
         <font color="red">*</font><b>Enter all mandatory fields</b>
         <p><?php echo $aresult; ?>
		</p>
        
         <?php
		 if($delrecords != 1)
		 {
			 ?>
         <input type="hidden" value="<?php echo $catid; ?>" name="catid" />
             <table width="498" border="0">
               <tr>
    <th width="171" height="32"><font color="red">*</font>Main Category</th>
    <td width="317"><select name="main_cat" id="main_cat">
      <option value="">Select category</option>
      <?php
	while($row = mysqli_fetch_array($resultcat))
  {

	  if($row["cat_id"] == $maincatid )
	  {
  echo "<option value='$row[cat_id]' selected>$row[cat_name]</option>";
	  }
	  else
	  {
		   echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
	  }
  
  }
?>
    </select></td>
  </tr>
  <tr>
    <th height="37"><font color="red">*</font>Category Name</th>
    <td><input name="catname" type="text" id="adm_nanme" size="50" value="<?php echo $catname; ?>" onkeypress="isNumberKey(event)"/></td>
  </tr>
  <tr>
    <th height="55"><font color="red">*</font>Description</th>
    <td><textarea name="description" cols="50" id="log_id"><?php echo $description; ?></textarea></td>
  </tr>
  <tr>
    <th height="35" colspan="2"><?php
                      if(isset($_GET["editid"]))
                      {
                      ?>
      <input type="submit" name="Update" id="Update" value="Update Sub category" />
      <?php
                      }
                      else if(isset($_GET["delid"]))
                      {
                      ?>
      <input type="submit" name="Delete" id="Delete" value="Delete" />
      <?php
                      }
		 }
                      ?></th>
    </tr>
       </table>
        <p>&nbsp;</p>
</form>
       
        <p>&nbsp;</p>
<div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>