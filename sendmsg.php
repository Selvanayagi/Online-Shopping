<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");

if(isset($_POST[Submit]))
{
	$sql="INSERT INTO category (cat_name,cat_des,maincat_id)
	VALUES
	('$_POST[cat_name]', '$_POST[cat_descript]','$_POST[main_cat]')";

	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error: ' . mysqli_error($con));
 	 }
	$result= "1 record added";
}

//retrieve value from category table.
$result = mysqli_query($con,"SELECT * FROM category where maincat_id='0'");
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
        <h1>Send Message       </h1>
        <form id="form1" name="form1" method="post" action="">
          <?php echo $result; ?>
          <p>To 
            <select name="msg_to" id="To_id">
            <option>Select category</option>
 <?php
while($row = mysqli_fetch_array($result))
  {
  echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
  }
?>
            </select>
          </p>
          <p>Title
            <input name="title" type="text" id="title_id" size="50" />
          </p>
          <p>Message
            <textarea name="message" id="msg_id" cols="45" rows="5"></textarea>
          </p>
          <p>
            <input type="submit" name="Submit" id="Submit" value="Send  message" />
          </p>
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