<?php 
    if(isset($_POST['checkboxArray']) && isset($_POST['bulk_opcions'])){
       foreach($_POST['checkboxArray'] as $checkBoxValue){   
           $bulk_opcions = $_POST['bulk_opcions'];

           switch($bulk_opcions){
               case 'publish':
                   $query = "UPDATE posts SET post_status ='publish' WHERE post_id ='{$checkBoxValue}'";
                   $publish_Convert_Query = mysqli_query($connection,$query);
                    break;
               case 'draft':
                     $query = "UPDATE posts SET post_status ='draft' WHERE post_id ='{$checkBoxValue}'";
                     $draft_Convert_Query = mysqli_query($connection,$query);
                    break;
               case 'delete':
                    $query = "DELETE FROM posts ";
                    $query .= "WHERE post_id = {$checkBoxValue}"; 
                    $delete_posts_query = mysqli_query($connection,$query);
                    header("Location:posts.php");
              break;
               case 'clone':
                $query = "SELECT * FROM posts WHERE post_id ='{$checkBoxValue}'";
                $select_post_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($select_post_query)){
                    $post_author        = $row['post_author'];
                    $post_title         = $row['post_title'];
                    $post_category_id   = $row['post_category_id'];
                    $post_status        = $row['post_status'];
                    $post_image         = $row['post_image'];
                    $post_tags          = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date          = $row['post_date'];
                }
               $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
                $query .= "VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                $insert_posts_query = mysqli_query($connection,$query);
                if($insert_posts_query){
                    header("Location:posts.php");
                }                     
              break;
               case 'resetViews':
                  $query = "UPDATE posts SET post_views_count ='0' WHERE post_id ='{$checkBoxValue}'";
                  $views_reset_Query = mysqli_query($connection,$query);
              break;

           }
           
           
       }
    }

?>

<script type="text/javascript">
    checked=false;
    function checkedAll (frm1) {var aa= document.getElementById('frm1'); if (checked == false)
    {
    checked = true
    }
    else
    {
    checked = false
    }for (var i =0; i < aa.elements.length; i++){ aa.elements[i].checked = checked;}
    }
</script>

<form action="" method="post" id="frm1">
    

<table class="table table-bordered table-hover">
    
        <div id="bulkoptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_opcions" id="">
            
                <option value="">Select Options</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="resetViews">Reset Views</option>
            
            </select>
        <br>
    </div>
    <div class="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
     <a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>

    </div>
    
                            <thead>
                                <tr>
                                    <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Views</th>
                                    <th colspan="3" class="text-center">Opctions</th>
                                </tr>
                            </thead>
                             <tbody>
                            <?php show_all_posts();?>
                        </tbody>     
                         </table>
</form>


<?php 
    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts ";
        $query .= "WHERE post_id = {$post_id}"; 
        $delete_posts_query = mysqli_query($connection,$query);
        header("Location:posts.php");
    }




?>