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
		<div class="text-center">
			<div class="alert alert-info">Enter Website Details Below to Complete Installation</div>
		</div>
		<div class="tabs-area">
			<?php
			$this->load->view("install/includes/tabs");
			?>
			<!-- /tabs-nav -->
			<form method="post">
			<div class="tabs-content">
				<?php if(isset($error) && $error) { ?>
				<div class="alert alert-danger text-center"><i class="fa fa-exclamation-triangle"></i> <?php echo($errorMsg); ?></div>
				<?php } ?>
				<label class="label-tabs">Installation Path (With Trailing "/" Slash)</label>
				<div class="text-fld-div">
					<input type="url" name="install_path" onkeypress="return AvoidSpace(event)" value="<?php echo esc(isset($install_path) ? $install_path : ""); ?>" placeholder="Enter Installation Path" class="form-control text-fld" required>
					<?php echo form_error('install_path', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Website Title (Maximum 70 Characters)</label>
				<div class="text-fld-div">
					<input type="text" name="website_title" maxlength="70" value="<?php echo esc(isset($website_title) ? $website_title : ""); ?>" placeholder="Enter Website Title" class="form-control text-fld" required>
					<?php echo form_error('website_title', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Admin Email</label>
				<div class="text-fld-div">
					<input type="email" name="email" onkeypress="return AvoidSpace(event)" value="<?php echo esc(isset($email) ? $email : ""); ?>" placeholder="Enter Admin Email" class="form-control text-fld" required>
					<?php echo form_error('email', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Admin Username (Alphanumeric Without Spaces)</label>
				<div class="text-fld-div">
					<input type="text" name="username" onkeypress="return AvoidSpace(event)" value="<?php echo esc(isset($username) ? $username : ""); ?>" placeholder="Enter Admin Username" class="form-control text-fld" required>
					<?php echo form_error('username', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Admin Password (Minimum 5 Characters Without Spaces)</label>
				<div class="text-fld-div">
					<input type="password" name="password" minlength="5" onkeypress="return AvoidSpace(event)" value="<?php echo esc(isset($password) ? $password : ""); ?>" placeholder="Enter Admin Password" class="form-control text-fld" required>
					<?php echo form_error('password', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<div class="tab-button-area text-right">
				<input type="hidden" name="submit" value="submit">
				<button class="btn btn-tabs btn-submit" type="submit">Verify</button>
				</div>
				<!-- /tab-button-area -->
			</div>
			</form>
			<!-- /tabs-content -->
		</div>
			<!-- /tabs-content -->
		</div>
		<!-- /tabs-area -->
		<script type="text/javascript" src="<?php echo base_url("assets/js/admin/includes/settings.js"); ?>"></script>
<?php
$this->load->view("install/includes/footer");
$this->load->view("install/includes/footer_end");
?>