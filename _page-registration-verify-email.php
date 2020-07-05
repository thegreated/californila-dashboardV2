<?php

$error = array(); 
$success = array();

if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'verify-user' ) {

	$email =  esc_attr($_POST['email']);
	$password = esc_attr( $_POST['password']);
    $user =  get_user_by('email' ,$email);
    if(!empty($user)){

        $code = get_user_meta($user->ID, 'is_activated', true);
        
        if(!empty($code)){
            $error[] = __(' Error: User is already activated', 'profile');
        }else{
			
		    $code = sha1( $user->ID . time() );
			update_user_meta($user->ID, 'has_to_be_activated',  $code);
			$link = 'http://team661.com/consolidators/login/?action=1&email='.$email.'&activation_key='.$code.'';
           // $code = sha1( $user->ID . time() );
         //   $activation_link = add_query_arg( array( 'action'=> 'true','email' => $email, 'activation_key' => $code ,'http://team661.com/consolidators/login/'));
			$body = '<span style="color:#000aa8"> <strong>Hi </strong> , '.$email .' </span><br/><br/> Please verify your email to complete your account setup.  <br/> <br/>   ';
			$body  .= ' <a  style="background-color:#000aa8;padding:10px;size:15px;color:white; text-decoration: none;" href = "' . $link . '" >  Click to verify </a> <br/>   <br/>';
			$body .= 'If you need further assistance, please contact our Help team.  <br/>';
			$body .= '<br/>  Thanks, <br/>';
			$body .= 'Californila - Consolidator';
			
            wp_mail($email, 'EMAIL VERIFICATION',$body);
    
            $success[] = __('Success: A message will be sent to your email address.', 'profile');

       
          
        }

    }else{
        $error[] = __(' Error: Email address is not register.', 'profile');
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
</html>