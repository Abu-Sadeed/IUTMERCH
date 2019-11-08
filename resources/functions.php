<?php

$upload_directory = "uploads";

// helper function

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    } else{
        $msg = "";
    }
}

function display_message(){
    if(isset($_SESSION['message'])){

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }
}

function redirect($location){
    header("Location: $location");
}

function query($sql){

    global $connection;

    return mysqli_query($connection, $sql);
}

function confirm($result){
    global $connection;

     if(!$result){
         die("QUERY FAILED" . mysqli_error($connection));
     }
 }

function escape_string($string){

    global $connection;

    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){

    return mysqli_fetch_array($result); 
}


/*****************front_end functions********************/

function get_products(){
    $query = query( "SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
        <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
            <a href= "item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
            <div class="caption">
                <h4 class="pull-right">{$row['product_price']}&#x9f3;</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_name']}</a>
                </h4>
                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add To Cart</a>
            </div>
        </div>
    </div>
DELIMETER;

    echo $product;

    


    }
}


function get_categories(){

    $query = query("SELECT * FROM catagories");
    confirm($query);

    while($row = fetch_array($query)){
    
        $catagories = <<<DELIMETER
        <a href="category.php?id={$row['cat_id']}">{$row['cat']}</a>
DELIMETER;

        echo $catagories;

            }
}


function get_catagory_product(){
    $query = query("SELECT * FROM products WHERE product_catagory_id = " . escape_string($_GET['id']) . " ");
    confirm($query);

    while($row = fetch_array($query)){

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
                        <h3><a href="item.php?id={$row['product_id']}">{$row['product_name']}</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
            
DELIMETER;
        echo $product;

    }
}


function get_shop_product(){
    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){
        $product_image = display_image($row['product_image']);
        $product = <<<DELIMETER
        <div  class="col-md-3 col-sm-6 hero-feature">
                <div style="height:450px;" class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
                        <h3><a href="item.php?id={$row['product_id']}">{$row['product_name']}</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $product;

    }
}


function signup_user(){

    if(isset($_POST['sign_user'])) {
    
    
        $username   = escape_string($_POST['customer_name']);
        $email      = escape_string($_POST['customer_email']);
        $password   = escape_string($_POST['customer_password']);
        $type       = 0;
        // $user_photo = escape_string($_FILES['file']['name']);
        // $photo_temp = escape_string($_FILES['file']['tmp_name']);
        
        
        // move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);
        
        
        $query = query("INSERT INTO customer(customer_name, customer_email, customer_password, user_type_admin) VALUES('{$username}','{$email}','{$password}', '{$type}')");
        confirm($query);
        
        set_message("USER SIGNED");
        
        redirect("customer_login.php");
        
        
        
        }


}


function login_customer(){

    if(isset($_POST['submit'])){

        $username = escape_string($_POST['customer_name']);
        $password = escape_string($_POST['customer_password']);

    $query = query("SELECT * from customer WHERE customer_name = '{$username}' AND customer_password = '{$password}'");

    if(mysqli_num_rows($query) == 0){
        set_message("Your Password or Username are wrong");
        redirect('customer_login.php');

    } else{
        $_SESSION['username'] = $username;
        $row = fetch_array($query);
        $user_validity = $row['user_type_admin'];
        $_SESSION['user_type_admin'] = $user_validity;

        
        redirect("Index.php");

    }


    }

}




function login_user(){
    if(isset($_POST['submit'])){

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

    $query = query("SELECT * from users WHERE user_name = '{$username}' AND user_password = '{$password}'");

    if(mysqli_num_rows($query) == 0){
        set_message("Your Password or Username are wrong");
        redirect('login.php');

    } else{
        $_SESSION['username'] = $username;
        //set_message("Welcome to Admin {$username}");
        $row = fetch_array($query);
        $user_validity = $row['user_type_admin'];
        $_SESSION['user_type_admin'] = $user_validity;
        
        redirect("admin");

    }
    }
}


function send_message(){
    if(isset($_POST['submit'])){

        $to = "fruitpunchsamurai013@gmail.com";
        $from_name = $_POST['name'];
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $header = "From: {$from_name} {$email}";

        ini_set("SMTP","smtp.example.com" ); 
        ini_set('sendmail_from', $email);

        $result = mail($to, $subject, $message, $header);

        

        if(!$result){
            set_message("Sorry we could not send your message");
            redirect("contact.php");
        } else{
            set_message("Your message has been sent");
            redirect("contact.php");
        }

    }
}




// function get_orders(){

//     if(isset($_POST['submit'])){

//         $phone_no = escape_string($_POST['number']);
//         $location = escape_string($_POST['location']);
//         $products = 

//         $query = query("INSERT into orders(product_name, product_price, product_quantity, product_catagory_id, product_size, prouct_color, product_description, product_image) VALUES('{$product_name}', '{$product_price}', '{$product_quantity}', '{$product_catagory_id}', '{$product_size}', '{$prouct_color}', '{$product_description}', '{$product_image}')");
//         confirm($query); 
//         set_message("Order Done");

   
//     }
//     }


// }



/*****************back_end functions********************/






/************Admin products******************/

function display_image($picture){

    global $upload_directory;
    return $upload_directory . DS . $picture;

}





function get_product_in_admin(){


    $query = query( "SELECT * FROM products");
    confirm($query);
    
    

    while($row = fetch_array($query)){
        $product_image = display_image($row['product_image']);
        $category = show_product_cat($row['product_catagory_id']);
        $product = <<<DELIMETER
         <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_name']}<br>
            <a href="index.php?edit_product&id={$row['product_id']}"><img width='100' src="../../resources/{$product_image}" alt=""></a>
            </td>
            <td>{$category}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td><a class='btn btn-danger' href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
            
        </tr>
DELIMETER;

    echo $product;

    }

}




function show_product_cat($product_catagory_id){

$category_query = query( "SELECT * FROM catagories WHERE cat_id = '{$product_catagory_id}'");
    confirm($category_query);

    while($category_row = fetch_array($category_query)){

        return $category_row['cat'];

    }


} 



/**************************Add product admin******************/

function add_product(){

    if(isset($_POST['publish'])){
    
       $product_name = escape_string($_POST['product_name']); 
       $product_description = escape_string($_POST['product_description']);
       $product_price = escape_string($_POST['product_price']);
       $product_quantity = escape_string($_POST['product_quantity']);
       $product_catagory_id = escape_string($_POST['product_catagory_id']);
       $product_size = escape_string($_POST['product_size']);
       $prouct_color = escape_string($_POST['prouct_color']);
      // $product_model = escape_string($_POST['product_model']);
      
      $upload_directory = "uploads";

      
    move_uploaded_file($tmp_name, "$upload_directory/$name");
      
      $product_image = escape_string($_FILES['file']['name']);

        $image_temp_location = escape_string($_FILES['file']['tmp_name']);
       
       move_uploaded_file($image_temp_location , "$upload_directory/$product_image");

       $query = query("INSERT into products(product_name, product_price, product_quantity, product_catagory_id, product_size, prouct_color, product_description, product_image) VALUES('{$product_name}', '{$product_price}', '{$product_quantity}', '{$product_catagory_id}', '{$product_size}', '{$prouct_color}', '{$product_description}', '{$product_image}')");
       confirm($query); 
       set_message("New Product was added");

       redirect("index.php?products");
    }

}

function show_catagories_add_product(){

    $query = query("SELECT * FROM catagories");
    confirm($query);

    while($row = fetch_array($query)){
    
        $catagories_option = <<<DELIMETER
        <option value="{$row['cat_id']}"> {$row['cat']}</option>
DELIMETER;

        echo $catagories_option;

            }
}




/****************update product*********************/
/*
function update_product(){

    if(isset($_POST['update'])){
    
       $product_name = escape_string($_POST['product_name']); 
       $product_description = escape_string($_POST['product_description']);
       $product_price = escape_string($_POST['product_price']);
       $product_quantity = escape_string($_POST['product_quantity']);
       $product_catagory_id = escape_string($_POST['product_catagory_id']);
       $product_size = escape_string($_POST['product_size']);
       $prouct_color = escape_string($_POST['prouct_color']);
      // $product_model = escape_string($_POST['product_model']);
       $product_image = escape_string($_FILES['file']['name']);

        $image_temp_location = escape_string($_FILES['file']['tmp_name']);


        if(empty($product_image)){

            $get_pic = query("SELECT product_image FROM products WHERE product_id=" . escape_string($_GET['id']) . "");
            confirm($get_pic);
            while($pic = fetch_array($get_pic)){

                $product_image = $pic['product_image'];

            }
        }
       
       move_uploaded_file($image_temp_location , UPLOAD_DIRECTORY . DS . $product_image);

       $query = "UPDATE products SET ";
        $query .= "product_name            = '{$product_name}'        , ";
        $query .= "product_catagory_id      = '{$product_catagory_id}'  , ";
        $query .= "product_price            = '{$product_price}'        , ";
        $query .= "product_description      = '{$product_description}'  , ";
        $query .= "prouct_color             = '{$prouct_color}'         , ";
        $query .= "product_quantity         = '{$product_quantity}'     , ";
        $query .= "product_image            = '{$product_image}'          ";
        $query .= "product_size             = '{$product_size}'           ";
        $query .= "WHERE product_id=" . escape_string($_GET['id']);
        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Product has been updated");

       redirect("index.php?products");
    }

}
*/

/**  Catagory in admin        */

function show_catagories_in_admin() {


    $catagory_query = query("SELECT * FROM catagories");
    confirm($catagory_query);
    
    
    while($row = fetch_array($catagory_query)) {
    
    $cat_id = $row['cat_id'];
    $cat = $row['cat'];
    
    
    $catagory = <<<DELIMETER
    
    
    <tr>
        <td>{$cat_id}</td>
        <td>{$cat}</td>
        <td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    
    
    
DELIMETER;
    
    echo $catagory;
    
    
    
    }
    
    
    
}




function add_catagory() {

    if(isset($_POST['add_catagory'])) {
        $cat = escape_string($_POST['cat']);
    
        if(empty($cat) || $cat ==" "){
    
            echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";
    
    
        }else {
    
    
            $insert_cat = query("INSERT INTO catagories(cat) VALUES('{$cat}') ");
            confirm($insert_cat);
            set_message("Category Created");
            
    
    
    
        }
    
    
    }
    
    
    
    
}



/************************************** Admin Users*******************/

function display_users() {


    $user_query = query("SELECT * FROM users");
    confirm($user_query);
    
    
    while($row = fetch_array($user_query)) {
    
    $user_id = $row['user_id'];
    $username = $row['user_name'];
    $email = $row['user_mail'];
    $password = $row['user_password'];
    
    $user = <<<DELIMETER
    
    
    <tr>
        <td>{$user_id}</td>
        <td>{$username}</td>
         <td>{$email}</td>
        <td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    
    
    
DELIMETER;
    
    echo $user;
    
    
    
    }
    
    
    
}



function add_user() {


    if(isset($_POST['add_user'])) {
    
    
    $username   = escape_string($_POST['user_name']);
    $email      = escape_string($_POST['user_mail']);
    $password   = escape_string($_POST['user_password']);
    $type       = 1;
    // $user_photo = escape_string($_FILES['file']['name']);
    // $photo_temp = escape_string($_FILES['file']['tmp_name']);
    
    
    // move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);
    
    
    $query = query("INSERT INTO users(user_name, user_mail, user_password, user_type_admin) VALUES('{$username}','{$email}','{$password}', '{$type}')");
    confirm($query);
    
    set_message("USER CREATED");
    
    redirect("index.php?users");
    
    
    
    }
    
    
    
}




?>