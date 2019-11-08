<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT. DS . "header.php"); ?>


<h1 class="text-center">
      Sign-up
      
  </h1>

  




<form style="margin: 0% 33.33%;" action="" class="container" method="post" enctype="multipart/form-data">

<?php signup_user(); ?>


  <div class="align-items-center col-md-6">

     <div class="form-group">
     
      <!-- <input type="file" name="file"> -->
         
     </div>


     <div class="form-group">
      <label for="customer_name">Username</label>
      <input type="text" name="customer_name" class="form-control" >
         
     </div>


      <div class="form-group">
          <label for="customer_email">Email</label>
      <input type="text" name="customer_email" class="form-control"   >
         
     </div>

<!-- 
      <div class="form-group">
          <label for="first name">First Name</label>
      <input type="text" name="first_name" class="form-control"   >
         
     </div> -->
<!-- 
      <div class="form-group">
          <label for="last name">Last Name</label>
      <input type="text" name="last_name" class="form-control"   >
         
     </div> -->


      <div class="form-group">
          <label for="customer_password">Password</label>
      <input type="password" name="customer_password" class="form-control"  >
         
     </div>

      <div class="form-group">

      <a id="user-id" class="btn btn-danger" href="">Delete</a>

      <input type="submit" name="sign_user" class="btn btn-primary pull-right" value="Sign User" >
         
     </div>


      

  </div>



</form>






<?php include(TEMPLATE_FRONT. DS . "footer.php"); ?>