<?php
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $query ="SELECT * FROM users WHERE user_id = {$user_id}";
        $select_users = mysqli_query($connection,$query);
        test_query($select_users);        
        while($row = mysqli_fetch_assoc($select_users)){
            $user_id        = $row['user_id'];
            $user_role      = $row['user_role'];
            $user_firstname = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_role      = $row['user_role'];
            $user_username  = $row['user_username'];
            $user_email     = $row['user_email'];
            $user_password  = $row['user_password'];
            edit_user($user_id);
        }
    }else{
        header("Location:users.php");
    }
?>
<form action="" method="post" enctype="multipart/form-data">
     
    <div class="form-group">
        <label for="post_category">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
    </div>
        <div class="form-group">
        <label for="post_category">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <div class="form-group">
            
            <select name="user_role"  id="">
                echo"<option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>";
                <?php
                      $query ="SELECT * FROM users";
                      $select_users = mysqli_query($connection,$query);
                      test_query($select_users);        
                    while($row = mysqli_fetch_assoc($select_users)){
                         $user_id = $row['user_id'];
                         $user_role1 = $row['user_role'];
                         if($user_role1 != $user_role){
                            echo"<option value='{$user_id}'>{$user_role1}</option>";
                        }
                    }
                ?>
            </select>
            </div>
    </div>
    
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="user_username" value="<?php echo $user_username;?>">
    </div>
    
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>">
    </div>
    
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;?>">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
    
 </form>