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
                     <div class="card-title">Update your Comment Settings</div>
                  </div>
				  <form action="<?php anchor_to(LAYOUT_CONTROLLER . '/comment_settings') ?>" method="POST">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
                        <div class="selectgroup w-100">
                           <label class="selectgroup-item">
                              <input type="radio" name="active-plugin" value="1" class="selectgroup-input activePlugin" <?php echo($page_data['comment_settings']['active_plugin'] == 1 ? "checked" : null); ?>>
                              <span class="selectgroup-button lg">Facebook Comment</span>
                           </label>
                           <label class="selectgroup-item">
                              <input type="radio" name="active-plugin" value="2" class="selectgroup-input activePlugin" <?php echo($page_data['comment_settings']['active_plugin'] == 2 ? "checked" : null); ?>>
                              <span class="selectgroup-button lg">Disqus Comment</span>
                           </label>
                        </div>
								
                        <div id="facebook-settings-container" class="settings-container <?php echo($page_data['comment_settings']['active_plugin'] == 1 ? null : "d-none"); ?>">
                           <div class="form-group">
                                 <label for="facebook-app-id">Facebook APP ID</label>
                                 <?php echo form_error('facebook-app-id', '<br><span class="text-danger">', '</span>') ?>
                                 <input placeholder="Facebook APP ID" type="text" id="facebook-app-id" name="facebook-app-id" value="<?php echo esc($page_data['comment_settings']['facebook_app_id']) ?>" class="form-control">
                           </div>
                        </div>
								<div id="disqus-settings-container" class="settings-container <?php echo($page_data['comment_settings']['active_plugin'] == 2 ? null : "d-none"); ?>">
                           <div class="form-group">
                                 <label for="disqus-short-name">Disqus Short Name</label>
                                 <?php echo form_error('disqus-short-name', '<br><span class="text-danger">', '</span>') ?>
                                 <input placeholder="Disqus Short Name" type="text" id="disqus-short-name" name="disqus-short-name" value="<?php echo esc($page_data['comment_settings']['disqus_short_name']) ?>" class="form-control">
                           </div>
                        </div>
							</div>
						</div>
					</div>
					<div class="card-action">
						<input type="hidden" name="submit" value="Submit">
						<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Comment Settings</button>
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
<?php $this->load->view('admin/includes/footEnd'); ?>