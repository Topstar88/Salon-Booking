<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection p-all-0" id="home">
		<div class="container">
			<div class="row mainSectionRowHeight align-items-center">
				<div class="col-lg-8 offset-lg-2">
					<div class="selectionBoxMain signupSec">
						<h1 class="loginSignupTitle">404 - PAGE NOT FOUND</h1>
						<p class="loginSignupSubTitle">The page you are looking for might have been removed<br>had its name changed or is temporarily  unavailable.<p>
						<div class="text-center">
							<img src="<?php $assets('images/404.png'); ?>" class="img-responsivee">
						</div>
						<div class="loginGoSignup">
							<a href="<?php echo base_url(); ?>" class="p-all-10 d-block">GO TO HOMEPAGE</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /mainSection -->
	
<?php $theme_view('includes/footer'); ?>
<?php $theme_view('includes/foot'); ?>

<?php $theme_view('includes/footEnd'); ?>