
<?php
$category=$_REQUEST['category'];
$link = mysqli_connect('localhost', 'root', 'technology'); //changet the configuration in required
if (!$link) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db('ecommerce');
$query="select cat_name from category where maincat_id=$category";
$result=mysqli_query($con,$query);

?>
Select Sub Category  
<select name="subcat">
<option>All</option>
<? while($row=mysqli_fetch_array($result)) { ?>
<option value="<?=$row[cat_id]?>"><?=$row['cat_name']?></option>
<? } ?>
</select>
