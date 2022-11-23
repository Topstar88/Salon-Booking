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
		<?php if(isset($msg)) { ?>
			<div class="alert alert-<?php echo($error ? "danger" : "success"); ?>"><?php echo($msg); ?></div>
			<?php } else { ?>
			<div class="alert alert-info">Enter Database Details Below & Click Verify</div>
			<?php } ?>
			</div>
		<div class="tabs-area">
			<?php
			$this->load->view("install/includes/tabs");
			?>
			<!-- /tabs-nav -->
			<form method="post">
			<div class="tabs-content">
				<label class="label-tabs">Database Server</label>
				<div class="text-fld-div">
					<input type="text" name="host" placeholder="e.g: localhost" value="<?php echo esc(isset($host) ? $host : ""); ?>" class="form-control text-fld" required/>
					<?php echo form_error('host', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Database Name</label>
				<div class="text-fld-div">
					<input type="text" name="database" placeholder="Database Name" value="<?php echo esc(isset($database) ? $database : ""); ?>" class="form-control text-fld" required/>
					<?php echo form_error('database', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Database Username</label>
				<div class="text-fld-div">
					<input type="text" name="username" placeholder="Database Username" value="<?php echo esc(isset($username) ? $username : ""); ?>" class="form-control text-fld" required/>
					<?php echo form_error('username', '<div class="m-t-5 text-danger"><small>', '</small></div>'); ?>
				</div>
				<label class="label-tabs">Database Password</label>
				<div class="text-fld-div">
					<input type="password" name="password" placeholder="Database Password" value="<?php echo esc(isset($password) ? $password : ""); ?>" class="form-control text-fld"/>
				</div>
				<div class="tab-button-area text-right">
				<?php if(isset($error) && !$error && isset($msg)) { ?>
				<a class="btn btn-tabs" href="<?php echo($base_url."install/".$next_page); ?>">Next</a>
				<?php } else { ?>
				<input type="hidden" name="submit" value="submit">
				<button class="btn btn-tabs btn-submit" type="submit">Verify</button>
				<?php } ?>
				</div>
				<!-- /tab-button-area -->
			</div>
			</form>
			<!-- /tabs-content -->
		</div>
			<!-- /tabs-content -->
		</div>
		<!-- /tabs-area -->
<?php
$this->load->view("install/includes/footer");
$this->load->view("install/includes/footer_end");
?>