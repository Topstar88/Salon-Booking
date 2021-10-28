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
                  <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/pages') ?>">
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
                     <div class="card-title">Update Page Title, Content & Order</div>
                  </div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-block">
                                        <span><i class="fas fa-arrows-alt mr-1"></i> You can drag the pages to change their order.</span>
                                        <a class="float-right btn btn-success" href="<?php anchor_to(LAYOUT_CONTROLLER . '/create_page') ?>"><i class="fas fa-plus mr-1"></i> Create Page</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-3 p-3 bg-primary text-light font-weight-bold rounded">
                                        <div class="cst-table-head">
                                            <div class="row">
                                                <div class="col-5">
                                                    <span>Title</span>
                                                </div>
                                                <div class="col-3">
                                                    <span>Permalink (Slug)</span>
                                                </div>
                                                <div class="col-2">
                                                    <span>Position</span>
                                                </div>
                                                <div class="col-1">
                                                    <span>Status</span>
                                                </div>
                                                <div class="col-1">
                                                    <span>Action</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="sortable-list" class="pages-area">
                                        <?php foreach($all_pages as $page) { ?>
                                            <div data-pl="<?php echo esc($page['permalink']) ?>" class="page-sortable mt-2 p-3 bg-light text-dark border rounded">
                                                <div class="cst-table-row">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <span><?php echo esc($page['title'], true) ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <span><a href="<?php anchor_to(PAGE_CONTROLLER . '/' . $page['permalink']) ?>" target="_blank"><?php echo esc($page['permalink']) ?></a></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="badge badge-info"><?php echo ($page['position'] == 1 ? 'Header' : ($page['position'] == 2 ? 'Footer' : 'Both')) ?></span>
                                                        </div>
                                                        <div class="col-1">
                                                            <span>
                                                                <?php if($page['status']) { ?>
                                                                    <span class="badge badge-success">On</span>
                                                                <?php } else { ?>
                                                                    <span class="badge badge-danger">Off</span>
                                                                <?php } ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-1">
                                                            <span><a href="<?php anchor_to(LAYOUT_CONTROLLER . '/edit_page/' . $page['permalink']) ?>" class="badge badge-success"><i class="fas fa-edit mr-1"></i> Edit</a></span>
                                                        </div>
                                                    </div>
                                                </div>
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
   </div>
</div>
<!-- End Page Content -->
</div>
<?php $this->load->view('admin/includes/foot'); ?>