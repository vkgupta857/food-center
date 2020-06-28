<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">FoodShala</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-controls="Menu" aria-expanded="false" aria-label="navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">About</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- Options for customer -->
                    <?php if(isset($_SESSION['cust_email'])) { ?>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</span></a>
                    </li>

                    <!-- Options for restaurant -->
                    <?php } elseif(isset($_SESSION['rest_email'])) { ?>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</span></a>
                    </li>

                    <!-- Options for Anonymous -->
                    <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sign Up</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="restaurant_register.php">Restaurant</a>
                            <a class="dropdown-item" href="customer_register.php">Customer</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="restaurant_login.php">Restaurant</a>
                            <a class="dropdown-item" href="customer_login.php">Customer</a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>