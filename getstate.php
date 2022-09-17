<?php
$country=$_GET['country'];

$arrindia = array("Karnataka","Mumbai","Delhi");
$arraustralia = array("New South Wales","Victoria","Queensland");
$arrsrilanka = array("Colombo","Batticaloa","Moneragala");
$arrsaudi = array("Jeddah","Riyad","Dammam");
$arrjapan = array("Tokyo","Nagasaki ","Hiroshima");
?>
<select name="state">
<?php 
if($country == "India")
{
	foreach($arrindia as $value)
	{
		echo "<option value='$value'>$value</option>";
	}
}
else if($country == "Australia")
{
	foreach($arraustralia as $value)
	{
		echo "<option value='$value'>$value</option>";
	}	
}
else if($country == "Sri lanka")
{
	foreach($arrsrilanka as $value)
	{
		echo "<option value='$value'>$value</option>";
	}	
}
else if($country == "Saudi Arabia")
{
	foreach($arrsaudi as $value)
	{
		echo "<option value='$value'>$value</option>";
	}	
}
else if($country == "Japan")
{
	foreach($arrjapan as $value)
	{
		echo "<option value='$value'>$value</option>";
	}	
}
else
{
}
?>
</select>