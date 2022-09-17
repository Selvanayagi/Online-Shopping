<?php
if(!isset($_SESSION)) { session_start(); }
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}
include("dbconnect.php");

$retcat = mysqli_query($con,"select * from category");
$retsubcat = mysqli_query($con,"select * from category");
$retsupp = mysqli_query($con,"select * from supplier");


?> 
<script type="text/javascript">
function validateviewprod()
{
	 if(document.prod.cat_name.value=="")
    {
       alert("Please select your main category");
        return false;
    }
	else if(document.prod.subcat.value=="")
    {
		alert("Please select your sub-category");
		 return false;
    }
	else if(document.prod.supplier.value=="")
    {
alert("Please select your supplier");
 return false;
    }
}
</script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
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
	
	function getsubcat(catid) {		
		
		var strURL="getsubcategory.php?catid="+catid;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subcatdiv').innerHTML=req.responseText;						
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
        <h1>View Products        </h1>
        <form id="form1" name="prod" method="post" action="" onsubmit="return validateviewprod()">
          <table width="290" border="0">
            
            
            <tr>
              
               <td>
         
         
            <?php
if(isset($_SESSION[splogin]))
{
	$retsupp = mysqli_query($con,"select * from supplier WHERE login_id='tata@tata.com'");
}


	?>
 </select></td>
            </tr>
            <tr>
              <th height="38" colspan="2"><input type="submit" name="Submit" id="Submit" value="View products" /></th>
              
            </tr>
          </table>
          <p>&nbsp;</p>
        </form>
        
        </p>
        <table width="661" border="1">
                    <tr>
                      <td width="106"><strong>Product info</strong></td>
                      <td width="73"><strong>Price</strong></td>
                      <td width="70"><strong>Stock Status</strong></td>
          </tr>	
     <?php
		if(isset($_POST[Submit]))
		{	
		$resultv = mysqli_query($con,"SELECT * FROM products where cat_id=subcat_id");
		}
		
		
while($row = mysqli_fetch_array($resultv))
  {

$reccatname = mysqli_query($con,"select * from  category WHERE cat_id='$row[cat_id]'");
$rowa = mysqli_fetch_array($reccatname);
$catname = $rowa[cat_name];
  
$recscatname = mysqli_query($con,"select * from  category WHERE cat_id='$row[subcat_id]'");
$rowb = mysqli_fetch_array($recscatname);
$scatname = $rowb[cat_name];
  
$recsuppname = mysqli_query($con,"select * from  supplier WHERE supp_id='$row[supp_id]'");
$rowc = mysqli_fetch_array($recsuppname);
$ssupp = $rowc[compname];
  
  	echo "<tr>";
	if($row['images'] == "")
	{
		$imgpath = "images/products.jpg";
	}
	else
	{
		$imgpath = "uploads/". $row['images'];
	}
  	echo "<td> 
	<img src='$imgpath' width='105' height='116' align='left' >
	Product ID : " . $row['prod_id']. " <br> Product Name: ". $row['prodname'] . "<br>";
  	echo "Category : " . $catname . "<br> Sub category: " . $row['subcat_id'] ."</br>";
  	echo "Supplier : " . $ssupp . "</td>";
  	echo "<td>Cost:" . $row['price'] . "<br>";
   	echo "Discount: " . $row['discount'] . "<br>";
	if($row['stock_status'] >= 10)
	{
		echo "<font color='green'><b>In Stock.</b></font>";
	}
	else
	{
		echo "<font color='red'><b>Out of stock</font>";
	}
  	echo "</td>";
	 
  	 
	echo "<td align='center'>" ;

		if(isset($_SESSION["supp_id"]))
		{
		echo $row['stock_status']."<br><a href='addproduct.php?proids=$row[prod_id]&prst=updatepro'>Update</a>";
		}
	
  	echo "</td></tr>";
  }


?>

 </table>
  
                
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>