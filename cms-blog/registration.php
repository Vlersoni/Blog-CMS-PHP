<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
    $message = "";
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];    

        if(!empty($username) && !empty($email) && !empty($password)){
        
    
        $username = mysqli_real_escape_string($connection,$username);
        $email    = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
            
        $password = password_hash($password,PASSWORD_BCRYPT, array('cost' => 12));

//        $query = "SELECT randSalt FROM users";
//        $select_randsalt_query = mysqli_query($connection,$query);
//        if(!$select_randsalt_query){
//            die("Query Faild ".mysqli_error($connection));           
//        }
//            $row = mysqli_fetch_array($select_randsalt_query);
//            $salt = $row['randSalt'];
//            $password = crypt($password,$salt);
//            
            $query = "INSERT into users(user_username, user_email, user_password) ";
            $query .= "VALUES ('{$username}','{$email}','{$password}')";
            
            $query = mysqli_query($connection, $query);
            if(!$query){
                  die("Query Faild ".mysqli_error($connection));  
                }            
             else{
                $message = " <div class='alert alert-success alert-dismissable'>
                     <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
                      <strong>Success!</strong> U regjistruat me sukses.
                    </div>";
            }
        }
        else{
     
           $message =" <div class='alert alert-danger alert-dismissable'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
              <strong>Info!</strong> Plotsoni te gjitha fushat.
            </div>";

        }
        
    
    }      
?>


    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h1><?php echo $message; ?></h1>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
