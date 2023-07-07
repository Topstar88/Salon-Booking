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
                        <a href="<?php anchor_to(GENERAL_CONTROLLER . '/themes') ?>">
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
                            <div class="card-title">Customize the Appearance of your Website</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <?php foreach($themes as $theme) { ?>
                                            <!--<a href="<?php anchor_to('general/set_theme/' . $theme['manifest']['identifier']) ?>">
                                                <img src="<?php echo esc($theme['thumbnail']) ?>">
                                            </a>-->
                                            <div class="col-lg-4 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                    <div><?php echo esc($theme['manifest']['name']); if($current_theme == $theme['manifest']['identifier']) { ?><span class="badge badge-secondary float-right">Currently in Use.</span><?php } ?></div>
                                                    </div>
                                                    <div class="card-body">
                                                        <img class="rounded img-fluid" src="<?php echo esc($theme['cover']) ?>">
                                                    </div>
                                                    <div class="card-footer">
                                                        <span class="badge badge-danger">By: <?php echo esc($theme['manifest']['author']['name']); ?></span>
                                                        <?php if($current_theme === $theme['manifest']['identifier']) { ?>
                                                            <a class="btn btn-success btn-sm float-right disabled" href="<?php anchor_to(GENERAL_CONTROLLER . '/set_theme/' . $theme['manifest']['identifier']) ?>"><i class="fas fa-check mr-1"></i> Activate</a>
                                                        <?php } else { ?>
                                                            <a class="btn btn-success btn-sm float-right" href="<?php anchor_to(GENERAL_CONTROLLER . '/set_theme/' . $theme['manifest']['identifier']) ?>"><i class="fas fa-check mr-1"></i> Activate</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card w-100">
                                                <div class="card-body d-flex">
                                                    <a href="<?php anchor_to(GENERAL_CONTROLLER . '/upload_theme') ?>" class="btn btn-secondary btn-lg float-right flex-1 d-flex justify-content-center align-items-center"><i class="fas fa-upload mr-1"></i> Upload New Theme</a>
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
    </div>
</div>

<!-- End Page Content -->

</div>
<?php $this->load->view('admin/includes/foot'); ?>
<?php $this->load->view('admin/includes/footEnd'); ?>