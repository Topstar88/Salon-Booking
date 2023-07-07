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
                        <a href="<?php anchor_to(PAYMENTS_CONTROLLER) ?>">
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Transection ID</th>
                                            <th scope="col">User Email</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$orders){?>
                                            <tr>
                                                <td colspan="11" class="text-center"><h4 class="text-muted">No Order Found</h4></td>
                                            </tr>
                                        <?php } else{?>
                                        <?php foreach ($orders as $order ){ ?>
                                        <tr>
                                            <td><?php echo esc($order['id'], true) ?></td>
                                            <td><?php echo esc($order['orderId'], true) ?></td>
                                            <td><?php echo esc($order['transectionId'], true) ?></td>
                                            <td><?php echo esc($order['email'], true) ?></td>
                                            <td><?php echo esc($order['title'], true) ?></td>
                                            <td><?php echo esc($order['paid_amount'], true) ?></td>
                                            <td><?php echo esc($order['paid_currency'], true) ?></td>
                                            <td><a href="<?php echo esc($order['receipt_url'], true) ?>" target="_blank" class="btn btn-primary btn-sm">Invoice</a></td>
                                            <td><?php echo esc($order['created'], true) ?></td>
                                        </tr>
                                        <?php }} ?>
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