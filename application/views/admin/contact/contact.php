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
                        <a href="<?php anchor_to(CONTACT_CONTROLLER . '/index') ?>">
                        <?php echo esc($page_title) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $this->load->view('admin/includes/alert'); ?>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data"  method="POST" id="contactfg" action="<?php anchor_to(CONTACT_CONTROLLER . '/contactDetails/') ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="contact-phone">Phone Number <span class="text-danger">*</span></label>
                                    <?php echo form_error('contact-phone', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="contact-phone" name="contact-phone" placeholder="Type Phone Number with Country Code" value="<?php echo esc(set_value('contact-phone', $contactDetails['phone']), true)?>">
                                </div>
                                <div class="form-group">
                                    <label for="contact-email">Email <span class="text-danger">*</span></label>
                                    <?php echo form_error('contact-email', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="contact-email" name="contact-email" placeholder="Type Email" value="<?php echo esc(set_value('contact-email', $contactDetails['email']), true)?>">
                                </div>
                                <div class="form-group">
                                    <label for="contact-address">Contact Address <span class="text-danger">*</span></label>
                                    <?php echo form_error('contact-address', '<br><span class="text-danger">', '</span>'); ?>
                                    <textarea id="service-content" name="contact-address" class="form-control"><?php echo esc(set_value('contact-address', $contactDetails['address']), true)?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="map_src">Google Map Src <span class="text-danger">*</span></label>
                                            <?php echo form_error('map_src', '<br><span class="text-danger">', '</span>'); ?>
                                            <input class="form-control" name="map_src" class="form-control" value="<?php echo esc(set_value('map_src', $contactDetails['map_src']), true)?>">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="map_wd">Map Width <span class="text-danger">*</span></label>
                                            <?php echo form_error('map_wd', '<br><span class="text-danger">', '</span>'); ?>
                                            <input class="form-control" name="map_wd" class="form-control" value="<?php echo esc(set_value('map_wd', $contactDetails['map_wd']), true)?>">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="map_ht">Map Height <span class="text-danger">*</span></label>
                                            <?php echo form_error('map_ht', '<br><span class="text-danger">', '</span>'); ?>
                                            <input class="form-control" name="map_ht" class="form-control" value="<?php echo esc(set_value('map_ht', $contactDetails['map_ht']), true)?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact-urlFb">Facebook URL <span class="text-danger">*</span></label>
                                            <?php echo form_error('contact-urlFb', '<br><span class="text-danger">', '</span>'); ?>
                                            <input class="form-control" type="text" id="contact-urlFb" name="contact-urlFb" placeholder="Paste Facebook Url" value="<?php echo esc(set_value('contact-urlFb', $contactDetails['urlFb']), true)?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact-urlTwt">Twitter URL <span class="text-danger">*</span></label>
                                            <?php echo form_error('contact-urlTwt', '<br><span class="text-danger">', '</span>'); ?>
                                            <input class="form-control" type="text" id="contact-urlTwt" name="contact-urlTwt" placeholder="Paste Facebook Url" value="<?php echo esc(set_value('contact-urlTwt', $contactDetails['urlTwt']), true)?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact-urlIn">Linked In URL <span class="text-danger">*</span></label>
                                            <?php echo form_error('contact-urlIn', '<br><span class="text-danger">', '</span>'); ?>
                                            <input class="form-control" type="text" id="contact-urlIn" name="contact-urlIn" placeholder="Paste Facebook Url" value="<?php echo esc(set_value('contact-urlIn', $contactDetails['urlIn']), true)?>">
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </div>
                            <div class="card-footer">
                                <div class="form-group text-right">
                                    <input type="hidden" name="submit" value="Submit">
                                    <a href="<?php anchor_to(CONTACT_CONTROLLER); ?>" class="btn btn-danger text-white mr-4"><i class="fas fa-arrow-left mr-1"></i> Back</a>
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
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="<?php admin_assets('js/includes/editor.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>