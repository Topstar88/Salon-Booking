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
                        <a href="<?php anchor_to(SERVICE_CONTROLLER . '/index') ?>">
                        <?php echo esc($page_title) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $this->load->view('admin/includes/alert'); ?>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data"  method="POST" action="<?php anchor_to(SERVICE_CONTROLLER . '/addservice') ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="service-title">Title <span class="text-danger">*</span></label>
                                    <?php echo form_error('service-title', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="service-title" name="service-title" placeholder="Choose Service Title" value="<?php echo set_value('service-title')?>">
                                </div>
                                <div class="form-group">
                                    <label for="service-content">Content <span class="text-danger">*</span></label>
                                    <?php echo form_error('service-content', '<br><span class="text-danger">', '</span>'); ?>
                                    <textarea id="service-content" name="service-content" class="form-control"><?php echo set_value('service-content')?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="service-price">Service Price <span class="text-danger">*</span></label>
                                                    <?php echo form_error('service-price', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input value="1.0" data-decimals="2" min="1" step="0.1" class="form-control" type="number" id="service-price" name="service-price" placeholder="Choose Service Price" value="<?php echo set_value('service-price')?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service-space">Available Space per service <span class="text-danger">*</span></label>
                                                    <?php echo form_error('service-space', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input value="1"  min="1" step="1" class="form-control" type="number" id="service-space" name="service-space" placeholder="Choose Service Space" value="<?php echo set_value('service-space')?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service-starts">Service Starts <span class="text-danger">*</span></label>
                                                    <?php echo form_error('service-starts', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input class="form-control" id="servStarts" type="text" id="timepicker" name="service-starts" placeholder="Type: when your service starts" value="<?php echo set_value('service-starts')?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service-ends">Service Ends <span class="text-danger">*</span></label>
                                                    <?php echo form_error('service-ends', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input class="form-control" id="servEnds" type="text" id="timepicker" name="service-ends" placeholder="Type: when your service Ends" value="<?php echo set_value('service-ends')?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service-duration">Service Duration <span class="text-danger">*</span></label>
                                                    <?php echo form_error('service-duration', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input class="form-control" type="text" id="service-duration" name="service-duration" placeholder="Service Duration: 02:30" value="<?php echo set_value('service-duration')?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="agent">Select Agent <span class="text-danger">*</span></label>
                                                    <?php echo form_error('agent[]', '<br><span class="text-danger">', '</span>'); ?>
                                                    <select id="multiple" name="agent[]" class="form-control" multiple="multiple">
														<optgroup label="Select Agent">
                                                            <?php foreach($agents as $agent){ ?>
                                                                <option value="<?php echo esc($agent['id'], true)?>"><?php echo esc($agent['agentName'], true)?></option>
                                                            <?php } ?>
														</optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site-logo">Select Service Image <span class="text-danger">*</span></label>
                                            <?php echo isset($logo_error) ? '<div class="alert alert-danger">' . $logo_error . '</div>' : '' ?>
                                            <div class="input-file input-file-image">
                                                <img class="img-upload-preview" src="<?php admin_assets('img/150x150.png');?>" alt="preview" width="150">

                                                <input for="site-logo" type="file" class="form-control form-control-file" id="site-logo" name="site-logo">
                                                <label for="site-logo" class="label-input-file btn btn-black btn-round">
                                                    <span class="btn-label"><i class="fa fa-file-image"></i></span> Upload a Image
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group text-right">
                                    <input type="hidden" name="submit" value="Submit">
                                    <a href="<?php anchor_to(SERVICE_CONTROLLER . '/services'); ?>" class="btn btn-danger text-white mr-4"><i class="fas fa-arrow-left mr-1"></i> Back</a>
                                    <button class="btn btn-success"><i class="fas fa-plus mr-1"></i> Create Page</button>
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
    <script src="<?php admin_assets("js/bootstrap-input-spinner.js"); ?>"></script>
    <script src="<?php admin_assets("js/plugin/moment/moment.min.js"); ?>"></script>
    <script src="<?php admin_assets("js/plugin/datepicker/bootstrap-datetimepicker.min.js"); ?>"></script>
    <script src="<?php admin_assets("js/includes/services.js"); ?>"></script>
    <script src="<?php admin_assets("js/includes/inputImageShow.js"); ?>"></script>
    <script src="<?php admin_assets("js/plugin/select2/select2.full.min.js"); ?>"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="<?php admin_assets('js/includes/editor.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>