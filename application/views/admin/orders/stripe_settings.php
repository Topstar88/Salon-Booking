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
                  <a href="<?php anchor_to(PAYMENTS_CONTROLLER . '/stripe') ?>">
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
                     <div class="card-title">Update your stripe settings</div>
                  </div>
				  <form action="<?php anchor_to(PAYMENTS_CONTROLLER . '/stripe') ?>" method="POST">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="stripe_api_key">Stripe API Key</label>
                           <?php echo form_error('stripe_api_key', '<br><span class="text-danger">', '</span>') ?>
                           <input type="text" name="stripe_api_key" class="form-control resize-none" id="stripe_api_key" placeholder="Enter your Stripe API Key.">
								</div>
                        <div class="form-group">
									<label for="stripe_publishable_key">Stripe Publishable Key</label>
                           <?php echo form_error('stripe_publishable_key', '<br><span class="text-danger">', '</span>') ?>
                           <input type="text" name="stripe_publishable_key" class="form-control resize-none" id="stripe_publishable_key" placeholder="Enter your Stripe Publishable Key.">
								</div>
                        <div class="form-group">
									<label for="stripe_currency">Stripe Currency</label>
                           <?php echo form_error('stripe_currency', '<br><span class="text-danger">', '</span>') ?>
                           <input type="text" name="stripe_currency" class="form-control resize-none" id="stripe_currency" placeholder="Enter your Stripe Currency." value="<?php echo esc($stripe['stripe_currency']) ?>">
								</div>
                        <div class="form-group">
                           <div class="custom-control custom-switch">
                              <input <?php echo_if($stripe['status'], 'checked') ?> name="site-status" type="checkbox" class="custom-control-input" id="switch">
                              <label class="custom-control-label" for="switch">Status</label>
                           </div>
                           <small>Stripe API Key &amp; Stripe Publishable Key are <span class="text-danger">Required</span> if the status is turned on.</small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-action">
						<input type="hidden" name="submit" value="Submit">
                  <button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Settings</button>
                  <a target="_blank" href="https://dashboard.stripe.com/" class="btn btn-info float-right"><i class="fas fa-external-link-alt mr-1"></i> Get your Stripe Credentials</a>
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