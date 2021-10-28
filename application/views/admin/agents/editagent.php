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
                        <a href="<?php anchor_to(AGENTS_CONTROLLER) ?>">
                        <?php echo esc($page_title) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $this->load->view('admin/includes/alert'); ?>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data"  method="POST" action="<?php anchor_to(AGENTS_CONTROLLER . '/editagent/' . $agent['id']) ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="agentName">Agent Name <span class="text-danger">*</span></label>
                                    <?php echo form_error('agentName', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="agentName" name="agentName" placeholder="Agent Name" value="<?php echo esc(set_value('agentName', $agent['agentName']), true)?>">
                                </div>
                                <div class="form-group">
                                    <label for="agentDescription">Agent Description <span class="text-danger">*</span></label>
                                    <?php echo form_error('agentDescription', '<br><span class="text-danger">', '</span>'); ?>
                                    <textarea id="service-content" name="agentDescription" class="form-control"><?php echo esc(set_value('agentDescription', $agent['agentDetail']), true)?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="experience">Experience (Years) <span class="text-danger">*</span></label>
                                                    <?php echo form_error('experience', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input min="1" step="1" class="form-control" type="number" id="service-price" name="experience" placeholder="Experience" value="<?php echo esc(set_value('experience', $agent['experience']), true)?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="totalBookings">Total Bookings <span class="text-danger">*</span></label>
                                                    <?php echo form_error('totalBookings', '<br><span class="text-danger">', '</span>'); ?>
                                                    <input min="1" step="1" class="form-control" type="number" id="totalBookings" name="totalBookings" placeholder="Total Bookings" value="<?php echo esc(set_value('totalBookings', $agent['totalBookings']), true)?>">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site-logo">Select Agent Image <span class="text-danger">*</span></label>
                                            <div class="text-danger mb-3"><b>Agent image less than 500 X 500</b></div>
                                            <?php echo isset($logo_error) ? '<div class="alert alert-danger">' . $logo_error . '</div>' : '' ?>
                                            <div class="input-file input-file-image">
                                                <img class="img-upload-preview" src="<?php uploads('img/agents/'.$agent['agentImage']);?>" alt="preview" width="150">

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
                                    <a href="<?php anchor_to(AGENTS_CONTROLLER); ?>" class="btn btn-danger text-white mr-4"><i class="fas fa-arrow-left mr-1"></i> Back</a>
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
    <script src="<?php admin_assets("js/bootstrap-input-spinner.js"); ?>"></script>
    <script src="<?php admin_assets("js/plugin/moment/moment.min.js"); ?>"></script>
    <script src="<?php admin_assets("js/plugin/datepicker/bootstrap-datetimepicker.min.js"); ?>"></script>
    <script src="<?php admin_assets("js/includes/services.js"); ?>"></script>
    <script src="<?php admin_assets("js/includes/inputImageShow.js"); ?>"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="<?php admin_assets('js/includes/editor.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>