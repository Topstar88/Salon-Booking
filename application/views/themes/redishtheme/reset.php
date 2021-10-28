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
						<h1 class="loginSignupTitle">Reset your password</h1>
						<p class="loginSignupSubTitle">Fill in your e-mail address below and we will send you a random password for login again.<p>
						<form action="<?php echo base_url('login/reset'); ?>" method="post" accept-charset="utf-8">
						
						<div class="form-group">
							<?php echo form_input([
													'name'=>'email',
													'class'=>'customInputs form-control',
													'placeholder'=>'Enter your Email',
													'value'=> set_value('email')
							]); ?>
							<?php echo form_error('email'); ?>
						</div>
						<input type="hidden" name="submit" value="Submit">
						<?php echo form_submit([
												'class'=>'btn btn-dark formSubmitBtn btn-block',
												'value'=>'Send me a password'
						]); ?>
						<div class="row">
							<div class="col-lg-6">
								<div class="loginGoSignup text-left">Already have account? <a href="<?php echo base_url('login'); ?>">Login</a></div>
							</div>
							<div class="col-lg-6">
								<div class="loginGoSignup text-right">Don't have account? <a href="<?php echo base_url('login/signUp'); ?>">Sign Up</a></div>
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