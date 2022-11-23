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
                        <a href="<?php anchor_to(CLIENTS_CONTROLLER . '/clients') ?>">
                        <?php echo esc($page_title) ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $this->load->view('admin/includes/alert'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Client Email</th>
                                            <th>Clients Phone</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($clients)){?>
                                        <?php foreach ($clients as $client ){ ?>
                                        <tr>
                                            <td><?php echo esc($client['fullName'], true) ?></td>
                                            <td><?php echo esc($client['email'], true) ?></td>
                                            <td><?php echo esc($client['phone'], true) ?></td>
                                            <td class="text-right">
                                                <a href="<?php anchor_to(CLIENTS_CONTROLLER . '/editclients/' . $client['id']) ?>" data-toggle="tooltip" data-placement="top" title="Edit Clients" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-link btn-danger deleteclient" data-toggle="tooltip" data-placement="top" title="Delete" value="<?php echo esc($client['id'], true) ?>"><i class="fa fa-times"></i></button> 
                                            </td>
                                        </tr>
                                        <?php }
                                        } else{
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="4"><h4 class="text-muted">No Client Found</h4></td>
                                        </tr>
                                        <?php } ?>
                                    
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
<script type="text/javascript" src="<?php admin_assets('js/includes/alerts.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>