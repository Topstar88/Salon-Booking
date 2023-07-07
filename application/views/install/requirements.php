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
		<?php if($error) { ?>
		<div class="text-center">
			<div class="alert alert-danger">Please Make Sure Your Server Meets All Requirements. Refresh to see Changes</div>
		</div>
		<?php } ?>
		<!-- /thankyou-area -->
		<div class="tabs-area">
			<?php
			$this->load->view("install/includes/tabs");
			?>
			<!-- /tabs-nav -->
			
			<div class="tabs-content">
				<div class="tab-requirements">Web Server: <span><?php echo("Apache"); ?></span></div>
				<!-- /tab-requirements -->
				<div class="tab-requirements<?php echo($php_version>5.5 ? "" : " inactive"); ?>"> PHP Version: <span><?php echo("Greater Than 5.5"); ?></span></div>
				<!-- /tab-requirements -->
				<div class="tab-requirements<?php echo($curl_installed ? "" : " inactive"); ?>"> PHP CURL: <span><?php echo($curl_installed ? "Installed" : "Not Found"); ?></span></div>
				<!-- /tab-requirements -->
				<div class="tab-requirements<?php echo($zip_loaded ? "" : " inactive"); ?>"> ZIP Installed: <span><?php echo($zip_loaded ? "Installed" : "Not Found"); ?></span></div>
				<!-- /tab-requirements -->
				<div class="tab-requirements<?php echo($mysql_support ? "" : " inactive"); ?>"> MYSQL: <span><?php echo($mysql_support ? "Installed" : "Not Found"); ?></span></div>
				<!-- /tab-requirements -->
				<div class="tab-button-area text-right">
				<?php if($error) { ?>
				<a class="btn btn-info" href="<?php echo($base_url."install/".$current_page); ?>">Refresh</a> <?php } else { ?>
				<a class="btn btn-tabs" href="<?php echo($base_url."install/".$next_page); ?>">Next</a>
				</div>
				<?php } ?>
			</div>
			<!-- /tabs-content -->
		</div>
		<!-- /tabs-area -->
<?php
$this->load->view("install/includes/footer");
$this->load->view("install/includes/footer_end");
?>