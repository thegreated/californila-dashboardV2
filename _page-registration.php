<?php
$url = get_stylesheet_directory_uri();

$error = array();  
if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'register-user' ) {

	$firstName =  esc_attr($_POST['firstname']);
	$lastName = esc_attr( $_POST['lastname']);
	$email =   esc_attr( $_POST['email']);

	if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] ))){
			$error[] = __('This email is already used by another user.', 'profile');
		
		}
        else{
	
		 // Separate Data
			$default_newuser = array(
				'user_pass' =>  wp_hash_password( $_POST['password']),
				'user_login' => $email,
				'user_email' => $email,
				'first_name' => $firstName,
				'last_name' => $lastName,
				'role' => 'subscribers'
			);

			
		
			$user_id = wp_insert_user($default_newuser);
			// if ( is_wp_error( $user_id ) ) {
			// 	// If the request has failed, show the error message
			// 	echo $user_id->get_error_message();
			// }
			if ( $user_id && !is_wp_error( $user_id ) ) {
				$code = sha1( $email . time() );
				$link = 'http://team661.com/consolidators/login/?action=1&email='.$email.'&activation_key='.$code.'';
				$body = '<span style="color:#000aa8"> <strong>Hi </strong> , '.$email .' </span><br/><br/> Please verify your email to complete your account setup.  <br/> <br/>   ';
				$body  .= ' <a  style="background-color:#000aa8;padding:10px;size:15px;color:white; text-decoration: none;" href = "' . $link . '" >  Click to verify </a> <br/>   <br/>';
				$body .= 'If you need further assistance, please contact our Help team.  <br/>';
				$body .= '<br/>  Thanks, <br/>';
				$body .= 'Californila - Consolidator';
				add_user_meta( $user_id, 'has_to_be_activated', $code, true );
				wp_mail($email, 'EMAIL VERIFICATION',$body);
				$page = get_page_by_title('registration-verify');
				wp_redirect(get_permalink($page->ID));
				exit;
			}
        }
    }


}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<?php require_once('template/user_header.php'); ?>

	</head>
	<body>
		<div class="wrapper">
          

			<div class="steps clearfix">
				<ul role="tablist">
					<li role="tab" aria-disabled="false" class="first done" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> <img src="<?=$url?>/includes/userModule/images/step-1.png" alt="">
					 <span class="step-order">Step 01</span></a><img src="<?=$url?>/includes/userModule/images/step-arrow.png" alt="" class="step-arrow">
					</li>
					<li role="tab" aria-disabled="false" class="current" aria-selected="true"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1">
						<span class="current-info audible">current step: </span><span class="number">2.</span> 
						<img src="images/step-2-active.png" alt=""><span class="step-order">Step 02</span></a><img src="images/step-arrow.png" alt="" class="step-arrow">
					</li>
					<li role="tab" aria-disabled="false" class="done" aria-selected="false"><a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2">
						<span class="number">3.</span> <img src="images/step-3.png" alt=""><span class="step-order">Step 03</span></a><img src="images/step-arrow.png" alt="" class="step-arrow">
					</li>
					<li role="tab" aria-disabled="false" class="last done" aria-selected="false"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">4.</span>
					 <img src="images/step-4.png" alt=""><span class="step-order">Step 04</span></a>
					</li>
				</ul>
			</div>

        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
				<form  action="<?php the_permalink(); ?>" id="form_register_step_one" method="post" novalidate="novalidate" style="margin-bottom:45px">
					<h3>Get started with Californila account</h3>
					<small></small>
					<?php if(isset( $error) && !empty($error)){ ?>
					<div class="email_error_">
							<?php	echo  implode("<br />", $error); ?>
							</div>
					<?php } ?>
                	<div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi zmdi-account"></i>
							<input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php if(isset($firstName)) { echo $firstName; }?>">
				
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account"></i>
							<input type="text" name="lastname" class="form-control" placeholder="Last Name"  value="<?php if(isset($lastName)) { echo $lastName; }?> " >
						
                        </div>
                	</div>
                    <div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi zmdi-email"></i>
							<input type="email" id="user_email" name="email" class="form-control" placeholder="Email" value="<?php if(isset($email)) { echo $email; }?> ">
						
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-email"></i>
							<input type="email" name="c_email" class="form-control" placeholder="Confirm Email" >
					
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi zmdi-lock"></i>
							<input type="password" id="user_password"  name="password" class="form-control" placeholder="Password">
					
                        </div>
						<div class="form-holder">
                            <i class="zmdi zmdi-lock"></i>
							<input type="password"  name="c_password" class="form-control" placeholder="Confirm password">
					
                        </div>
					</div>
					<div class="actions clearfix">
						<ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true">
							<button id="registeruser" name="registeruser" class="btn btn-success">Submit</button>
							<?php wp_nonce_field( 'register-user' ) ?>
                            <input name="action" type="hidden" id="action" value="register-user" />
		
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