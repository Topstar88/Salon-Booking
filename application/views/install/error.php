<?php
$this->load->view("install/includes/head");
?>
	<div class="installer-container">
		<div class="installer-logo-area">
			<a class="logo-icon" href="<?php echo(VENDOR_URL); ?>" target="_blank">Desclix</a>
		</div>
		<!-- /installer-logo-area -->
		<div class="text-center">
		<div class="welcome-logo-text">
			Welcome To "<span><?php echo(PRODUCT_NAME); ?></span>" Installer
		</div>
		<!-- /welcome-logo-text -->
		</div>
		<!-- /text-center -->
		
		<div class="thankyou-area text-center">
			<div class="thankyou-title text-danger">Oooops ! You can't proceed with installation.</div>			
			<!-- /thankyou-title -->
		</div>
		<!-- /thankyou-area -->
		
		<div class="tabs-area">
			<div class="tabs-content">
			<!-- /text-center -->
			<div class="text-center">
				<div class="alert alert-danger">To Run Installation Again Delete this file <br/><strong><?php echo(installPath()."assets/setup.done.php"); ?></strong> then retry <br/><br/><a class="btn btn-tabs" href="<?php echo(installPath()."install"); ?>">Retry</a></div>
			</div>
			</div>
			<!-- /tabs-content -->
		</div>
		<!-- /tabs-area -->
<?php
$this->load->view("install/includes/footer");
$this->load->view("install/includes/footer_end");
?>