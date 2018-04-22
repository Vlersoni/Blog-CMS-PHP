<?php include "includes/db.php";?>
<?php session_start();?>
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
                $per_page = 2;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }
                else{
                    $page ="";
                }
                
                if($page == "" || $page == 1){
                    $page_1 = 0;
                }else{
                    $page_1 =($page * $per_page) - $per_page;
                    // numri i faqes * numri qe duhet me u shfaq - numri i faqeve qe jan shfaq
                }
                
                
                
                
                
                $post_query_count ="SELECT * FROM posts ";
                $find_count  = mysqli_query($connection,$post_query_count);
                $count = mysqli_num_rows($find_count);
                
                $count = ceil($count / $per_page);
                
                
                
                    $query = "SELECT * FROM posts LIMIT $page_1,$per_page";
                    $select_all_posts_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id      = $row['post_id'];
                        $post_title   = $row['post_title'];
                        $post_author  = $row['post_author'];
                        $post_data    = $row['post_date'];
                        $post_img     = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100); // cakton numrin e shkronav qe e i shfaq ne ket rast 100 shkronjat e para i shfaq 
                        $post_status = $row['post_status'];
                        if($post_status == 'publish'){
                    ?>
                 
                <h1 class="page-header">
                    <?php echo $count; ?>
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_data;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="Foto1">
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php } }?>
                
               
                <!-- Pager -->
               <ul class="pager">
                    <?php
                        for($i=1;$i <= $count;$i++){
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    ?>
               </ul>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sitebar.php";?>

        </div>
        <!-- /.row -->
<!--
        <ul class="pager">
            <?php
                for($i=1;$i <= $count;$i++){
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            ?>
        </ul>
-->

        <hr>
<?php include "includes/footer.php";  ?>