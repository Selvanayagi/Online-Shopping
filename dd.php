<?php
$cat_id=$_GET['cat_id'];
require "config.php";
if($cat_id == "Customer")
{
$q=mysqli_query($con,"select * from customer");
echo mysqli_error($con);
$myarray=array();
$str="";
while($nt=mysqli_fetch_array($q)){
$str=$str . "\"$nt[email]\"".",";
}
$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";
}
else if($cat_id == "Administrator")
{
	$q=mysqli_query($con,"select * from administrator");
echo mysqli_error($con);
$myarray=array();
$str="";
while($nt=mysqli_fetch_array($q)){
$str=$str . "\"$nt[email_id]\"".",";
}
$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";
}
else if($cat_id == "Suppliers")
{
	$q=mysqli_query($con,"select * from supplier");
echo mysqli_error($con);
$myarray=array();
$str="";
while($nt=mysqli_fetch_array($q)){
$str=$str . "\"$nt[login_id]\"".",";
}
$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";
}


?>