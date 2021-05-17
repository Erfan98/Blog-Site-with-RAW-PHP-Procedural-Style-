<?php
include "config.php";
$post_id= $_GET['post_id'];
$category = $_GET['cat_id'];
$img= $_GET['img'];
$sql = "DELETE FROM post WHERE post_id={$post_id};";
$sql.="UPDATE category SET post = post-1  WHERE category_id = {$category}";
unlink("upload/".$img);


$result= mysqli_multi_query($conn,$sql) or die("Delete user Failed". mysqli_error($conn));
if($result): header("Location:{$hostname}/admin/post.php");endif;
?>