    

    <div class="col-md-4">
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
                }
            }
        ?>
        
          <div class="well">
              <h5><?php echo "Momentalisht jan online: ".visitor_online()." Vizitor"; ?></h5>
          </div>
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" name ="search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" name="submit" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form> <!-- /search form -->
                    <!-- /.input-group -->
                </div>
        
        
        <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input type="text" name ="username" class="form-control" placeholder="Enter username">
                        </div>
                        <div class="input-group">
                            <input type="password" name ="password" class="form-control" placeholder="Enter password">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Login</button>
                            </span>
                        </div>
                    </form> <!-- /search form -->
                    <!-- /.input-group -->
                </div>
        
                
        
        

                <!-- Blog Categories Well -->
                <div class="well">
                     <?php
                    $query = "SELECT * FROM categories LIMIT 6";
                        $select_categories_sitebar = mysqli_query($connection,$query);
                    ?>
                    
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                    while($row = mysqli_fetch_assoc($select_categories_sitebar)){
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                   }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               <?php include "widget.php";?>

            </div>