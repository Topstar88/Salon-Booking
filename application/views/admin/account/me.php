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
                        <a href="<?php anchor_to(ACCOUNT_CONTROLLER . '/me') ?>">
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
                            <div class="card-title">Update your Account Credentials</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="<?php anchor_to(ACCOUNT_CONTROLLER . '/me') ?>">
                                        <div class="form-group">
                                            <label for="admin-fullName">fullName <span class="text-danger">*</span></label>
                                            <?php echo form_error('admin-fullName', '<br><span class="text-danger">', '</span>'); ?>
                                            <input id="admin-fullName" name="admin-fullName" placeholder="Enter your desired fullName" value="<?php echo esc($user['fullName']) ?>" type="text" class="form-control">
                                            <small class="text-muted">You may only choose a unique fullName.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="admin-email">E-Mail Address <span class="text-danger">*</span></label>
                                            <?php echo form_error('admin-email', '<br><span class="text-danger">', '</span>'); ?>
                                            <input id="admin-email" name="admin-email" placeholder="Enter your desired E-Mail" value="<?php echo esc($user['email']) ?>" type="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="admin-new-password">New Password</label>
                                            <?php echo form_error('admin-new-password', '<br><span class="text-danger">', '</span>'); ?>
                                            <input id="admin-new-password" name="admin-new-password" placeholder="Choose a New Password" type="password" class="form-control">
                                            <small class="text-muted">Choose a <u>strong</u> & <u>secure</u> password. Use alphanumeric & special characters.</small>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="admin-password">Current Password <span class="text-danger">*</span></label>
                                            <?php echo form_error('admin-password', '<br><span class="text-danger">', '</span>'); ?>
                                            <input id="admin-password" name="admin-password" placeholder="Enter your current password" type="password" class="form-control">
                                            <small class="text-muted">This is required to make any changes.</small>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="hidden" name="submit" value="Submit">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Account</button>
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
</div>

<!-- End Page Content -->

</div>
<?php $this->load->view('admin/includes/foot'); ?>
<?php $this->load->view('admin/includes/footEnd'); ?>