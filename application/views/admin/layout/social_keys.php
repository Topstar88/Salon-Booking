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
                        <a href="<?php anchor_to(LAYOUT_CONTROLLER . '/social_keys') ?>">
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
                            <div class="card-title">Add/Update your Google & Facebook Social Keys</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="<?php anchor_to(LAYOUT_CONTROLLER . '/social_keys') ?>">
                                        <div class="form-group">
                                            <label for="google-public">Google Client ID</label>
                                            <input id="google-public" name="google-public" placeholder="Your Google API Client ID" value="<?php echo esc($page_data['social_keys']['google_public']) ?>" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="google-secret">Google Secret Key</label>
                                            <input id="google-secret" name="google-secret" placeholder="Your Google API Client Secret Key" value="<?php echo esc($page_data['social_keys']['google_secret']) ?>" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <span>Google Login is <?php echo_if($page_data['social_keys']['google_status'], '<span class="text-success">Enabled</span>', '<span class="text-danger">Disabled</span>') ?>.
                                        </div>
                                        <div class="form-group">
                                            <span>Set your Google Redirect URI To: <a target="_blank" href="<?php anchor_to(OAUTH_CONTROLLER . '/google') ?>"><span class="badge badge-danger"><?php anchor_to(OAUTH_CONTROLLER . '/google') ?></span></a></span>
                                            <a class="float-right" target="_blank" href="https://console.developers.google.com/apis/credentials"><span class="badge badge-danger">Register Google Keys</span></a>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="facebook-public">Facebook Public Key</label>
                                            <input id="facebook-public" name="facebook-public" placeholder="Your Facebook Developer Public Key" value="<?php echo esc($page_data['social_keys']['facebook_public']) ?>" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="facebook-secret">Facebook Private Key</label>
                                            <input id="facebook-secret" name="facebook-secret" placeholder="Your Facebook Developer Private Key" value="<?php echo esc($page_data['social_keys']['facebook_secret']) ?>" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <span>Facebook Login is <?php echo_if($page_data['social_keys']['facebook_status'], '<span class="text-success">Enabled</span>', '<span class="text-danger">Disabled</span>') ?>.
                                        </div>
                                        <div class="form-group">
                                            <span>Set your Facebook Redirect URI To: <a target="_blank" href="<?php anchor_to(OAUTH_CONTROLLER . '/facebook') ?>"><span class="badge badge-info"><?php anchor_to(OAUTH_CONTROLLER . '/facebook') ?></span></a></span>
                                            <a class="float-right" target="_blank" href="https://developers.facebook.com/apps"><span class="badge badge-info">Register Facebook Keys</span></a>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="hidden" name="submit" value="Submit">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-check mr-1"></i> Update Social Keys</button>
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