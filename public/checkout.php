<?php require_once("../resources/config.php"); ?>


<?php include(TEMPLATE_FRONT. DS . "header.php"); ?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
    <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
    <h1>Checkout</h1>

<form action="">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
        </tbody>
    </table>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount">
<?php 

echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";
?>
</span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">

<?php 
    echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";
?>
&#2547;
</span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->

 <hr>
 <form style="margin: 0% 25%;" action="" method="post" enctype="multipart/form-data">
 <h1 class="text-center">Customer Information</h1>

 <div class="form-group">
      <label for="user-info">Phone Number</label>
         <input type="text" name="number" class="form-control">
</div>

<div class="form-group">
      <label for="user-info">Shipping Address</label>
      <textarea name="location" id="" cols="15" rows="5" class="form-control"></textarea>
        
</div>

<input type="submit" name="publish" class="btn btn-primary btn-lg" value="Purchase">
 </form>  

    </div>
    <!-- /.container -->

    <?php include(TEMPLATE_FRONT. DS . "footer.php"); ?>