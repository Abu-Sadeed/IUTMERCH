<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT. DS . "header.php"); ?>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
            <h5 class="text-center bg-warning"><?php display_message(); ?></h5>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
            
                <?php login_customer(); ?>

                <div class="form-group"><label for="name">
                    Username<input type="text" name="customer_name" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="customer_password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  


    </header>


        </div>

    </div>
    
    <?php include(TEMPLATE_FRONT. DS . "footer.php"); ?>
