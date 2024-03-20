<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title><?= isset($title) ? $title : 'Hệ thống E-learning' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/home/home_main.css">
    <link rel="icon" type="image/x-icon" href="/public/images/logo-icon.png">
    <link rel="stylesheet" href="/public/css/header/header.css">
</head>

<body>

    <div class="header">
        <nav class="navbar navbar-expand-lg  header__navbar">
            <div class="container">
                <div class="header__navbar__brand-wrapper">
                    <a class="navbar-brand header__navbar-brand" href="/">
                        <img src="/public/images/icon.png" class="header__navbar-logo" alt="Logo">
                        ELearning
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse header__navbar-menu-wrapper" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 header__navbar-menu">
                        <li class="nav-item header__navbar-menu__item active">
                            <a class="nav-link <?php if ($activeNav == "home") echo 'active' ?>" aria-current="page" href="/">Trang chủ</a>
                        </li>
                        <li class="nav-item header__navbar-menu__item">
                            <a class="nav-link <?php if ($activeNav == "courses") echo 'active' ?> " href="/courses/all">Khóa học</a>
                        </li>
                        <li class="nav-item header__navbar-menu__item">
                            <a class="nav-link <?php if ($activeNav == "blog") echo 'active' ?>" href="/blog/all">Blog</a>
                        </li>
                        <li class="nav-item header__navbar-menu__item">
                            <a class="nav-link <?php if ($activeNav == "faqs") echo 'active' ?>" href="/home/faqs">FAQs</a>
                        </li>
                        <li class="nav-item header__navbar-menu__item">
                            <a class="nav-link <?php if ($activeNav == "contact") echo 'active' ?>" href="/home/contact">Liên hệ</a>
                        </li>
                    </ul>
                    <div class="d-flex header__auth justify-content-end align-items-center">
                        <a href="/login/auth" class="header__auth-link">
                            Login/Register
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <?php 
            $currentURI = $_SERVER['REQUEST_URI'];
            $currentPage = explode('/', $currentURI);
            foreach ($currentPage as $key => $value) {
                if (strpos($value, '.php') !== false) {
                    $currentPage = explode('.', $value)[0];
                }
            }
        ?>
        <!-- Cập nhật lại sau-->
        <!-- <div class="navigation">
            <div class="container">
                <?php
                    echo "<ul>";
                    echo "<li><a href='/content/views/home.php' class='nav-link'>Home </a></li>";
                    if ($currentPage != 'home'){
                        echo " > ";
                    }
                    if ($currentPage == 'bloglist'){
                        echo "<li><a href='/content/views/bloglist.php' class='nav-link'>Blog </a></li>";
                    }
                ?>
            </div>
        </div> -->
    </div>