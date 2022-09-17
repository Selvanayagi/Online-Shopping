<?php
$con = mysqli_connect("localhost","root","technology");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db("ecommerce", $con);

$sql="INSERT INTO administrator (name,login_id,a_password,email_id,contact_no)
VALUES
('$_POST[admin_name]', '$_POST[login_id]' ,'$_POST[password]','$_POST[email_id]','$_POST[contactno]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";

mysqli_close($con)
?> 


<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="admin_name">Admin Name</label>
    <input type="text" name="admin_name" id="admin_name" />
  </p>
  <p>
    <label for="login_id"></label>
    Login Id
    <input type="text" name="login_id" id="login_id" />
  </p>
  <p>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" />
  </p>
  <p>
    <label for="Confirm_password">Confirm password</label>
    <input type="password" name="Confirm_password" id="Confirm_password" />
  </p>
  <p>
    <label for="email_id">Email Id</label>
    <input type="text" name="email_id" id="email_id" />
  </p>
  <p>
    <label for="contactno">Contact No</label>
    <input type="text" name="contactno" id="contactno" />
  </p>
  <p>
    <input type="submit" name="Addadmin" id="Addadmin" value="Add" />
    <input type="reset" name="refresh" id="refresh" value="Reset" />
  </p>
</form>
