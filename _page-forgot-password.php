<?php

$error = array(); 
$success = array();

if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'verify-user' ) {

	$email =  esc_attr($_POST['email']);
	$password = esc_attr( $_POST['password']);
    $user =  get_user_by('email' ,$email);
    if(!empty($user)){

		//retrieve_password($email);
		
		$user_login = sanitize_text_field( $email);

		if (retrieve_password($user_login->ID)) {
			echo "SUCCESS";
		} else {
			echo "ERROR";
		}

    }else{
        $error[] = __(' Error: Email address is not register.', 'profile');
    }
}
/**
 * Handles sending password retrieval email to user.
 *
 * @uses $wpdb WordPress Database object
 * @param string $user_login User Login or Email
 * @return bool true on success false on error
 */
function retrieve_password($user_id) {
	$code = sha1( $user_id . time() );
	add_user_meta( $user_id, 'password_activation', $code, true );
	
	
}


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
                    <h3>Resend verification link to your email address</h3>
                
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
                        <div class="form-holder_onerow">
                            <i class="zmdi zmdi-email"></i>
							<input type="email" id="user_email" name="email" class="form-control" placeholder="Email" value="<?php if(isset($email)) { echo $email; }?> ">
						
                        </div>
     
                    </div>
					<div class="actions clearfix">
						<ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true">
							<button id="verifyuser" name="verifyuser" class="btn btn-success">Submit</button>
							<?php wp_nonce_field( 'verify-user' ) ?>
                            <input name="action" type="hidden" id="action" value="verify-user" />
		
						</ul>
					</div>
                    </form>
                    <div class="col-md-12 reset-padding"> <a href="../registration/" title="Register">Register</a> <a style="cursor:default;text-decoration:none;" href="javascript:;"> | </a>
                     <a title="Lost your password?" href="../forgot-password/">Lost your password? | </a>
                     <a href="../Login/" title="Verify Your Email">Login</a>
                    </div>
                </section>

		
            
		</div>

<?php
require_once('template/user_javascript.php');
?>
<!-- Template created and distributed by Colorlib -->
</body>
</html>*