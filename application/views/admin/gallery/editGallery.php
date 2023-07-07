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
                    <form enctype="multipart/form-data"  method="POST" action="<?php anchor_to(GALLERY_CONTROLLER . '/editImg/' . $gallery['id']) ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image-title">Image Title <span class="text-danger">*</span></label>
                                    <?php echo form_error('image-title', '<br><span class="text-danger">', '</span>'); ?>
                                    <input class="form-control" type="text" id="image-title" name="image-title" value="<?php echo esc(set_value('image-title', $gallery['imgName']), true)?>">
                                </div>
                                <div class="form-group">
                                    <label for="image-content">Image Short Detail <span class="text-danger">*</span></label>
                                    <?php echo form_error('image-content', '<br><span class="text-danger">', '</span>'); ?>
                                    <textarea id="service-content" name="image-content" class="form-control"><?php echo esc(set_value('image-content', $gallery['imgDetails']), true)?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categoryId">Image Category <span class="text-danger">*</span></label>
                                            <?php echo form_error('categoryId', '<br><span class="text-danger">', '</span>'); ?>
                                            <select name="categoryId" id="" class="form-control custom-select">
                                                <?php foreach($categories as $gCat){ ?>
                                                    <option value="<?php echo esc($gCat['id'], true)?>"<?php echo ($gCat['id'] == $gallery['catId']) ? 'selected' : '' ?>><?php echo esc($gCat['cName'], true)?> - (<?php echo esc($gCat['count'], true)?>)</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gImage">Select gallery Image <span class="text-danger">*</span></label>
                                            <?php echo isset($logo_error) ? '<div class="alert alert-danger">' . $logo_error . '</div>' : '' ?>
                                            <div class="input-file input-file-image">
                                                <img class="img-upload-preview" src="<?php uploads('gallery/'.$gallery['imgPath']) ?>" alt="preview" width="150">

                                                <input for="gImage" type="file" class="form-control form-control-file" id="gImage" name="gImage">
                                                <label for="gImage" class="label-input-file btn btn-black btn-round">
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
                                    <a href="<?php anchor_to(GALLERY_CONTROLLER); ?>" class="btn btn-danger text-white mr-4"><i class="fas fa-arrow-left mr-1"></i> Back</a>
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
<script src="<?php admin_assets("js/includes/inputImageShow.js"); ?>"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php admin_assets('js/includes/editor.js') ?>"></script>
<?php $this->load->view('admin/includes/footEnd'); ?>