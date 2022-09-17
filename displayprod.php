<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");
if(!(isset($_SESSION["adlogin"])))
{
//header("Location: adminlogin.php");
}

	//upload image code starts here
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $_FILES["file"]["name"]);
 $filename =  $_FILES["file"]["name"];
 
 

if(isset($_POST["Submit"]))
{
//upload image code starts here
move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $_FILES["file"]["name"]);
  $filename =  $_FILES["file"]["name"];



	$sql="INSERT INTO products (cat_id,subcat_id,supp_id,prodname,prod_specif,images,p_warranty,price,discount,stock_status)
	VALUES
	('$_POST[cat_name]','$_POST[subcat]','$_SESSION[supp_id]','$_POST[prod_name]','$_POST[prod_specific]','$filename','$_POST[warranty]','$_POST[price]','$_POST[discount]','$_POST[stck]')";

	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error: ' . mysqli_error($con));
 	 }
	 if(mysqli_affected_rows() == 1)
	 {
		$recresult= "Product added successfully...";
	 }
$insid =mysqli_insert_id($con);

}
if(isset($_POST[Update]))
{

  if($filename != "")
	{ 	
	$insid = $_POST[prodid];
		$cst = mysqli_query($con,"UPDATE products SET cat_id = '$_POST[cat_name]',subcat_id = '$_POST[subcat]',supp_id = '$_SESSION[supp_id]',prodname = '$_POST[prod_name]', prod_specif = '$_POST[prod_specific]', images = '$filename',p_warranty = '$_POST[warranty]',price = '$_POST[price]', discount = '$_POST[discount]', stock_status = '$_POST[stck]',status= '$_POST[prostat]' where prod_id='$_POST[prodid]'");
		if(mysqli_affected_rows() == 1)
		{
			$recresult = "Product updated successfully....";

		}
	}
	else
	{
		//echo $insid = $_POST[prodid];
	$cst = mysqli_query($con,"UPDATE products SET cat_id='$_POST[cat_name]',subcat_id='$_POST[subcat]',supp_id='$_SESSION[supp_id]',prodname='$_POST[prod_name]',prod_specif='$_POST[prod_specific]',p_warranty='$_POST[warranty]',price='$_POST[price]',discount='$_POST[discount]',stock_status='$_POST[stck]',status='$_POST[prostat]' where prod_id='$_POST[prodid]'");
	
	if(mysqli_affected_rows() == 1)
		{
			$recresult = "Product updated successfully....";
		}
		
		$insid =$_POST[prodid];

	}
}

	$resrec = mysqli_query($con,"select * from products where prod_id='$insid'");
	while($arrrec = mysqli_fetch_array($resrec))
	{
		$ctid = $arrrec[cat_id];
		$sbctid = $arrrec[subcat_id];
		$suppid = $arrrec[supp_id];
		$prodname = $arrrec[prodname];
		$price = $arrrec[price];
		$discount = $arrrec[discount];
		$prowarranty = $arrrec[p_warranty];
		$stocstat = $arrrec[stock_status];
		$prospeci = $arrrec[prod_specif];
		$filename = $arrrec[images];
		
		
	}

$retcat = mysqli_query($con,"select * from category WHERE maincat_id='0'");
$retsubcat = mysqli_query($con,"select * from category WHERE maincat_id !='0'");



?> 

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
          <div class="content"></div>
  		</div> 
        
  <div id="content" class="float_r">
  <?php 
   
if(isset($_POST[changest]))
{

$startdate = $_POST[start_at];
$sdate = date("Y-m-d", strtotime($startdate));
 $enddate = $_POST[end_at];
$_POST[prostat];
$edate = date("Y-m-d", strtotime($enddate));
mysqli_query($con,"UPDATE products SET  status= '$_POST[prostat]' where prod_id='$_POST[prodid]'");
		if(mysqli_affected_rows() == 1)
		{
		echo "<center><h2>Status updated successfully....</h2></center>";
		}


}
else
{
?>
<table width="622" height="257" border="1">
      <tr>
        <th height="31" colspan="2" scope="row">&nbsp;<?php echo $recresult; ?></th>
      </tr>
      <tr>
        <th width="212" height="40" scope="row"><input type="hidden" value="<?php echo $_GET[proids]; ?>" name="prodid2"  />
          <label for="cat_name3">Category name</label></th>
        <td width="394">

          <?php
		$resq =   mysqli_query($con,"select * from category where cat_id='$_POST[cat_name]'");
		  $rowct = mysqli_fetch_array($resq);
	echo $rowct[cat_name];
	?>
</td>
      </tr>
      <tr>
        <th height="22" scope="row"><label for="subcat_name4">Sub-Category </label></th>
        <td>
         <?php
		$resq =   mysqli_query($con,"select * from category where cat_id='$_POST[subcat]'");
		  $rowct = mysqli_fetch_array($resq);
	echo $rowct[cat_name];
	?>
        </td>
      </tr>
      <tr>
        <th height="32" scope="row">Company name</th>
        <td><?php
		echo $_POST[supppier];
		$resq =   mysqli_query($con,"select * from supplier where supp_id='$_SESSION[supp_id]'");
		  $rowct = mysqli_fetch_array($resq);
	echo $rowct[compname];
	?></td>
      </tr>
      <tr>
        <th height="33" scope="row">Product Name</th>
        <td><?php echo $_POST[prod_name]; ?><br/>
          
		 
          <img src="<?php echo "uploads/".$filename;?>" width="158" height="148" />
           
          </td>
      </tr>
      <tr>
        <th height="31" valign="top" scope="row">Product Specifications </th>
        <td><?php echo $_POST[prod_specific] ; ?></td>
      </tr>
      
    </table>
    <?php
}
?>
    <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>