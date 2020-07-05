<?php


?>

<html>
	<head>
		<meta charset="utf-8">
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
        <?php 
        $url = get_stylesheet_directory_uri();

        require_once('template/user_header.php'); ?>
		<!-- MATERIAL DESIGN ICONIC FONT -->

	</head>
	<body>
		<div class="wrapper_login_">
          


        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
				<form  action="<?php the_permalink(); ?>" id="form_verify" method="post" novalidate="novalidate">
                    <h3>Verify Email Address:</h3>
                
					<small></small>
					<?php if(isset( $error) && !empty($error)){ ?>
					<div class="email_error_">
							<?php	echo  implode("<br />", $error); ?>
							</div>
                    <?php } ?>
                    
                    <?php if(isset( $success) && !empty($success)){ ?>
					<div class="email_success_">
							<?php	echo  implode("<br />", $success); ?>
							</div>
					<?php } ?>
                    <div class="form-row">
                       <h3 style="color:#2a3184;font-size:15px; padding:10px;">Please verify your email address to complete registration.</h3>
     
                    </div>
					<div class="actions clearfix">
						<ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true">
							<a href="../registration-verify-email/" id="verifyuser" name="verifyuser" class="btn btn-success">Resend Email</a>
							<?php wp_nonce_field( 'verify-user' ) ?>
                            <input name="action" type="hidden" id="action" value="verify-user" />
		
						</ul>
					</div>
                    </form>
                    <div class="col-md-12 reset-padding"> <a href="../login/" title="Register">Register</a> <a style="cursor:default;text-decoration:none;" href="javascript:;"> | </a>
                     <a title="Lost your password?" href="../forgot-password/">Lost your password? | </a>
                     <a href="../registration-verify-email/" title="Verify Your Email">Verify Your Email</a>
                    </div>
                </section>

		
            
		</div>

<?php
require_once('template/user_javascript.php');
?>
<!-- Template created and distributed by Colorlib -->
</body>
</html>