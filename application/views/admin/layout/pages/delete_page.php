<?php $this->load->view('admin/includes/head'); ?>
<div class="wrapper fullheight-side">
<?php $this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar'); 
$this->load->view('admin/includes/navbar'); ?>

<div class="main-panel">
   <div class="container">
      <div class="page-inner">
         <div class="page-header">
            <h4 class="page-title">Delete Page</h4>
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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/pages') ?>">
                  Page Settings
                  </a>
               </li>
               <li class="separator">
                  <i class="flaticon-right-arrow"></i>
               </li>
               <li class="nav-home">
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/delete_page/' . $page['permalink']) ?>">
                  <?php echo esc($page_title, true) ?>
                  </a>
               </li>
            </ul>
         </div>
         <?php $this->load->view('admin/includes/alert'); ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <div class="card-title">Delete Page <u><?php echo esc($page['title'], true) ?></u></div>
                  </div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
                            <p>Confirm The Deletion of <strong><?php echo esc($page['title'], true); ?></strong></p>
                            <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/pages') ?>" class="btn btn-success"><i class="fas fa-arrow-left mr-1"></i> Go Back</a> <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/delete_page/' . $page['permalink'] . '/true') ?>" class="btn btn-danger"><i class="fas fa-trash mr-1"></i> Delete Page</a>
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