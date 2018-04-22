<?php
    //users_online 
    function users_online(){  
        global $connection;
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection,$query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");
        }else{
             mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session ='$session'");
        }
        $users_online_qyery = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        return $count_user = mysqli_num_rows($users_online_qyery);
    }

    //protection
    function protection($variable){
        global $connection;
       $result = mysqli_real_escape_string($connection,trim($variable));
        return $result;
    }

    //Test query
    function test_query($query_result){
        global $connection;
        if(!$query_result){
             die("QUERY FAILD ".mysqli_error($connection));
        }
    }

    //--- FUNCTION FOR ADD_POSTS
    //insert new posts
    function add_posts(){
        global $connection;
        if(isset($_POST['create_post'])){

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
                $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
                $query .= "VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                $insert_posts_query = mysqli_query($connection,$query);
                if(!test_query($insert_posts_query)){
                    header("Location:posts.php");
                }
        }    
    }
    //show all posts
      function show_all_posts(){
           global $connection;
           $query = "SELECT * FROM posts";
           $select_posts_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_posts_query)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_views_count = $row['post_views_count'];
                    $query_categoris = "SELECT * FROM categories where cat_id = $post_category_id";
                    $select_category = mysqli_query($connection,$query_categoris);
                    while($row = mysqli_fetch_assoc($select_category)){
                         $post_category_name = $row['cat_title'];
                     }
                        echo "<tr>
                            <td><input class='checkBoxes' type='checkbox' name='checkboxArray[]'value='{$post_id}' id='myCheck'></td>
                            <td>{$post_id}</td>
                            <td>{$post_author}</td>
                            <td>{$post_title}</td>
                            <td>{$post_category_name}</td>
                            <td>{$post_status}</td>
                            <td><img  width='50' height='50' src ='../images/$post_image' alt='missing the picture'></td>
                            <td>{$post_tags}</td>
                            <td><a href='comments.php?id_c={$post_id}'>{$post_comment_count}</a></td>
                            <td>{$post_date}</td>
                            <td>{$post_views_count}</td>
                            <td><a a href='../post.php?p_id=$post_id'>View Post</a></td>
                            <td><a href='posts.php?source=edit_posts&p_id={$post_id}&c_id={$post_category_id}'>Edit</a></td>
                            <td><a onClick=\"javascript:return confirm('A jeni i sigurt qe deshironi ta fshini postin pas fshirjes nuk ka me kthim te shenimeve');\" href='posts.php?delete={$post_id}'>Delete</a></td>
                        </tr>";
                    }
            }

    //Show all commentes
    function show_all_comments(){
            global $connection;
            $query = "SELECT * FROM comments";
            $select_posts_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_posts_query)){
                    $comment_id      = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author  = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_email   = $row['comment_email'];
                    $comment_status  = $row['comment_status'];
                    $comment_date    = $row['comment_date'];
                    $post_title = "someTitle";
                    
                    $query_posts = "SELECT * FROM posts WHERE post_id = '$comment_post_id'";
                    $select_post_id_query = mysqli_query($connection,$query_posts);
                        while($row1 = mysqli_fetch_assoc($select_post_id_query)){
                            $post_id = $row1 ['post_id'];
                            $post_title = $row1 ['post_title'];  
                        }
                        echo "<tr>
                                <td><input class='checkBoxes' type='checkbox' name='checkboxArray[]'value='{$comment_id}' id='myCheck'></td>
                                <td>{$comment_id}</td>
                                <td>{$comment_author}</td>
                                <td>{$comment_content}</td>
                                <td>{$comment_email}</td>
                                <td>{$comment_status}</td>
                                <td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>
                                <td>{$comment_date}</td>

                                <td><a href='comments.php?approve={$comment_id}'>Approve</a></td>
                                <td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>
                                <td><a href='comments.php?delete={$comment_id}'>Delete</a></td>
                            </tr>";
                        }
                    }

    //Displays certain comments
    function displays_certain_comments($id){
        global $connection;
            $query = "SELECT * FROM comments";
            $select_posts_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_posts_query)){
                    $comment_id      = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author  = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_email   = $row['comment_email'];
                    $comment_status  = $row['comment_status'];
                    $comment_date    = $row['comment_date'];
                    $post_title = "someTitle";
                    
                    $query_posts = "SELECT * FROM posts WHERE post_id = '$comment_post_id'";
                    $select_post_id_query = mysqli_query($connection,$query_posts);
                        while($row1 = mysqli_fetch_assoc($select_post_id_query)){
                            $post_id = $row1 ['post_id'];
                            $post_title = $row1 ['post_title'];  
                        }
                    if($id == $row['comment_post_id']){
                        echo "<tr>
                                <td><input class='checkBoxes' type='checkbox' name='checkboxArray[]'value='{$comment_id}' id='myCheck'></td>
                                <td>{$comment_id}</td>
                                <td>{$comment_author}</td>
                                <td>{$comment_content}</td>
                                <td>{$comment_email}</td>
                                <td>{$comment_status}</td>
                                <td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>
                                <td>{$comment_date}</td>

                                <td><a href='comments.php?approve={$comment_id}'>Approve</a></td>
                                <td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>
                                <td><a href='comments.php?delete={$comment_id}'>Delete</a></td>
                            </tr>";
                    }
                }
        }

    //--- FUNCTION FOR CATEGORY
     //insert category
    function insert_categories(){
        global $connection;
       if(isset($_POST['submit'])){
           $cat_title = mysqli_real_escape_string($connection,$_POST['cat_title']);
            if($cat_title =="" || empty($cat_title)){
                echo "This field should not be empty";
            }
            else{
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUE('{$cat_title}') "; 
                $create_category_query = mysqli_query($connection,$query);
                    test_query($create_category_query);
                }                                
            }
        }

    //delete category
    function delete_categories(){
        global $connection;
        if(isset($_GET['delete'])){
            $category_delete = $_GET['delete'];
            $query = "DELETE FROM categories ";
            $query .= "WHERE cat_id = {$category_delete}"; 
            $delete_category_query = mysqli_query($connection,$query);
            header("Location: categoris.php");
        } 
    }

    // All categoris
    function findAllCategoris(){
         global $connection;
         $query ="SELECT * FROM categories";
         $select_categories = mysqli_query($connection,$query);
         while($row = mysqli_fetch_assoc($select_categories)){
            echo "<tr>
                <td>{$row['cat_id']}</td>
                <td>{$row['cat_title']}</td>
                <td><a href='categoris.php?delete={$row['cat_id']}'>DELETE</a></td>
                <td><a href='categoris.php?edit={$row['cat_id']}'>EDIT</a></td>
                </tr>";
        }
    }

//--- FUNCTION FOR USERS
    //Show All Users
    function show_all_users(){
        global $connection;
        $query = "SELECT * FROM users";
       $select_users = mysqli_query($connection,$query);
    
        while($row = mysqli_fetch_assoc($select_users)){
        $user_id        = $row['user_id'];
        $user_username= $row['user_username'];
        $user_firstname= $row['user_firstname'];
        $user_lastname= $row['user_lastname'];
        $user_email= $row['user_email'];
        $user_image= $row['user_image'];
        $user_role= $row['user_role'];
        $randSalt= $row['randSalt'];
        
        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";
        echo"<td><a href='users.php?source=delete_user&id={$user_id}'>DELETE</a></td>";
        echo"<td><a href='users.php?source=edit_user&id={$user_id}'>EDIT</a></td>";
        echo"<td><a href='users.php?source=admin&id={$user_id}'>Admin</a></td>";
        echo"<td><a href='users.php?source=subscriber&id={$user_id}'>Subscriber</a></td>";
        echo "</tr>";
        }
    }

    //add_user
    function add_user(){
        global $connection;
        if(isset($_POST['create_user'])){
        $user_firstname  = $_POST['user_firstname'];
        $user_lastname   = $_POST['user_lastname'];
        $user_role       = $_POST['user_role'];
        $user_username   = $_POST['user_username'];
        $user_email      = $_POST['user_email'];
        $user_password   = $_POST['user_password'];
        $user_password   =password_hash($user_password,PASSWORD_BCRYPT, array('cost' => 12));    
         
        $query ="INSERT INTO users (user_username,user_firstname,user_lastname,user_email,user_role,user_password)";
        $query .="VALUE ('{$user_username}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}','{$user_password}')";
        $insert_user = mysqli_query($connection,$query);
        echo "User Created:"." "."<a href='users.php'>View Users</a>";
           if(!test_query($insert_user)){
                header("Location:users.php?source=add_user&user=true");
            }
        }
    }

   //edit user
    function edit_user($id){
        global $connection;
        if(isset($_POST['edit_user'])){
            
        $user_firstname  = $_POST['user_firstname'];
        $user_lastname   = $_POST['user_lastname'];
        $user_role       = $_POST['user_role'];
        $user_username   = $_POST['user_username'];
        $user_email      = $_POST['user_email'];
        $user_password   = $_POST['user_password'];
        $user_password   =password_hash($user_password,PASSWORD_BCRYPT, array('cost' => 12));
        $query = "UPDATE users SET  user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="user_username = '{$user_username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$user_password}' ";
        $query .="WHERE user_id = '{$id}'";

        
        $udate_query_users = mysqli_query($connection,$query);
            if(!test_query($udate_query_users)){
                header("Location:users.php");
            }                    
        }
    }

    //upggrade Admin
    function changleAdmin($id){
         global $connection;
         $query = "UPDATE users SET  user_role = 'Admin' Where user_id ='{$id}'";
         $query_upgrade = mysqli_query($connection,$query);
        if(!test_query($query_upgrade)){
            header("Location:users.php");
        }
    }

    //changleSubscriber
    function changleSubscriber($id){
         global $connection;
         $query = "UPDATE users SET  user_role = 'Subscriber' Where user_id ='{$id}'";
         $query_subscriber = mysqli_query($connection,$query);
        if(!test_query($query_subscriber)){
            header("Location:users.php");
        }
    }
    
    //Delete Users
    function deleteUsers($id){
        global $connection;
        $query ="DELETE FROM users WHERE user_id = '{$id}'";
        $delete_users_query = mysqli_query($connection,$query);
        header("Location: users.php");
    }
    
    //Online Visitor
    function visitor_online(){  
        global $connection;
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM visitor_online WHERE session = '$session'";
        $send_query = mysqli_query($connection,$query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO visitor_online(session, time) VALUES ('$session','$time')");
        }else{
             mysqli_query($connection, "UPDATE visitor_online SET time = '$time' WHERE session ='$session'");
        }
        $users_online_query = mysqli_query($connection, "SELECT * FROM visitor_online WHERE time > '$time_out'");
        return $count_user = mysqli_num_rows($users_online_query);   
    }
?>