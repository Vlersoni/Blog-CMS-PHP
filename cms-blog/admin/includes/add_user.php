<?php 
    add_user();
    if(isset($_GET['user'])){
        echo "User Created:"." "."<a href='users.php'>View Users</a>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
     
    <div class="form-group">
        <label for="post_category">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
        <div class="form-group">
        <label for="post_category">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="title"></label>
        <div class="form-group">
            <select name="user_role"  id="">
                    <option value=''>Select Opction</option>
                    <option value='Admin'>Admin</option>
                    <option value='Subscriber'>Subscriber</option>
                </select>
            </div>
    </div>
    
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="user_username">
    </div>
    
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
    
 </form>