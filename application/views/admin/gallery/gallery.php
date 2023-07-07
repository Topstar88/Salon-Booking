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
                        <a href="<?php anchor_to(GALLERY_CONTROLLER) ?>">
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
                            <a href="<?php anchor_to(GALLERY_CONTROLLER . '/addImg') ?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-2"></i> Add Image</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Category</th>
                                            <th class="text-right" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$listGalleryWidCat){?>
                                            <tr>
                                                <td colspan="6" class="text-center"><h4 class="text-muted">No Image Found</h4></td>
                                            </tr>
                                        <?php } else{?>
                                        <?php $i = 1; foreach ($listGalleryWidCat as $listGall){ ?>
                                            <tr>
                                                <td><?php echo esc($i, true) ?></td>
                                                <td><img src="<?php uploads('gallery/'.$listGall['imgPath']) ?>" alt="" height="80px" width="80" class="mt-2 mb-2"></td>
                                                <td><?php echo esc($listGall['imgName'], true) ?></td>
                                                <td><?php echo esc($listGall['imgDetails'], true) ?></td>
                                                <td><?php echo esc($listGall['cName'], true) ?></td>
                                                <td class="text-right">
                                                    <a href="<?php anchor_to(GALLERY_CONTROLLER . '/editImg/' . $listGall['id']) ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-link btn-danger deleteImg" data-toggle="tooltip" data-placement="top" title="Delete" value="<?php echo esc($listGall['id'], true) ?>"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        <?php $i++; } }?>
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