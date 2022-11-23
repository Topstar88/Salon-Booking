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
			<div class="thankyou-title">All Set, Installation Done :)</div>			
			<!-- /thankyou-title -->
		</div>
		<!-- /thankyou-area -->
		
		<div class="tabs-area">
			<?php
			$this->load->view("install/includes/tabs");
			?>
			<!-- /tabs-nav -->
			
			<div class="tabs-content">
				<div class="installed clearfix">
					<div class="left-thumb"><i class="fa fa-thumbs-up"></i></div>
					<!-- /left-thumb -->
					<div class="right-thumb">Awesome ! Script Installed Successfully</div>
					<!-- /right-thumb -->
				</div>
				<!-- /installed -->
				
				<div class="tab-button-area text-center">
				<a class="btn btn-outline-primary m-r-10 p-l-30 p-r-30" href="<?php echo($base_url); ?>">Visit Website</a>
				<a class="btn btn-secondary p-l-30 p-r-30" href="<?php echo($base_url.ADMIN_CONTROLLER); ?>">Visit Admin</a>
				</div>
				<!-- /tab-button-area -->
				
			</div>
			<!-- /tabs-content -->
		</div>
		<!-- /tabs-area -->
<?php
$this->load->view("install/includes/footer");
$this->load->view("install/includes/footer_end");
?>