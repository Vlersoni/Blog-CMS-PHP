<?php 
    if(isset($_POST['checkboxArray']) && isset($_POST['bulk_opcions'])){
       foreach($_POST['checkboxArray'] as $checkBoxValue){  
//           echo  $checkBoxValue;
//           echo  $_POST['bulk_opcions'];
           $bulk_opcions = $_POST['bulk_opcions'];
           switch($bulk_opcions){
               case 'unapproved':
                   $query = "UPDATE comments SET comment_status ='unapproved' WHERE comment_id ='{$checkBoxValue}'";
                   $unapproved_Convert_Query = mysqli_query($connection,$query);
                    break;
               case 'approved':
                     $query = "UPDATE comments SET comment_status ='approved' WHERE comment_id ='{$checkBoxValue}'";
                     $approved_Convert_Query = mysqli_query($connection,$query);
                    break;
               case 'delete':
                    $query = "DELETE FROM comments ";
                    $query .= "WHERE comment_id = {$checkBoxValue}"; 
                    $delete_comments_query = mysqli_query($connection,$query);
                    header("Location:comments.php");
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
                <option value="unapproved">Unapproved</option>
                <option value="approved">Approved</option>
                <option value="delete">Delete</option>
                
            </select>
        <br>
    </div>
     <div class="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
       </div>

                            <thead>
                                <tr>
                                     <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                             <tbody>
                                <?php
                                 if(isset($_GET['id_c'])){
                                    $id_c = $_GET['id_c'];
                                    displays_certain_comments($id_c);
                                 }else{
                                 show_all_comments();
                                 }
                                 ?>
                        </tbody>     
                         </table>
</form>



<?php 
//Aprove
    if(isset($_GET['approve'])){
            $comment_unapprove = $_GET['approve'];
            $query = "UPDATE comments SET comment_status = 'approved'";
            $query .= "WHERE comment_id = {$comment_unapprove}"; 
            $comment_approve_query = mysqli_query($connection,$query);
            header("Location: comments.php");
    }
    
    //UnApprove
if(isset($_GET['unapprove'])){
            $comment_unapprove = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status = 'unapproved'";
            $query .= "WHERE comment_id = {$comment_unapprove}"; 
            $comment_unapprove_query = mysqli_query($connection,$query);
            header("Location: comments.php");
    }

    //Delte
    if(isset($_GET['delete'])){
            $comment_delete = $_GET['delete'];
            $query = "DELETE FROM comments ";
            $query .= "WHERE comment_id = {$comment_delete}"; 
            $delete_category_query = mysqli_query($connection,$query);
            header("Location: comments.php");
    }
    



?>