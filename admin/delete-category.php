<?php
include "config.php";
$category_id= $_GET['id'];
$sql = "DELETE FROM category WHERE category_id={$category_id}";
$result= mysqli_query($conn,$sql) or die("Delete user Failed". mysqli_error($conn));
if($result): header("Location:{$hostname}/admin/category.php");endif;
?>