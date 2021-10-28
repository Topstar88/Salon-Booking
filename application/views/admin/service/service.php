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
                        <a href="<?php anchor_to(SERVICE_CONTROLLER . '/services') ?>">
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
                            <div class="card-title float-left">Services</div>
                            <a href="<?php anchor_to(SERVICE_CONTROLLER . '/addservice') ?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-2"></i> Add Service</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Service Agents</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$agent_List_By_Service){?>
                                            <tr>
                                                <td colspan="6" class="text-center"><h4 class="text-muted">No Service Found</h4></td>
                                            </tr>
                                        <?php } else{?>
                                        <?php foreach ($agent_List_By_Service as $serv ){ ?>
                                        <tr>
                                            <td><?php echo esc($serv['id'], true) ?></td>
                                            <td><?php echo esc($serv['title'], true) ?></td>
											<td>
											<?php 
												$agents = '';
												foreach($serv['agentIds'] as $agNm) {
												$agents .= $agNm['agentName'] . ', ';
												}
												$agents = trim($agents, ', ');
												echo esc($agents, true);
											?>
											</td>
                                            <td><?php echo esc($serv['description'], true) ?></td>
                                            <td><?php echo esc($serv['price'], true) ?></td>
                                            <td><?php echo esc($serv['servDuration'], true) ?></td>
                                            <td>
                                                <a href="<?php anchor_to(SERVICE_CONTROLLER . '/editservice/' . $serv['id']) ?>" data-toggle="tooltip" data-placement="top" title="Edit Service" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-link btn-danger deleteService" data-toggle="tooltip" data-placement="top" title="Delete" value="<?php echo esc($serv['id'], true) ?>"><i class="fa fa-times"></i></button>
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
<script type="text/javascript" src="<?php admin_assets('js/includes/alerts.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>