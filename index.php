<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                                include "config.php";
                                $current_page= $_GET['page']?? 1;
                                $offset =($current_page-1)*3;
                                $sql=  "SELECT * FROM post
                                LEFT JOIN category on post.category = category.category_id
                                LEFT JOIN user on post.author = user.user_id
                                ORDER BY post_id DESC
                                LIMIT {$offset},3";
                                $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
                                while($row=mysqli_fetch_assoc($result)){
                                ?>
                    <div class="post-content">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href='single.php?id=<?php echo $row['post_id']?>'><img
                                        src="<?php echo "admin/upload/".$row['post_img']?>" alt="" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title']?></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php'><?php echo $row['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a
                                                href='author.php'><?php echo $row['first_name']." ".$row['last_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($row['description'],0,130)."..."?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                        }
                        ?>
                    <ul class='pagination'>
                    <?php
                        
                        $pagination_sql = "SELECT * FROM post";
                        $result1= mysqli_query($conn,$pagination_sql) or die(mysqli_error($conn));
                        $total_page = ceil(mysqli_num_rows($result1)/3);
                        for($i =1 ;$i<=$total_page;$i++){
                            $isActivated = ($i==$current_page)? "active":"";
                            echo "<li class='{$isActivated}'><a href='?page={$i}'>{$i}</a></li>";
                        }

                  
                  
                  ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>