<!DOCTYPE html>
<html lang="ar">

<head>
    <title>
       ATZ Shop - A Matjary Template
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/normalize.css">

    <!-- Iconfont Link -->
    <link rel="stylesheet" href="assets/icofont/icofont.min.css" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Cosma Stylesheet -->
    <link rel="stylesheet" href="assets/css/atz-styles-ar.css" />
    <link rel="stylesheet" href="assets/css/responsive-ar.css" />

    <!-- Font Styles -->
    <link rel="stylesheet" href="assets/css/fonts.css" />



    <!-- Owl carousel -->
    <link rel="stylesheet" href="assets/owl-carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owl-carousel/dist/assets/owl.theme.default.min.css">
    <script src="assets/owl-carousel/dist/owl.carousel.min.js"></script>

    <!-- Local Script -->
    <script src="assets/js/main-ar.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <!-- logo -->
            <strong class="logo">
                <a href="index.php">
                    <img src="assets/images/logo.png">
                </a>
            </strong>
            <!-- open nav mobile -->

            <!--search -->
            <label class="open-search" for="open-search">
                <i class="icofont-search"></i>
                <input class="input-open-search" id="open-search" type="checkbox" name="menu" />
                <div class="search">
                    <button class="button-search"><i class="icofont-search"></i></button>
                    <input type="text" placeholder="What are you looking for?" class="input-search" />
                </div>
            </label>
            <!-- // search -->
            <nav class="nav-content">
                <!-- nav -->
                <ul class="nav-content-list">
                    <li class="nav-content-item account-login">
                        <label class="open-menu-login-account" for="open-menu-login-account">

                            <input class="input-menu" id="open-menu-login-account" type="checkbox" name="menu" />

                            <i class="icofont-ui-user"></i><span class="login-text">Hello, Sign in <strong>Create Account</strong></span> <span class="item-arrow"></span>

                            <!-- submenu -->
                            <ul class="login-list">
                                <a href="login-ar.php">
                                    <li class="login-list-item">Login</li>
                                </a>
                                <a href="signup-ar.php">
                                    <li class="login-list-item">Signup</li>
                                </a>
                                <a href="my-account-ar.php">
                                    <li class="login-list-item">My Account</li>
                                </a>
                                <a href="#">
                                    <li class="login-list-item">Logout</li>
                                </a>
                        </label>
                </ul>
                </li>

                <li class="nav-content-item"><a class="nav-content-link" href="cart.php"><i class="icofont-cart-alt"></i></a></li>
                <li class="nav-content-item"><a class="nav-content-link" href="index.php">EN</a></li>
                <!-- call to action -->
                </ul>
            </nav>
        </div>
        <!-- nav navigation commerce -->
        <div class="nav-container">
            <nav class="all-category-nav">
                <label class="open-menu-all" for="open-menu-all">
                    <input class="input-menu-all" id="open-menu-all" type="checkbox" name="menu-open" />
                    <span class="all-navigator"><i class="icofont-navigation-menu"></i> <span>All Category</span> <i class="icofont-caret-down"></i>
                        <i class="icofont-caret-up"></i>
                    </span>

                    <ul class="all-category-list">
                        <li class="all-category-list-item"><a href="#" class="all-category-list-link">Jackets<i class="fas fa-angle-right"></i></a>
                            <div class="category-second-list">
                                <ul class="category-second-list-ul">
                                    <li class="category-second-item"><a href="#">Street Jackets</a></li>
                                    <li class="category-second-item"><a href="#">Cruising Jackets</a></li>
                                    <li class="category-second-item"><a href="#">Racing Jackets</a></li>
                                    <li class="category-second-item"><a href="#">Adventure Jackets</a></li>
                                    <li class="category-second-item"><a href="#">Leather Jackets</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="all-category-list-item"><a href="#" class="all-category-list-link">Gloves <i class="fas fa-angle-right"></i></a></li>
                        <li class="all-category-list-item"><a href="#" class="all-category-list-link">Helmets<i class="fas fa-angle-right"></i></a></li>
                        <li class="all-category-list-item"><a href="#" class="all-category-list-link">Riding Boots<i class="fas fa-angle-right"></i></a></li>
                        <li class="all-category-list-item"><a href="#" class="all-category-list-link">Riding Bags<i class="fas fa-angle-right"></i></a></li>
                        <li class="all-category-list-item"><a href="#" class="all-category-list-link">Trunk<i class="fas fa-angle-right"></i></a></li>

                    </ul>
                </label>

            </nav>
            <nav class="featured-category">
                <ul class="nav-row">
                    <li class="nav-row-list"><a href="index-ar.php" class="nav-row-list-link">Home</a></li>
                    <li class="nav-row-list"><a href="products-ar.php" class="nav-row-list-link">Products</a></li>
                    <li class="nav-row-list"><a href="gift-cards-ar.php" class="nav-row-list-link">Gift Cards</a></li>
                    <li class="nav-row-list"><a href="help-ar.php" class="nav-row-list-link">Help</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>

</html>