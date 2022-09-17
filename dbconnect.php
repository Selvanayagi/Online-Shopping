<?php
if(!isset($_SESSION)) { session_start(); }
error_reporting(0);
$con = mysqli_connect("localhost","root","","online_shopping");
if(!$con)
{
  die('Could not connect: ' . mysqli_connect_error());
}
?>