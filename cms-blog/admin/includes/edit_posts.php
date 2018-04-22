<?php
    
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
        $the_cat_id = $_GET['c_id'];
    }
     $query = "SELECT * FROM posts where post_id = '$the_post_id'";
           $select_posts_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_posts_by_id)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                }
    if(isset($_POST['update_post'])){
             $post_title =protection($_POST['title']);
             $post_category_id = protection($_POST['post_category_id']);
             $post_author = protection($_POST['author']);
             $post_status = protection($_POST['post_status']);
             $post_image = $_FILES['image']['name'];
             $post_image_temp = $_FILES['image']['tmp_name'];
             $post_tags = protection($_POST['post_tags']);
             $post_content = protection($_POST['post_content']);
             $post_status = protection($_POST['post_status']);
             move_uploaded_file($post_image_temp, "../images/$post_image");
            if(empty($post_image)){
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_img = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_img)){
                      $post_image = $row['post_image'];     
                }
                
            }
            if(empty($post_category_id)){
               $post_category_id = $the_cat_id;     
            }
            //Query update
             $query = "UPDATE posts SET ";
             $query .= "post_title = '{$post_title}', ";
             $query .= "post_category_id = '{$post_category_id}', ";
             $query .= "post_date = now(), ";
             $query .= "post_author = '{$post_author}', ";
             $query .= "post_status = '{$post_status}', ";
             $query .= "post_image = '{$post_image}', ";
             $query .= "post_tags = '{$post_tags}', ";
             $query .= "post_content = '{$post_content}' "; // te fundit nuk i vyn presje
             $query .= "WHERE post_id = {$the_post_id}";
           
             $update_post = mysqli_query($connection,$query);
                
             test_query($update_post);
             header("users.php?source=edit_user&id=4.php");       
        
    }
    
?>




<form action="" method="post" enctype="multipart/form-data">
     
    <div class="form-group">
        <label for="post_category">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="title">Post Category</label>
        <div class="form-group">
            <select name="post_category_id"  id="">
                <option value="">Select Categoris</option>
                <?php
                      $query ="SELECT * FROM categories";
                      $select_categories = mysqli_query($connection,$query);
                      test_query($select_categories);        
                    while($row = mysqli_fetch_assoc($select_categories)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            
                        echo"<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                ?>
            </select>
            </div>
    </div>
    
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author;?>" type="text" class="form-control" name="author" readonly>
    </div>
    
    <div class="form-group">
        <label for="title">Post Status</label>
        <select name="post_status"  id="">
                <?php if($post_status == 'draft'){?>
                    <option value='draft'>draft</option>
                    <option value='publish'>publish</option>
                <?php }else{?>
                    <option value='publish'>publish</option>
                    <option value='draft'>draft</option>
                <?php } ?>
           </select>
    </div>
    
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image;?>" alt="img missing">
         <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="title">Post Content</label>
       <textarea  class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content;?>
        </textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
    
 </form>