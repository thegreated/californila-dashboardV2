<?php

$url = get_stylesheet_directory_uri();
get_header('clear');
?>


    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-5 col-sm-7">
                <img src="<?=$url?>/assets/img/brand/404-img.png" style="height: 500px;" alt="...">
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
<?php
get_footer();

?>