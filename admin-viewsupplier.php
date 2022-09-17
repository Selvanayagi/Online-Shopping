<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");
?>
<script type="text/javascript">
function validateviewsupp()
{

if(document.form1.comp_name.value=="")
    {
alert("Please select your supplier");
 return false;
    }
}
</script>
<?php
if(isset($_GET[delid]))
{
mysqli_query($con,"DELETE FROM supplier where  supp_id='$_GET[delid]'");

$aresult = "<b>supplier profile deleted successfully</b> <br>";
mysqli_query($con,"UPDATE products SET status= 'Rejected' where supp_id ='$_POST[sup_id]'");
}

$retcomp = mysqli_query($con,"select * from supplier ");
?> 
<script type="text/JavaScript">
 
function confirmDelete(){
var agree=confirm("Are you sure you want to delete this supplier");
if (agree)
     return true;
else
     return false ;
}
</script>
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
        <h1>View Supplier</h1>
        <?php echo $aresult ; ?>
        <form id="form1" name="form1" method="post" action="" onsubmit="return validateviewsupp()">
          <p>&nbsp;          </p>
          <table width="305" border="0">
            <tr>
              <th height="32">Company Name</th>
              <td><span id="cat_id">
          <select  name="comp_name" id="comp_name">
                
              <option value="">select</option>
              <?php
	while($row = mysqli_fetch_array($retcomp))
	{
     echo "<option value='$row[supp_id]'>$row[compname]</option> ";
	}
	?>
          </select>
          </span></p>
          
          
            
          </span></td>
            </tr>
            <tr>
              <th height="39" colspan="2"><input type="submit" name="Submit" id="Submit" value="View supplier" /></th>
              
            </tr>
          </table>
          <p>&nbsp;</p>
        </form>
        <table width="649" border="2">
                    <tr>
                      <th width="72">Supplier Id</th>
                      <th width="92">Company Name</th>
                        <th width="222">Contact Information</th>
                        <th width="95">Login Id</th>
                        <th width="66">Last Login</th>
                        <th width="60">Action</th>
           </tr>
  
      <?php
    $result = mysqli_query($con,"SELECT * FROM supplier where supp_id='$_POST[comp_name]'");


while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['supp_id'] . "</td>";
if($row['complogo'] != "")
{
 $imgsrc = "<img src='upload/$row[complogo]' width='75' height='50'></img>";
}
  echo "<td>". " $imgsrc <br> "   . $row['compname'] ."</td>";
  echo "<td>" . $row['address']. "<br> State: ". $row['state'] . "<br> Country: ". $row['country'] . "<br> Ph. No.". $row['contact_no'] . "</td>";
  echo "<td>" . $row['login_id'] . "</td>";
   echo "<td>" . 
  
  $date = date("d-m-Y h:i:s", strtotime($row['lastlogin'])) 
  
  . "</td>";
  
    echo "<td> <a href='admin-viewsupplier.php?delid=$row[supp_id] '  onclick='return confirmDelete()'> <img src='images/erase.ico' width='15' height='15'></a></td>";
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