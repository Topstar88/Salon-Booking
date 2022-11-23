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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/scripts') ?>">
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
                     <div class="card-title">Update your Header / Footer Scripts</div>
                  </div>
				  <form action="<?php anchor_to(LAYOUT_CONTROLLER . '/scripts') ?>" method="POST">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="header-scripts">Header Scripts</label>
									<textarea rows="4" name="site-header-scripts" class="form-control form-control-lg resize-none" id="header-scripts" placeholder="Scripts to include inside the <head> tag."><?php echo esc($page_data['scripts']['header'], true) ?></textarea>
									<small>These scripts will be included in the document inside the <code>&lt;head&gt;</code> tag.</small>
								</div>
							</div>
							<div class="col-lg-6">
                                <div class="form-group">
									<label for="footer-scripts">Footer Scripts</label>
									<textarea rows="4" name="site-footer-scripts" class="form-control form-control-lg resize-none" id="footer-scripts" placeholder="Scripts to include before the </body> tag."><?php echo esc($page_data['scripts']['footer'], true) ?></textarea>
									<small>These scripts will be included in the document before the <code>&lt;/body&gt;</code> tag.</small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-action">
						<input type="hidden" name="submit" value="Submit">
						<button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Scripts</button>
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