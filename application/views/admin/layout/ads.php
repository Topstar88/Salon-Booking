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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/ads') ?>">
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
                     <div class="card-title">Add your Ads Codes</div>
                  </div>
				  <form action="<?php anchor_to(LAYOUT_CONTROLLER . '/ads') ?>" method="POST">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="header-scripts">Top Image Ad</label>
									<div class="clearfix"></div>
									<small>Only add link for add Ex: http://</small>
									<div class="custom-control custom-switch">
										<input <?php echo_if($page_data['ads']['top']['status'], esc('checked')) ?> name="site-top-ad-status" type="checkbox" class="custom-control-input" id="switch-1">
										<label class="custom-control-label" for="switch-1">Status</label>
									</div>
									<?php echo form_error('site-top-ad-code', '<div class="alert alert-danger">', '</div>'); ?>
									<input type="text" name="site-top-ad-code" class="mb-4 form-control form-control-lg resize-none" placeholder="Enter your Top image Ad URL right here." value="<?php echo esc($page_data['ads']['top']['code'], true) ?>">
									<?php if($page_data['ads']['top']['status']) { ?>
										<small class="mt-2">Currently Applied:<br> <code class="p-2 rounded bg-secondary text-white d-block"><?php echo esc($page_data['ads']['top']['code'], true) ?></code></small>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="header-scripts">Bottom Image Ad</label>
									<div class="clearfix"></div>
									<small>Only add link for add Ex: http://</small>
										<div class="custom-control custom-switch">
											<input <?php echo_if($page_data['ads']['bottom']['status'], esc('checked')) ?> name="site-bottom-ad-status" type="checkbox" class="custom-control-input" id="switch-2">
											<label class="custom-control-label" for="switch-2">Status</label>
										</div>
										<?php echo form_error('site-bottom-ad-code', '<div class="alert alert-danger">', '</div>'); ?>
										<input type="text" name="site-bottom-ad-code" class="mb-4 form-control form-control-lg resize-none"  placeholder="Enter your Bottom image Ad URL right here." value="<?php echo esc($page_data['ads']['bottom']['code'], true) ?>">
										<?php if($page_data['ads']['bottom']['status']) { ?>
												<small class="mt-2">Currently Applied:<br> <code class="p-2 rounded bg-secondary text-white d-block"><?php echo esc($page_data['ads']['bottom']['code'], true) ?></code></small>
										<?php } ?>
								</div>
							</div>
					</div>
					<div class="card-action">
						<input type="hidden" name="submit" value="Submit">
						<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Ads</button>
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