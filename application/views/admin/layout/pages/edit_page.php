<?php $this->load->view('admin/includes/head'); ?>
<div class="wrapper fullheight-side">
<?php $this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar'); 
$this->load->view('admin/includes/navbar'); ?>

<div class="main-panel">
   <div class="container">
      <div class="page-inner">
         <div class="page-header">
            <h4 class="page-title">Edit Page</h4>
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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/edit_page/' . $page['permalink']) ?>">
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
                     <div class="card-title">Update <u><?php echo esc($page['title'], true) ?></u></div>
                  </div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
                            <form method="POST" action="<?php anchor_to(LAYOUT_CONTROLLER . '/edit_page/' . $page['permalink']) ?>">
                                <div class="form-group">
                                    <label for="page-title">Title <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-title', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="page-title" name="page-title" placeholder="Choose Page Title" value="<?php echo esc($page['title'], true) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="page-permalink">Permalink <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-permalink', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="page-permalink" name="page-permalink" placeholder="Choose Page Permalink" value="<?php echo esc($page['permalink']) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="page-content">Content <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-content', '<br><span class="text-danger">', '</span>'); ?>
                                    <textarea id="service-content" name="page-content" class="form-control"><?php echo esc($page['content'], true) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="page-position">Select Position <span class="text-danger">*</span></label>
                                    <?php echo form_error('page-position', '<br><span class="text-danger">', '</span>'); ?>
                                    <select class="form-control" name="page-position" id="page-position">
                                       <option <?php echo_if($page['position'] == 1, 'selected') ?> value="1">Header</option>
                                       <option <?php echo_if($page['position'] == 2, 'selected') ?> value="2">Footer</option>
                                       <option <?php echo_if($page['position'] == 3, 'selected') ?> value="3">Both</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input <?php echo_if($page['status'], 'checked') ?> type="checkbox" class="custom-control-input" name="page-status" id="status-switch">
                                        <label class="custom-control-label" for="status-switch">Status</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="submit" value="Submit">
                                    <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/pages'); ?>" class="btn btn-danger text-white"><i class="fas fa-arrow-left mr-1"></i> Back</a>
                                    <button class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Page</button>
                                    <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/delete_page/' . $page['permalink']) ?>" class="btn btn-danger float-right"><i class="fas fa-trash mr-1"></i> Remove Page</a>
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