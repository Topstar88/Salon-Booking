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
                        <a href="<?php anchor_to(CLIENTS_CONTROLLER . '/index') ?>">
                        <?php echo esc($page_title) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $this->load->view('admin/includes/alert'); ?>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data"  method="POST" action="<?php anchor_to(CLIENTS_CONTROLLER . '/editclients/' . $clients['id']) ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="client-name">Client Name <span class="text-danger">*</span></label>
                                    <?php echo form_error('client-name', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" name="client-name" value="<?php echo esc(set_value('client-name', $clients['fullName']), true)?>">
                                </div>
                                <div class="form-group">
                                    <label for="client-email">Client Name <span class="text-danger">*</span></label>
                                    <?php echo form_error('client-email', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="email" name="client-email" value="<?php echo esc(set_value('client-email', $clients['email']), true)?>">
                                </div>
                                <div class="form-group">
                                    <label for="client-phone">Client Phone <span class="text-danger">*</span></label>
                                    <?php echo form_error('client-phone', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" name="client-phone" value="<?php echo esc(set_value('client-phone', $clients['phone']), true)?>">
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <div class="form-group text-right">
                                    <input type="hidden" name="submit" value="Submit">
                                    <a href="<?php anchor_to(CLIENTS_CONTROLLER); ?>" class="btn btn-danger text-white mr-4"><i class="fas fa-arrow-left mr-1"></i> Back</a>
                                    <button class="btn btn-success"><i class="fas fa-save mr-1"></i> Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Page Content -->

</div>
	<?php $this->load->view('admin/includes/foot'); ?>
    <?php if(isset($load_scripts)) { foreach($load_scripts as $src) { ?>
		<script type="text/javascript" src="<?php admin_assets($src) ?>"></script>
    <?php } } ?>
<?php $this->load->view('admin/includes/footEnd'); ?>