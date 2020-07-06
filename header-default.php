
<?php $url = get_stylesheet_directory_uri();?>


<!DOCTYPE html>
<html>
<?php
$title = "Packages";
?>
<head>
    <?php require_once('template/header.php'); ?>
    <link rel="stylesheet" href="http://team661.com/consolidators/wp-content/plugins/profile-builder/assets/css/style-front-end.css" type="text/css">
</head>
<body class="bg-default">
<!-- Navbar -->
<?php require_once('template/home_navigation.php'); ?>

<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-4">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white"><?php the_title(); ?></h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>