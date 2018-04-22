<?php include "includes/admin_header.php";?>
<div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>   
    <?php
        if(isset($_SESSION['username'])){
           $username = $_SESSION['username'];
           $query ="SELECT * FROM users WHERE user_username = '{$username}'";
           $select_user_profile_query = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_array($select_user_profile_query)){
                $user_id        = $row['user_id'];
                $user_username  = $row['user_username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname  = $row['user_lastname'];
                $user_password  = $row['user_password'];
                $user_email     = $row['user_email'];
                $user_image     = $row['user_image'];
                $user_role      = $row['user_role'];
                $randSalt       = $row['randSalt'];
            }
        }
    if(isset($_POST['update_profil'])){
            
        $user_firstname  = $_POST['user_firstname'];
        $user_lastname   = $_POST['user_lastname'];
        $user_role       = $_POST['user_role'];
        $user_username   = $_POST['user_username'];
        $user_email      = $_POST['user_email'];
        $user_password   = $_POST['user_password'];
        
        $query = "UPDATE users SET  user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="user_username = '{$user_username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$user_password}' ";
        $query .="WHERE user_id = '{$user_id}'";

        
        $udate_query_users = mysqli_query($connection,$query);
            if(!test_query($udate_query_users)){
                header("Location:profile.php");
            }                    
        }
    ?>
    
    
    
    
        <div id="page-wrapper">
        
            <div class="container-fluid">
                <!-- Page Heading -->
            
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to <?php echo $_SESSION['user_role']; ?> 
                            <small> <?php echo $_SESSION['firstname']; ?></small>
                        </h1>
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
                            <input class="btn btn-primary" type="submit" name="update_profil" value="Update Profile">
                        </div>

                     </form>
                       
                    </div>
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php";?>