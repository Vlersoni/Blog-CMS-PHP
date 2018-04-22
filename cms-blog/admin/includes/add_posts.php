<?php 
    add_posts();
?>

<form action="" method="post" enctype="multipart/form-data">
     
    <div class="form-group">
        <label for="post_category">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
        <div class="form-group">
        <label for="title">Post Category</label>
        <div class="form-group">
            <select name="post_category_id"  id="">
                <br>
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
        <br>
         <select name="author"  id="">
    
                <?php
                      $query ="SELECT * FROM users";
                      $select_Users = mysqli_query($connection,$query);
                      test_query($select_Users);        
                    while($row = mysqli_fetch_assoc($select_Users)){
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            
                        echo"<option value='{$user_firstname} {$user_lastname}'>{$user_firstname} {$user_lastname}</option>";
                    }
                ?>
            </select>
        
    </div>
    
    <div class="form-group">
        <label for="title">Post Status</label>
                        <br>
           <select name="post_status"  id="">
                    <option value='draft'>draft</option>
                    <option value='publish'>publish</option>
           </select>
    </div>
    
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="title">Post Content</label>
       <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
    
 </form>