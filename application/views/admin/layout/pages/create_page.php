<?php $this->load->view('admin/includes/head'); ?>
<div class="wrapper fullheight-side">
<?php $this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar'); 
$this->load->view('admin/includes/navbar'); ?>

<div class="main-panel">
   <div class="container">
      <div class="page-inner">
         <div class="page-header">
            <h4 class="page-title">Add Page</h4>
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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/create_page') ?>">
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
                     <div class="card-title">Create a New Page</u></div>
                  </div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
                           <form method="POST" action="<?php anchor_to(LAYOUT_CONTROLLER . '/create_page') ?>">
                                <div class="form-group">
                                    <label for="page-title">Title <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-title', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="page-title" name="page-title" placeholder="Choose Page Title">
                                </div>
                                <div class="form-group">
                                    <label for="page-permalink">Permalink</label>
                                    <?php echo form_error('page-permalink', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="page-permalink" name="page-permalink" placeholder="Choose Page Permalink">
                                    <small>Leave empty for auto-generating.</small>
                                </div>
                                <div class="form-group">
                                    <label for="page-content">Content <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-content', '<br><span class="text-danger">', '</span>'); ?>
                                    <textarea id="service-content" name="page-content" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="page-position">Select Position <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-position', '<br><span class="text-danger">', '</span>'); ?>
                                    <select class="form-control" name="page-position" id="page-position">
                                       <option selected value="1">Header</option>
                                       <option value="2">Footer</option>
                                       <option value="3">Both</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="submit" value="Submit">
                                    <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/pages'); ?>" class="btn btn-danger text-white"><i class="fas fa-arrow-left mr-1"></i> Back</a>
                                    <button class="btn btn-success"><i class="fas fa-plus mr-1"></i> Create Page</button>
                                </div>
                           </form>
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
<script type="text/javascript" src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php admin_assets('js/includes/editor.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>