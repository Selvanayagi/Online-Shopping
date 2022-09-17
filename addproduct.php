<?php
if(!isset($_SESSION)) { session_start(); }
include("dbconnect.php");
if(!(isset($_SESSION["adlogin"])))
{
	//header("Location: adminlogin.php");
}
?>
<script type="text/javascript">
function validateaddprod()
{
    if(document.addprod.cat_name.value=="")
    {
   		 alert("Please select your category ");
   	 	
   	 	return false;
    }
	else if(document.addprod.subcat.value=="")
    {
    	alert("Please select your sub-category ");
         return false;
    }
	else if(document.addprod.supplier.value=="")
    {
   		 alert("Please select your supplier ");
		 return false;
    }
	else if(document.addprod.prod_name.value=="")
	{
		alert("Please enter the Product name.");
		document.addprod.prod_name.focus();
		return false;
	 }
     	else if(document.addprod.prod_name.value.length<4)
    {
		alert("Product name shoulld not be less than 4");
		document.addprod.prod_name.focus();
		return false;
	 }
		  else if(document.addprod.prod_specific.value=="")
	{
		alert("Please enter the Product specification.");
		document.addprod.prod_specific.focus();
		return false;
	 }
	  else if(document.addprod.warranty.value=="")
	{
		alert("Please enter the Warranty.");
		document.addprod.warranty.focus();
		return false;
	 }
	 else if(document.addprod.price.value=="")
	{
		alert("Please enter the Price.");
		document.addprod.price.focus();
		return false;
	 }
	  else if(document.addprod.discount.value=="")
	{
		alert("Please enter the Discount. If there is no discount on the Product, please enter '0'");
		document.addprod.discount.focus();
		return false;
	 }
	  else if(document.addprod.stck.value=="")
	{
		alert("Please enter the stock value");
		document.addprod.stck.focus();
		
		return false;
	 }
	  
	  
	
}
function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode
		//alert(charCode);
         if (charCode >=65 && charCode < 91 )
      	 {              
		 return true;
	 }
	 else if (charCode > 96 && charCode < 122 )
      	 {
		 return true;
	 }
	 else
	 {
        alert("Characters Should be alphabet only");
	  	return false;
	 }
	  }
</script>
<?php
if(isset($_POST[changest]))
{
	$startdate = $_POST[start_at];
$sdate = date("Y-m-d", strtotime($startdate));

$enddate = $_POST[end_at];
$edate = date("Y-m-d", strtotime($enddate));
	$cst = mysqli_query($con,"UPDATE products SET Start_at = '$sdate',End_at = '$edate',status='$_POST[prostat]' where prod_id='$_POST[prodid]'");
		if(mysqli_affected_rows() == 1)
		{
			$result = "<font color='#FF0000'><b>Status updated successfully....</b></font>";

		}

}
if(isset($_POST[Update]))
{
	
	//upload image code starts here
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $_FILES["file"]["name"]);
	 echo $filename =  $_FILES["file"]["name"];
 
 	$startdate = $_POST[start_at];
	$sdate = date("Y-m-d", strtotime($startdate));

	$enddate = $_POST[end_at];
	$edate = date("Y-m-d", strtotime($enddate));

 
 	 if($filename != "")
	 {
		$cst = mysqli_query($con,"UPDATE products SET cat_id = '$_POST[cat_name]',subcat_id = '$_POST[subcat]',supp_id = '$_SESSION[supp_id]',prodname = '$_POST[prod_name]', prod_specif = '$_POST[prod_specific]', images = '$filename',p_warranty = '$_POST[warranty]',price = '$_POST[price]', discount = '$_POST[discount]', stock_status = '$_POST[stck]', deliveredin = '$_POST[delivered]', Start_at = '$sdate',End_at = '$edate',status= '$_POST[prostat]' where prod_id='$_POST[prodid]'");
		if(mysqli_affected_rows() == 1)
		{
			$result = "<font color='#FF0000'><b>Product updated successfully....</b></font>";

		}
	}
	else
	{
		$cst = mysqli_query($con,"UPDATE products SET cat_id='$_POST[cat_name]',subcat_id='$_POST[subcat]',supp_id='$_SESSION[supp_id]',prodname='$_POST[prod_name]',prod_specif='$_POST[prod_specific]',p_warranty='$_POST[warranty]',price='$_POST[price]',discount='$_POST[discount]',stock_status='$_POST[stck]',deliveredin='$_POST[delivered]',Start_at = '$sdate',End_at = '$edate',status='$_POST[prostat]' where prod_id='$_POST[prodid]'");
		if(mysqli_affected_rows() == 1)
		{
			$result = "<font color='#FF0000'><b>Product updated successfully....</b></font>";
		}
	}
	
}

if(isset($_GET[proids]))
{
	
	$resrec = mysqli_query($con,"select * from products where prod_id='$_GET[proids]'");
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
		$prodlogoa = $arrrec[images];
		
	}
}

if(isset($_POST[Submit]))
{


	//upload image code starts here
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $_FILES["file"]["name"]);
  $filename =  $_FILES["file"]["name"];

$startdate = $_POST[start_at];
$sdate = date("Y-m-d", strtotime($startdate));

$enddate = $_POST[end_at];
$edate = date("Y-m-d", strtotime($enddate));

	$sql="INSERT INTO products (cat_id,subcat_id,supp_id,prodname,prod_specif,images,p_warranty,price,discount,stock_status,deliveredin,Start_at,End_at,status)
	VALUES ('$_POST[cat_name]','$_POST[subcat]','$_SESSION[supp_id]','$_POST[prod_name]','$_POST[prod_specific]','$filename','$_POST[warranty]','$_POST[price]','$_POST[discount]','$_POST[stck]','$_POST[delivered]','$sdate ','$edate','Pending')";

	if (!mysqli_query($con,$sql))
 	 {
 	 die('Error: ' . mysqli_error($con));
 	 }
	 if(mysqli_affected_rows() == 1)
	 {
		$recresult= "<font color='#FF0000'><b>Product added successfully...</b></font>";
	 }
}

$retcat = mysqli_query($con,"select * from category");




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
        <h1>      <?php 
		  if(isset($_SESSION["splogin"]))
		  {
		  ?> 
          <?php
          if(isset($_GET[prst]))
		  {
			  ?>
          Update Product
          <?php
		  }
		  else
		  {
			  ?>
            Add Product
           <?php
		  }
		  ?>
           
          <?php
		  }
		  
		  if(isset($_SESSION["adlogin"]))
		  {
		?>
         Update Status
        <?php
		  }
		  ?>  </h1>
      
 <font color="red">*</font><b>Enter all mandatory fields
    
       <form name="addprod" method="post" action="displayprod.php" enctype="multipart/form-data" onsubmit="return validateaddprod()">
    <table width="622" height="838" border="0">
        <tr>
          <th height="31" colspan="2" scope="row">&nbsp;<?php echo $result; ?></th>
        </tr>
        <tr>
          <th width="200" height="32" scope="row"><input type="hidden" value="<?php echo $_GET[proids]; ?>" name="prodid"  /><label for="cat_name4"><font color="red">*</font>Category</label></th>
          <td width="412">
          
          <select  name="cat_name" id="cat_id"  onChange="getsubcat(this.value)">
           <option value="">Select</option>
         
	<?php
	while($row = mysqli_fetch_array($retcat))
	{
		if($ctid == $row[cat_id])
		{
		  echo "<option value='$row[cat_id]' selected>$row[cat_name]</option> ";
		}
		else
		{
     echo "<option value='$row[cat_id]'>$row[cat_name]</option> ";
		}
	}
	?>
	        </select>
          </td>
        </tr>
        <tr>
          <th height="36" scope="row"><label for="subcat_name3"><font color="red">*</font>Sub-Category </label>              </th>
          <td> 
           <div id="subcatdiv">
       <select name="subcat">
       <option value="">Select</option>
       <?php
	  
	/*$query=mysqli_query($con,"SELECT * FROM category WHERE maincat_id !='0' ");*/
	 	while($row1 = mysqli_fetch_array($query))
		{
			
           if($row1[cat_id] == $sbctid)
		   {
			echo "<option value='$row1[cat_id]' selected>$row1[cat_name]</option>";
		   }
		   else
		   {
			echo "<option value='$row1[cat_id]'>$row1[cat_name]</option>";
		   }
		}
       ?>
	    </select>
        </div>
        </td>
        </tr>
        <tr>
          <th height="34" scope="row"><font color="red">*</font>Supplier</th>
          <td>
         
         
            <?php
if(isset($_SESSION[splogin]))
{
	$retsupp = mysqli_query($con,"select * from supplier ");
}
else
{
	$retsupp = mysqli_query($con,"select * from supplier");
}
echo  "<select name='supplier' id='supplier'>";

	while($row = mysqli_fetch_array($retsupp))
	{
		echo "<option value='$row[supp_id]' selected='selected'>$row[compname]</option> ";
	}

	?>
 </select></td>
        </tr>
        <tr>
          <th height="29" scope="row"><font color="red">*</font>Product Name</th>
          <td><input name="prod_name" type="text" id="prod_name" size="50" value="<?php echo $prodname; ?>" /></td>
      </tr>
        <tr>
          <th height="93" valign="top" scope="row"><font color="red">*</font>Product Specifications </th>
          <td><textarea name="prod_specific" id="prod_specfic" cols="45" rows="5"><?php echo $prospeci ; ?></textarea></td>
        </tr>
        <tr>
          <th height="150" scope="row"><font color="red">*</font>Image</th>
          <td>
          <input type="file" name="file" id="file" /><br />
          <?php
          
		  if(isset($_GET[proids]))
			{
			  if(isset($_GET[prst]))
		  	  {
				if($prodlogoa=="")
			  	{
			  		$plogo = "images/products.jpg";
			  	}
			  	else
			  	{
					$plogo = "uploads/".$prodlogoa ;
			  	}
			}
			
		  ?>
          <img src="<?php echo $plogo;?>" width="158" height="148" />
           <?php
		  }
		  ?>
          </td>
    
        </tr>
        <tr>
          <th height="33" scope="row">Warranty </th>
          <td><input type="text" name="warranty" id="warranty"  value="<?php echo $prowarranty; ?>"/></td>
        </tr>
        <tr>
          <th height="31" scope="row"><font color="red">*</font>Price </th>
          <td><input type="text" name="price" id="price"  value="<?php echo $price; ?>" /></td>
        </tr>
        <tr>
          <th height="26" scope="row">Discount</th>
          <td><input type="text" name="discount" id="discount"  value="<?php echo $discount; ?>" /></td>
        </tr>
        <tr>
          <th height="32" scope="row"><font color="red">*</font>Stock status </th>
          <td><input type="text" name="stock" id="stock"  value="<?php echo $stocstat; ?>" /></td>
          
        </tr>
        
        <tr>
          <th scope="row">&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
        
         <?php 
		  if(isset($_SESSION["adlogin"]))
		  {
		  ?>
        <tr>
          <th height="79" scope="row"><font color="red">*</font>Status </th>
          <td>&nbsp;
          <p>
            <label for="prostat"></label>
            
            <select name="prostat" id="prostat">
			
              <option value="" <?php
            if($_GET[prst]=="pending")
			{
				echo "selected	";
			}
			?>>Pending</option>
              <option value="Approved" <?php
            if($_GET[prst]=="approve")
			{
				echo "selected	";
			}
			?>>Approve</option>
              <option value="Rejected" <?php
            if($_GET[prst]=="reject")
			{
				echo "selected	";
			}
			?>>Reject</option>
            </select>
          </p>
          <?php
		  }
		  ?></td>
        </tr>
        <tr>
          
          <th colspan="2">&nbsp;
		  <?php 
		  if(isset($_SESSION["splogin"]))
		  {
		  ?> 
          <?php
          if(isset($_GET[prst]))
		  {
			  ?>
          <input type="submit" name="Update" id="changest" value="Update Product" />
          <?php
		  }
		  else
		  {
			  ?>
            <input type="submit" name="Submit" id="Submit" value="Add Product" />
           <?php
		  }
		  ?>
           
            <?php
		  }
		  
		  if(isset($_SESSION["adlogin"]))
		  {
		?>
         <input type="submit" name="changest" id="changest" value="Change status" />
        <?php
		  }
		  ?>
          
          </p></th>
        </tr>
    </table>
   
    <p>&nbsp;</p>
    
    </form>
    <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="cleaner"></div>
</div> 
        <div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
    
    <?php
	include("footer.php");
	?>