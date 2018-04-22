<?php include "includes/db.php";?>
<?php include "includes/header.php";?>

<!-- Navigation -->

    <?php include "includes/nav.php";?>

<!-- /Navigation -->

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id']; 
                    
                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id= '{$post_id}' ";
                    $send_query = mysqli_query($connection, $view_query);
                    
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $select_all_posts_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title   = $row['post_title'];
                        $post_author  = $row['post_author'];
                        $post_data    = $row['post_date'];
                        $post_img     = $row['post_image'];
                        $post_content = $row['post_content'];
                    ?>
                 
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_data;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="Foto1">
                <hr>
                <p><?php echo $post_content;?></p>
        
                <hr>
                <?php } 
                
                
                }else{
                    header("Location: index.php");
                }                ?>
                
                
                <!-- Blog Comments -->
                        <?php
                            if(isset($_POST['create_comment'])){
                                   $the_post_id = $_GET['p_id'];
                                   $comment_author = $_POST['comment_author'];
                                   $comment_email = $_POST['comment_email'];
                                   $comment_content = $_POST['comment_content'];
                                if(empty($comment_author) && empty($comment_email) && empty($comment_content)){
                                    echo"<script>
                                            alert('Fields cannot be empty');
                                        </script>";
                                }else{
                                   $query = "INSERT INTO comments ";
                                   $query .= "(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
                                    $query .= " VALUES  ('{$the_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";

                                    $create_comment_query = mysqli_query($connection,$query);
                                     if(!$create_comment_query){
                                        die("QUERY FAILD".mysqli_error($connection));
                                    }
                                
                                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
                                    $query .= " WHERE post_id = '{$the_post_id}'";
                                    $update_comment_count = mysqli_query($connection,$query);
                                }
                            }
                        ?>
                
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                         <div class="form-group">
                             <label for="Author">Author</label>
                           <input type="text" class="form-control" name="comment_author">
                        </div>
                        
                         <div class="form-group">
                           <label for="Email">Email</label>
                           <input type="email"  class="form-control" name="comment_email">
                        </div>
                        
                        <div class="form-group">
                              <label for="Comment">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $the_post_id = $_GET['p_id'];
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .="AND comment_status = 'approved' ";
                $query .="ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection,$query);
                if(!$select_comment_query){
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_comment_query)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    ?>
                <!-- Comment -->
                 <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="123">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php
                            echo $comment_content;
                        ?>
                    </div>
                </div>  
                        
                    
                <?php } ?>
               
               
                <!-- Pager -->
<!--
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
-->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sitebar.php";?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php";  ?>