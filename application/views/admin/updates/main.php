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
                  <a href="<?php anchor_to(UPDATES_CONTROLLER . '/main') ?>">
                  <?php echo esc($page_title) ?>
                  </a>
               </li>
            </ul>
         </div>
         <?php $this->load->view('admin/includes/alert'); ?>
         <div class="alert alert-warning rounded">
            <span><i class="fas fa-info-circle mr-1"></i> If you made any changes in the script, please make a backup before updating.</span>
        </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <div class="card-title"><?php echo esc(PRODUCT_NAME); ?> - <?php echo number_format(PRODUCT_VERSION, 1) ?></div>
                  </div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
                     <div class="form-group">
                        <?php if($page_data['update']['status'] == 'available') { ?>
                           <a target="_blank" href="<?php echo ENVATO_URL ?>">
                              <div class="alert alert-info rounded">
                                 <span><i class="fas fa-upload mr-1"></i> <u>A new update is available.</u></span>
                              </div>
                           </a>
                           <div>
                              <h3>Follow these steps to update your Product.</h3>
                              <ul>
                                 <li>Download the package from <a href="<?php echo ENVATO_URL ?>">Envato Market</a>.</li>
                                 <li>Upload the <code>upload.zip</code> &amp; <code>update.json</code> files int <code><?php echo APPPATH.'third_party/update/' ?></code> directory using FTP.</li>
                                 <li>After the upload, Press the "Update Now" button below.</li>
                              </ul>
                           </div>
                           <a id="update-btn" href="#" class="btn btn-success mt-1 <?php echo_if(!$page_data['update']['uploaded'], 'disabled') ?>"><i class="fas fa-check mr-1"></i> Update Now</a>
                           <div id="update-dom" class="form-group mt-3 d-none">
                              <h4 id="current-action">Initializing...</h4>
                              <div class="progress">
                                 <div id="progress-bar" class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                              </div>
                           </div>
                        <?php } else { ?>
                           <div class="alert alert-success rounded">
                              <span><i class="fas fa-check mr-1"></i> <u>Congratulations!</u> Your product is fully updated to the latest version.</span>
                           </div>
                        <?php } ?>
                     </div>
						</div>
					</div>
				</div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Page Content -->
</div>
<?php $this->load->view('admin/includes/foot'); ?>