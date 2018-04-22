<?php include "includes/admin_header.php";?>
<div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>   

        <div id="page-wrapper">
        
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h2>Users</h2>
                     <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                             $source = '';
                        }
                        switch($source){
                            case 'add_user':
                                   include "includes/add_user.php";
                                break;
                            case 'edit_user':
                                     include "includes/edit_user.php";
                                break;
                            case 'delete_user':
                                    $id = $_GET['id'];
                                    deleteUsers($id);
                                break;
                                 case 'admin':
                                    $id = $_GET['id'];
                                    changleAdmin($id);
                                break;
                                 case 'subscriber':
                                    $id = $_GET['id'];
                                    changleSubscriber($id);
                            default:
                                  include "includes/view_all_users.php";
                                break;
                                                               
                        }
                        
                        
                        ?>
                                                      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php";?>