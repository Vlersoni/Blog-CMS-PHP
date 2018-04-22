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
                     if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                        $search_query = mysqli_query($connection,$query);
                        if(!$search_query){
                            die("QUERY FAILED" . mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($search_query);
                        if($count == 0){
                            echo "<h1> NO RESULT </h1>";
                        }else{
                            echo "<h1> SOME RESULTs</h1>";
//                            $query = "SELECT * FROM posts";
//                            $select_all_posts_query = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($search_query)){
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
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_data;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="Foto1">
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                             
               
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
            <?php
                    }
                      }
                    }

                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sitebar.php";?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php";?>