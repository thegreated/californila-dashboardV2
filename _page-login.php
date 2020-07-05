<?php

$error = array(); 
$success = array();
if(isset($_GET['action']) && isset($_GET['email']) && isset($_GET['activation_key']))
{
    $email = esc_attr($_GET['email']);
    $user =  get_user_by('email' ,$email);
    $data = $_GET['activation_key'];
    $code = get_user_meta($user->ID, 'has_to_be_activated', true);
	
   // var_dump($data);
    if($code == $data){
        update_user_meta($user->ID, 'is_activated', 1);
        $success[] = __(' Success: You can now login your account.', 'profile');

    }else{

        $error[] = __(' Error: This is not the correct verification link.', 'profile');
    }
	

}
if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'login-user' ) {

	$email =  esc_attr($_POST['email']);
	$password = esc_attr( $_POST['password']);
    $user =  get_user_by('email' ,$email);
	
    if(!empty($user)){
		/*
        if(!wp_check_password($password, $user->user_pass, $user->ID)){
            $error[] = __(' Error: Invalid Email and Password', 'profile');
        }else{
            $success[] = __(' Success: Good job.', 'profile');
        }*/
		//require_once($_SERVER['DOCUMENT_ROOT']."/wp-load.php");
		//	 $password = '1368582285808';
		//	 $hash = '$P$BPhN02dMnKgz.CpDcDKUWfYixZaNb5.';
			// var_dump(wp_check_password($password, $hash));
	
    }else{
        $error[] = __(' Error: Email address is unknown.', 'profile');
    }
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
				<form  action="<?php the_permalink(); ?>" id="form_login" method="post" novalidate="novalidate">
                    <h3>Login / Signin</h3>
                
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
                    <div class="form-row">
                        <div class="form-holder_onerow">
                            <i class="zmdi zmdi-lock"></i>
							<input type="password" id="user_password"  name="password" class="form-control" placeholder="Password">
					
                        </div>
                    </div>
                    <div class="col-md-12 reset-padding padding-top-15">
                        <input type="checkbox" value="forever" id="rememberme" name="rememberme">
                        <label for="rememberme" class="control-label">Remember Me</label>
                    </div>
					<div class="actions clearfix">
						<ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true">
							<button id="loginuser" name="loginuser" class="btn btn-success">Submit</button>
							<?php wp_nonce_field( 'login-user' ) ?>
                            <input name="action" type="hidden" id="action" value="login-user" />
		
						</ul>
					</div>
                    </form>
                    <div class="col-md-12 reset-padding"> <a href="../registration/" title="Register">Register</a> <a style="cursor:default;text-decoration:none;" href="javascript:;"> | </a>
                     <a title="Lost your password?" href="../forgot-password/">Lost your password? | </a>
                     <a href="../registration-verify/" title="Verify Your Email">Verify Your Email</a>
                    </div>
                </section>

		
            
		</div>

<?php
require_once('template/user_javascript.php');
?>
<!-- Template created and distributed by Colorlib -->
</body>
</html>