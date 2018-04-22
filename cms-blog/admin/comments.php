<?php include "includes/admin_header.php";?>
<div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>   

        <div id="page-wrapper">
        
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h2>Comments</h2>
                     <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                             $source = '';
                        }
                        switch($source){
                            case 'add_posts':
                                   include "includes/add_posts.php";
                                break;
                            case 'edit_posts':
                                     include "includes/edit_posts.php";
                                break;
                            case 'Delete':
                                    $id = $_GET['id'];
                                    deletePosts($id);
                            default:
                                  include "includes/view_all_comments.php";
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