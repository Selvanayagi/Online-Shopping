<?php

$dbservertype='mysqli_';

// hostname or ip of server
$servername='localhost';

$dbusername='root';
$dbpassword='';

$dbname='online_shopping';

////////////////////////////////////////
////// DONOT EDIT BELOW  /////////
///////////////////////////////////////

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysqli_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to mysqli_");}
mysqli_select_db("$dbname",$link) or die ("could not open db".mysqli_error($con));
}

?>