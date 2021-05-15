<?php
include "config.php";
$post_id= $_GET['post_id'];
$sql = "DELETE FROM post WHERE post_id={$post_id}";
$result= mysqli_query($conn,$sql) or die("Delete user Failed". mysqli_error($conn));
if($result): header("Location:{$hostname}/admin/post.php");endif;
?>