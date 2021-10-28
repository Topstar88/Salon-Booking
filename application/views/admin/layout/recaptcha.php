<?php $this->load->view('admin/includes/head'); ?>
<div class="wrapper fullheight-side">
<?php $this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar'); 
$this->load->view('admin/includes/navbar'); ?>

<div class="main-panel">
   <div class="container">
      <div class="page-inner">
         <div class="page-header">
            <h4 class="page-title"><?php echo esc($page_title) ?></h4>
            <ul class="breadcrumbs">
               <li class="nav-home">
                  <a href="<?php anchor_to(GENERAL_CONTROLLER . '/dashboard') ?>">
                  <i class="flaticon-home"></i>
                  </a>
               </li>
               <li class="separator">
                  <i class="flaticon-right-arrow"></i>
               </li>
               <li class="nav-home">
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/recaptcha') ?>">
                  <?php echo esc($page_title) ?>
                  </a>
               </li>
            </ul>
         </div>
         <?php $this->load->view('admin/includes/alert'); ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <div class="card-title">Update your Recaptcha settings</div>
                  </div>
				  <form action="<?php anchor_to(LAYOUT_CONTROLLER . '/recaptcha') ?>" method="POST">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="site-key">Site Key</label>
                                    <?php echo form_error('site-key', '<br><span class="text-danger">', '</span>') ?>
									<input type="text" name="site-key" class="form-control resize-none" id="site-key" placeholder="Enter your Recaptcha Site Key." value="<?php echo esc($page_data['recaptcha']['site_key']) ?>">
								</div>
                                <div class="form-group">
									<label for="secret-key">Secret Key</label>
                                    <?php echo form_error('secret-key', '<br><span class="text-danger">', '</span>') ?>
									<input type="text" name="secret-key" class="form-control resize-none" id="secret-key" placeholder="Enter your Recaptcha Secret Key." value="<?php echo esc($page_data['recaptcha']['secret_key']) ?>">
								</div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input <?php echo_if($page_data['recaptcha']['status'], 'checked') ?> name="site-status" type="checkbox" class="custom-control-input" id="switch">
                                        <label class="custom-control-label" for="switch">Status</label>
                                    </div>
                                    <small>Site Key &amp; Secret Key are <span class="text-danger">Required</span> if the status is turned on.</small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-action">
						<input type="hidden" name="submit" value="Submit">
						<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Analytics</button>
                        <a target="_blank" href="https://www.google.com/recaptcha/admin/" class="btn btn-info float-right"><i class="fas fa-external-link-alt mr-1"></i> Get your Recaptcha Credentials</a>
				  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Page Content -->
</div>
<?php $this->load->view('admin/includes/foot'); ?>