
<?php $home_url = home_url();?>

<div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="<?= $home_url?>/dashboard">
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $home_url?>/packages">
                <span class="nav-link-text">Packages </span>  &nbsp;<?php apply_filters('user_package_budge','Consolidator') ;?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $home_url?>/sent-package">
                <span class="nav-link-text">Sent Boxes </span> &nbsp;<?php apply_filters('box_user_badge','Consolidator') ;?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="nav-link-text">Special Request </span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->

        </div>