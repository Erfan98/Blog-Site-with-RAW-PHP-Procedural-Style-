<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name = $_POST['old_image'];
    
}else{
   

    $errors = array();
    
    $file_name = $_FILES['new-image']['name'];
    $file_size= $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = end(explode('.',$file_name));
    $extensions = array("jepg","jpg","png","gif");

    if(in_array($file_ext,$extensions)=== false){
        $errors[]= "This Extention file not allowed. Please Choose JPEG,PNG,JPG!"; 
    }
    if($file_size>2097152){
        $errors[]= "File Size must be 2mb or lower";
        
    }
    if(empty($errors)==true){
        unlink("upload/".$_POST[old_image]);
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }

}
$post_title=mysqli_real_escape_string($conn,$_POST['post_title']);
$post_desc=mysqli_real_escape_string($conn,$_POST['postdesc']);
$post_category=mysqli_real_escape_string($conn,$_POST['category']);
$post_id=mysqli_real_escape_string($conn,$_POST['post_id']);

$sql = "UPDATE post SET title='{$post_title}' ,description='{$post_desc}' ,category='{$post_category}' ,post_img='{$file_name}' WHERE post_id={$post_id}";

echo $sql;



mysqli_query($conn,$sql)? header("Location:{$hostname}/admin/post.php"):print_r(mysqli_error($conn));

?>