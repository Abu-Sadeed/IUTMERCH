<div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">IUT Merch</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="dropdown-toggle" href="shop.php">Shop All</a>
                    </li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        <li class="divider"></li>
                        <li>
                            <?php      get_categories();        ?>
                        </li>
                    </ul>
                </li>
                    <li>
                        <a href="login.php">Admin</a>
                    </li>
                    <!-- <li>
                        <a href="admin">Admin</a>
                    </li> -->
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                
                <?php   
                    if(isset($_SESSION['username'])):?>
                       
                        
                       <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                           
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
    
                            </li>
                            
                        </ul>
                    </li>

                    <?php
                    else: ?>
                    <li><a href="customer_signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="customer_login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php endif; ?>

                    <li><a href="checkout.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->