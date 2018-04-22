<?php include "includes/admin_header.php";?>
<div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>   

        <div id="page-wrapper">
        
            <div class="container-fluid">
                <!-- Page Heading -->
            
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to admin 
                            <small>Author</small>
                         </h1>     
                            <div class="col-xs-6">
                                <?php
                                    //call function insert_categories();
                                    insert_categories();
                                    //call function delete_categories();
                                    delete_categories();                                 
                                ?>                          
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="cat-title">Add Category</label>
                                        <input type="text" class="form-control" name="cat_title">
                                    </div>      
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                    </div>                   
                                </form>
                                <?php // UPDATE AND INCLUDE QUERY
                                    if(isset($_GET['edit'])){
                                        $cat_id = $_GET['edit'];
                                        include "includes/update_categories.php";
                                    }
                                ?>
                            </div><!-- Add Category Form -->
                        
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">CategoryTitle</th>
                                        <th colspan="2" class="text-center">Opction</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Find all categories query
                                      findAllCategoris();
                                ?>
                                                                      
                                </tbody>
                            </table>

                        </div>
                                            
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php";?>