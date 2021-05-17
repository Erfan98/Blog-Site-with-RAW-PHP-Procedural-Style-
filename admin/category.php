<?php include "header.php";
include "config.php";
if($_SESSION['role']!=1):header("Location:{$hostname}/admin/post.php");endif;

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $current_page = $_GET['page'] ?? 1;
                        $limit = 3;
                        $offset= ($current_page-1)*3;
                        $sql="SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset},3";
                        $result = mysqli_query($conn,$sql) or die("Query Failed");
                        while($row=mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                            <td class='id'><?php echo $row['category_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                        <?php    
                        }
                        ?>
                        
                    </tbody>
                </table>

                <?php 
                    $sql_total_cat = "SELECT * FROM category";
                    $result = mysqli_query($conn,$sql_total_cat);
                    $total_category = mysqli_num_rows($result);
                    $total_page= ceil($total_category/$limit);

                    echo "<ul class='pagination admin-pagination'>";
                    for($i=1;$i<=$total_page;$i++){
                        echo "<li><a href='category.php?page={$i}'>{$i}</a></li>";
                    }
                    echo "</ul>"
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
