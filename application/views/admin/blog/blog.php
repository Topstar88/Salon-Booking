<?php $this->load->view('admin/includes/head'); ?>
<div class="wrapper fullheight-side">
<?php $this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar'); 
$this->load->view('admin/includes/navbar'); ?>

<!-- Page Content -->

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
                        <a href="<?php anchor_to(ADMINBLOG_CONTROLLER) ?>">
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
                            <div class="card-title float-left">All Posts</div>
                            <a href="<?php anchor_to(ADMINBLOG_CONTROLLER . '/add_post') ?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-2"></i> Add Blog Post</a>
                            <span class="custom-control custom-switch mt-2 mr-3 float-right">
                                <form action="<?php anchor_to(ADMINBLOG_CONTROLLER . '/blogStatus') ?>" method="POST">
                                    <input <?php echo (isset($blogStatus['bstatus']) ? ($blogStatus['bstatus'] == 1 ? "checked" : null) : "checked"); ?> id="blogStatus" name="status" type="checkbox" class="custom-control-input">
                                <label class="custom-control-label lh-cs mb-0" for="blogStatus">Show Blog</label>
                                </form>
                            </span>
                            <span id="statusChanged" style="display:none" class="float-right mt-2 text-success mr-3">Status changed successfully</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Post Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$blogLists){?>
                                            <tr>
                                                <td colspan="6" class="text-center"><h4 class="text-muted">No Service Found</h4></td>
                                            </tr>
                                        <?php } else{?>
                                        <?php foreach ($blogLists as $blogList ){ ?>
                                        <tr>
                                            <td><?php echo esc($blogList['id'], true) ?></td>
                                            <td><?php echo word_limiter(esc($blogList['title'], true), 8) ?></td>
                                            <td><?php echo word_limiter(esc($blogList['description'], true), 15) ?></td>
                                            <td><?php echo esc($blogList['datetime_added'], true) ?></td>
                                            <td>
                                                <?php 
                                                    if($blogList['status'] == 1){echo '<span class="badge badge-success">Show</span?>';}
                                                    if($blogList['status'] == 2){echo '<span class="badge badge-danger">Hide</span?>';}
                                                ?>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="<?php anchor_to(ADMINBLOG_CONTROLLER . '/edit_post/' . $blogList['id']) ?>" data-toggle="tooltip" data-placement="top" title="Edit Post" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-link btn-danger delete_post" value="<?php echo esc($blogList['id'], true) ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
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
<script type="text/javascript" src="<?php admin_assets('js/plugin/sweetalert/sweetalert.min.js') ?>"></script>
<script type="text/javascript" src="<?php admin_assets('js/includes/blog.js'); ?>"></script>
<script type="text/javascript" src="<?php admin_assets('js/includes/alerts.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>