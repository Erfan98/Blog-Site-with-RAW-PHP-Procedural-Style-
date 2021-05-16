<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        include "config.php";
                        $current_page= $_GET['page']?? 1;
                        $offset =($current_page-1)*3;
                        $sqlForAdmin = "SELECT * FROM post
                                LEFT JOIN category on post.category = category.category_id
                                LEFT JOIN user on post.author = user.user_id
                                ORDER BY post_id DESC
                                LIMIT {$offset},3";

                        $sqlForuser = "SELECT * FROM post
                                LEFT JOIN category on post.category = category.category_id
                                LEFT JOIN user on post.author = user.user_id
                                WHERE post.author = {$_SESSION['user_id']}
                                ORDER BY post_id DESC
                                LIMIT {$offset},3";

                        $result = $_SESSION['role']==1?mysqli_query($conn,$sqlForAdmin):mysqli_query($conn,$sqlForuser) or die(mysqli_error($conn));
                        
                        while($row = mysqli_fetch_assoc($result))
                        {    
                        ?>
                            <tr>
                              <td class='id'><?php echo $row['post_id'];?></td>
                              <td><?php echo $row['title'];?></td>
                              <td><?php echo $row['category_name'];?></td>
                              <td><?php echo $row['post_date'];?></td>
                              <td><?php echo $row['username'];?></td>
                              <td class='edit'><a <?php echo "href='update-post.php?id={$row['post_id']}'";?> ><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a <?php echo "href='delete-post.php?post_id={$row['post_id']}&cat_id={$row['category_id']}&img={$row['post_img']}'";?>><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                        <?php
                        }
                        ?>

                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                        <?php
                        
                            $pagination_sql_forAdmin = "SELECT * FROM post";
                            $pagination_sql_forUser = "SELECT * FROM post 
                                                       LEFT JOIN user on post.author = user.user_id
                                                       where role = 0";
                            $result1= $_SESSION['role']==1?mysqli_query($conn,$pagination_sql_forAdmin):mysqli_query($conn,$pagination_sql_forUser) or die(mysqli_error($conn));
                            $total_page = ceil(mysqli_num_rows($result1)/3);
                            for($i =1 ;$i<=$total_page;$i++){
                                $isActivated = ($i==$current_page)? "active":"";
                                echo "<li class='{$isActivated}'><a href='?page={$i}'>{$i}</a></li>";
                            }

                      
                      
                      ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
