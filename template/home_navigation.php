<?php $home_url = home_url();
?>
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="dashboard.html">
            <img  src="<?=$url?>/assets/img/brand/californila-logo-white.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="<?=$url?>/assets/img/brand/logo-white.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav mr-auto">
                <?php if ( is_user_logged_in() ) {?>
                <li class="nav-item">
                    <a href="<?=$home_url?>/dashboard" class="nav-link">
                        <span class="nav-link-inner--text">Dashboard</span>
                    </a>
                </li>
                <?php } ?>
                <?php if ( !is_user_logged_in() ) {?>
                    <li class="nav-item">
                        <a href="<?=$home_url?>/login/" class="nav-link">
                            <span class="nav-link-inner--text">Sign in</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=$home_url?>/registration" class="nav-link">
                            <span class="nav-link-inner--text">Sign up</span>
                        </a>
                    </li>
                <?php }else {?>
                <li class="nav-item">
                    <a href="<?=$home_url?>/logout" class="nav-link">
                        <span class="nav-link-inner--text">Logout</span>
                    </a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?=$home_url?>/dashboard" class="nav-link">
                        <span class="nav-link-inner--text">Prohibited Items</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://californila.com/featured-on/" class="nav-link">
                        <span class="nav-link-inner--text">Blog</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a  class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" >Help
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu list-group" style="margin: 0;padding: 0;">
                            <li class="list-group-item" style="padding:10px;font-size:13px"><a href="#">Support Ticket</a></li>
                            <li class="list-group-item" style="padding:10px;font-size:13px"><a href="<?=$home_url?>/faqs">FAQs</a></li>
                            <li class="list-group-item" style="padding:10px;font-size:13px"><a href="#">Tutorials</a></li>
                            <li class="list-group-item" style="padding:10px;font-size:13px"><a href="<?=$home_url?>/contact-us">Contact us</a></li>
                        </ul>
                    </a>
                </li>
            </ul>
            <hr class="d-lg-none" />
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <a  class="nav-link nav-link-icon" data-toggle="tooltip" data-original-title="Like us on Facebook">
                        <i class="fab fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Facebook</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
                        <i class="fab fa-instagram"></i>
                        <span class="nav-link-inner--text d-lg-none">Instagram</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
                        <i class="fab fa-twitter-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Twitter</span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block ml-lg-4">
                    <a href="<?=$home_url?>/track-package/" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
               <i class="fas fa-box-open mr-2"></i>
              </span>
                        <span class="nav-link-inner--text">Track order</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>