<?php

if(isset($_GET['id'])) {


  $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
  confirm($query);
  
  while($row = fetch_array($query)) {
  
       $product_name = escape_string($row['product_name']); 
       $product_description = escape_string($row['product_description']);
       $product_price = escape_string($row['product_price']);
       $product_quantity = escape_string($row['product_quantity']);
       $product_catagory_id = escape_string($row['product_catagory_id']);
       $product_size = escape_string($row['product_size']);
       $prouct_color = escape_string($row['prouct_color']);
      // $product_model = escape_string($row['product_model']);
       $product_image = escape_string($row['product_image']);

       
  
  
  
  $product_image = display_image($row['product_image']);
  
  
  
      }
  
  
  update_product();
  
  
  
  }
  




?>


<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit Product
</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control" value="<?php echo $product_name; ?>">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $product_description; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
      </div>
    </div>





</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>


        <select name="product_category_id" id="" class="form-control">
              

            <option value="<?php echo $product_catagory_id; ?>"><?php echo show_product_cat($product_catagory_id); ?></option>

            <?php show_catagories_add_product(); ?>
           
        </select>


</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
        <input type="number" name="product_quantity" class="form-control" value="<?php echo $product_quantity; ?>">
    </div>


    <div class="form-group">
      <label for="product-title">Product Size</label>
        <input type="number" name="product_size" class="form-control" value="<?php echo $product_size; ?>">
    </div>


    <div class="form-group">
      <label for="product-title">Product Design</label>
        <input type="number" name="prouct_cokor" class="form-control" value="<?php echo $prouct_color; ?>">
    </div>


<!-- Product Tags -->


   <!--  <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div>
 -->
    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file"> <br>

        <img width='200' src="../../resources/<?php echo $product_image; ?>" alt="">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>


