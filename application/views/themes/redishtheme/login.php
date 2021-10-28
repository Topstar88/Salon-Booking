<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection" id="home">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<?php 
						if($userMsg = $this->session->flashdata('userMsg')){
							$userMsg_class = $this->session->flashdata('userMsg_class');
					?>
							<div class="alert <?php echo esc($userMsg_class, true);?>"><?php echo esc($userMsg, true);?></div>
					<?php
						}
					?>
					<div class="selectionBoxMain signupSec">
						<h1 class="loginSignupTitle">Create your Account</h1>
						<p class="loginSignupSubTitle">Log in to get in the moment updates on the things that interest you.<p>
						<form action="<?php echo base_url('login/index'); ?>" method="post" accept-charset="utf-8">
						
						<div class="form-group">
							<?php echo form_input([
													'name'=>'email',
													'class'=>'customInputs form-control',
													'placeholder'=>'Enter Username or Email',
													'value'=> set_value('email')
							]); ?>
							<?php echo form_error('email'); ?>
						</div>
						<div class="text-right pb-2">
							<a href="<?php echo base_url('login/reset'); ?>" class="">Forgot Password?</a>
						</div>
						<div class="form-group">
							<?php echo form_password([
													'name'=>'password',
													'class'=>'customInputs form-control',
													'placeholder'=>'Enter Password',
													'value'=> set_value('password')
							]); ?>
							<?php echo form_error('password'); ?>
						</div>
						
						<?php echo form_submit([
												'class'=>'btn btn-dark formSubmitBtn btn-block',
												'value'=>'Login'
						]); ?>
						<div class="loginGoSignup">Don't have account? <a href="<?php echo base_url('login/signUp'); ?>">Sign Up</a></div>
						<div class="signUpWithSocial">
							<h3>Sign Up with social media</h3>
							<div class="row">
								<div class="col-lg-6">
									<a href="<?php echo base_url('oauth/google'); ?>" class="btn btn-primary btnGoogle <?php echo_if(!$social_keys['google_status'], 'disabled') ?>"><i class="icon-google-plus"></i> Login with Google</a>
								</div>
								<div class="col-lg-6">
									<a href="<?php echo base_url('oauth/facebook'); ?>" class="btn btn-primary btnFacebook <?php echo_if(!$social_keys['facebook_status'], 'disabled') ?>"><i class="icon-facebook"></i> Login with Facebook</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /mainSection -->
	
<?php $theme_view('includes/footer'); ?>
<?php $theme_view('includes/foot'); ?>

<?php $theme_view('includes/footEnd'); ?>