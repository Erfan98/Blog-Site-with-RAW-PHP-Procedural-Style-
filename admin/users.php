<?php include "header.php";
    include "config.php";
    if($_SESSION['role']!=1):header("Location:{$hostname}/admin/post.php");endif;

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
              <?php
                $current_page = $_GET['page'] ?? 1;
                $offset = ($current_page-1)*3;
                $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},3";
                $result = mysqli_query($conn,$sql) or die("Query Faild");
                if(mysqli_num_rows($result)>0){

                
              
              ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php 
                      while($row= mysqli_fetch_assoc($result)){?>
            
                          <tr>
                              <td class='id'><?php echo $row['user_id']; ?></td>
                              <td><?php echo $row['first_name'] . " " .  $row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo $row['role'] == 1?"Admin":"Normal user";?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                        } ?>
                      </tbody>
                  </table>
                  <?php 
                }
                  ?>
                    
                  <?php
                  $sql1 = "SELECT * FROM user";
                  $result1 = mysqli_query($conn,$sql1);
                  $total_records = mysqli_num_rows($result1);
                  $total_page = ceil($total_records/3);
                  

                  $prev= $current_page-1;
                  $next = $current_page+1;
                  echo "<ul class='pagination admin-pagination'>";
                  echo ($current_page>1)? "<li><a href='?page={$prev}' >Prev</a></li>": "";
                  for($i=1;$i<=$total_page;$i++){
                      $isActivated = ($i==$current_page)? "active":"";
                    
                    echo "<li class='{$isActivated}' ><a href='?page={$i}'>{$i}</a></li>";
                  }
                  echo ($current_page < $total_page)? "<li><a href='?page={$next}'>Next</a></li>": "";
                  echo "</ul>"
    
                  ?>
                  
              </div>
          </div>
      </div>
  </div>