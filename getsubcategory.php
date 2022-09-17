<?php
$catId=intval($_GET['catid']);
include("dbconnect.php");
$query="SELECT * FROM category WHERE maincat_id='$catId' ";
$result=mysqli_query($con,$query);
?>

<select name="subcat">
<option value="">Select</option>
<?php
while($row=mysqli_fetch_array($result)) 
{
?>
<option value="<?=$row['cat_id']?>"><?=$row['cat_name']?></option>
<?php
} 
?>
</select>