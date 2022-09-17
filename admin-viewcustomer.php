<?php
if(!isset($_SESSION)) { session_start(); }

if(!(isset($_SESSION["adlogin"])))
{
	header("Location: adminlogin.php");
}
include("dbconnect.php");
if(isset($_GET[delid]))
{
mysqli_query($con,"DELETE FROM customer where custid='$_GET[delid]'");
$aresult = "Customer profile deleted successfully <br>";
}

?>

<script language="javascript">
function confirmDelete(){
var agree=confirm("Are you sure you want to delete this customer?");
if (agree)
     return true;
else
     return false ;
}
</script>


<?php

if(isset($_POST["Submit1"]))
{
	    $resultret = mysqli_query($con,"SELECT * FROM  customer ");
		if(mysqli_affected_rows() ==0)
		{
		$resultret = mysqli_query($con,"SELECT * FROM  customer ");
		}

}


?> 



<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}
	
	
	
	function getcat(strURL) {		
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('catdiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
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
        <h1>View Customer        </h1>
          <table width="500" border="0">

<form id="form1" name="form1" method="post" action="" onsubmit="return validatecust1()" >
        <tr>
              <td width="306">
              <input type="submit" name="Submit1" id="Submit1" value="View Customers"/>
              </td>
            </tr>
</form>


 </table>
          <p>&nbsp;</p>

        <table width="663" border="2">
                    <tr bgcolor="#FFFFFF">
                      <td width="83">Customer Id</td>
                      <td width="101">Customer Name</td>
                      <td width="108">Contact Information</td>
                        
                        <td width="78">Contact no</td>
                        <td width="64">Email</td>
                        <td width="94">Last Login</td>
                        <td width="76">Action</td>
          </tr>  
  
     <?php
	
while($row = mysqli_fetch_array($resultret))
  {
  echo "<tr>";
  echo "<td>" . $row['custid'] . "</td>";
  echo "<td>" . $row['custfname'] ." " . $row['custlname'] . "</td>";

  echo "<td>" . $row['address']. "<br> ".$row['state']  . "<br> ". $row['country'] ."</td>";
  echo "<td>" . $row['contactno'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . 
  
  $date = date("d-m-Y h:i:s", strtotime($row['lastlogin'])) 
  
  . "</td>";
 
  echo "<td><a href='admincust-editacct.php?adid=$row[custid]'><img src='images/pencil_medium.ico' width='25' height='25'></a> <a href='admin-viewcustomer.php?delid=$row[custid]'onclick='return confirmDelete()'> <img src='images/erase.ico' width='15' height='15'></a></td>";
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