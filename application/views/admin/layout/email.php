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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/email') ?>">
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
                     <div class="card-title">Update your E-Mail Settings</div>
                  </div>
				  <form action="<?php anchor_to(LAYOUT_CONTROLLER . '/email') ?>" method="POST">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
                                    <label for="site-smtp-email">Contact E-Mail <span class="text-danger">*</span></label>
                                    <?php echo form_error('site-smtp-email', '<br><span class="text-danger">', '</span>') ?>
                                    <input type="email" id="site-smtp-email" name="site-smtp-email" value="<?php echo esc($page_data['email']['email']) ?>" class="form-control">
									<small>This is used as the Contact E-Mail.</small>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input <?php echo_if($page_data['email']['status'], 'checked') ?> id="smtp-status-check" name="site-smtp-status" type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="smtp-status-check">SMTP Status</label>
                                    </div>
                                    <small>SMTP Credentials are <span class="text-danger">Required</span> if the status is turned on.</small>
                                </div>
                                <div id="smtp-settings-container" class="<?php echo_if(!$page_data['email']['status'], 'd-none') ?>">
                                    <div class="form-group">
                                        <label for="site-smtp-host">SMTP Host</label>
                                        <?php echo form_error('site-smtp-host', '<br><span class="text-danger">', '</span>') ?>
                                        <input placeholder="Your SMTP Host" type="text" id="site-smtp-host" name="site-smtp-host" value="<?php echo esc($page_data['email']['host']) ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="site-smtp-port">SMTP Port</label>
                                        <?php echo form_error('site-smtp-port', '<br><span class="text-danger">', '</span>') ?>
                                        <input placeholder="Your SMTP Port" type="number" id="site-smtp-port" name="site-smtp-port" value="<?php echo esc($page_data['email']['port']) ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="site-smtp-username">SMTP Username</label>
                                        <?php echo form_error('site-smtp-username', '<br><span class="text-danger">', '</span>') ?>
                                        <input placeholder="Your SMTP Username" type="text" id="site-smtp-username" name="site-smtp-username" value="<?php echo esc($page_data['email']['username']) ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="site-smtp-password">SMTP Password</label>
                                        <?php echo form_error('site-smtp-password', '<br><span class="text-danger">', '</span>') ?>
                                        <input placeholder="Your SMTP Password" type="text" id="site-smtp-password" name="site-smtp-password" value="<?php echo esc($page_data['email']['password']) ?>" class="form-control">
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<div class="card-action">
						<input type="hidden" name="submit" value="Submit">
						<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update E-Mail Settings</button>
					</div>
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