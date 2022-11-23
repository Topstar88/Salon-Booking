<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection" id="home">
		<div class="container">
			<div class="row mainSectionRowHeight align-items-center">
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
						<h1 class="loginSignupTitle">Something went wrong</h1>
						<p class="loginSignupSubTitle">Sorry! your activation code is wrong, Please Contact with us if you have any problem.<p>
						<a class="btn btn-dark formSubmitBtn btn-block" href="<?php echo base_url() ?>">Go Homepage</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /mainSection -->
	

<?php $theme_view('includes/footer'); ?>
<?php $theme_view('includes/foot'); ?>

<?php $theme_view('includes/footEnd'); ?>