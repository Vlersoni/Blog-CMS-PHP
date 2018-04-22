<?php include "includes/admin_header.php";?>
<div id="wrapper">
    <?php
//    $session = session_id();
//    $time = time();
//    $time_out_in_seconds = 60;
//    $time_out = $time - $time_out_in_seconds;
//    
//    $query = "SELECT * FROM users_online WHERE session = '$session'";
//    $send_query = mysqli_query($connection,$query);
//    $count = mysqli_num_rows($send_query);
//    
//    if($count == NULL){
//        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");
//    }else{
//         mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session ='$session'");
//    }
//    $users_online_qyery = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
//    $count_user = mysqli_num_rows($users_online_qyery);

    ?>
    
        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>   

        <div id="page-wrapper">
        
            <div class="container-fluid">
                <!-- Page Heading -->
            
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to <?php echo $_SESSION['user_role']; ?> 
                            <small> <?php echo $_SESSION['firstname']; ?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                
                
                
                
                
                <div class="row">
                    
                    
<!--                    -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $all_posts = mysqli_query($connection,$query);
                                            $post_counts = mysqli_num_rows($all_posts);
                                        ?>
                                        
                                        
                                  <div class='huge'><?php echo $post_counts; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
<!--                    -->
                    
                    
                    
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM comments";
                                            $all_comments = mysqli_query($connection,$query);
                                            $comments_count = mysqli_num_rows($all_comments);
                                        ?>
                                        
                                     <div class='huge'><?php echo $comments_count; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM users";
                                            $all_users = mysqli_query($connection,$query);
                                            $users_counts = mysqli_num_rows($all_users);
                                        ?>
                                    <div class='huge'><?php echo $users_counts; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $all_categories = mysqli_query($connection,$query);
                                            $categories_counts = mysqli_num_rows($all_categories);
                                        ?>
                                        <div class='huge'><?php echo $categories_counts; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categoris.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class ="row">
                                    
                    <?php
                        $query_publish = "SELECT * FROM posts WHERE post_status = 'publish'";
                        $all_posts_publish = mysqli_query($connection,$query);
                        $post_publish_count = mysqli_num_rows($all_posts_publish);
                        //draft post
                        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                        $all_posts_draft = mysqli_query($connection,$query_publish);
                        $post_draft_count = mysqli_num_rows($all_posts_publish );
                        //comment pending
                        $query_comment = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                        $all_comments_unapproved = mysqli_query($connection,$query_comment);
                        $comments_unapproved_count = mysqli_num_rows($all_comments_unapproved);
                        //Subscribers
                        $query_users_subscriber = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                        $all_users_subscriber = mysqli_query($connection,$query_users_subscriber);
                        $users_subscriber_count = mysqli_num_rows($all_users_subscriber);
                        
                    ?>
                    
                    
                     <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Date', 'Count'],
//                      <?php
                        $element_text = ['All posts','Active Posts','Draft Posts','Comments','Pending Comments', 'Users','Subscribers','categories'];
                        $element_count= [$post_counts,$post_publish_count, $post_draft_count,$comments_count, $comments_unapproved_count, $users_counts,$users_subscriber_count ,$categories_counts];
        
                            for($i=0;$i < 7; $i++){?>
//                            echo "['{$element_text[$i]}'". "," ."{$element_count[$i]} ],";
                             ['<?php echo $element_text[$i];?>', <?php echo $element_count[$i]; ?>],
                          <?php   }    ?>
////    
//                     
                         ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle:'',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
    </script>
                
                
                <div id="columnchart_material" style="width: 'auto'; height: 400px;"></div>
                </div>
                
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php";?>