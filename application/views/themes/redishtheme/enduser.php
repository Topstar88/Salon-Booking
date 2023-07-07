<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection endUser">
		<div class="container">
            <div class="selectionBoxMain d-none">
                <h1 class="loginSignupTitle"></h1>
                <p class="loginSignupSubTitle">Log in to get in the moment updates on the things that interest you.</p>
            </div>


            <div class="profileSetting selectionBoxMain clearfix">
                <h1 class="profileTitle"><?php echo esc($title, true); ?></h1>
                <div class="profileTabList row">
                    <div class="nav profileTabsColumn col-md-3 col-lg-2" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link <?php echo (!isset($tab) ? 'active' : ($tab == 'account' ? 'active' : '')) ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile Setting</a>
                        <a class="nav-item nav-link <?php echo (!isset($tab) ? '' : ($tab == 'password' ? 'active' : '')) ?>" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Password</a>
                    </div>

                    <div class="tab-content col-md-9 col-lg-10" id="nav-tabContent">
                        <?php if(isset($alert) || $alert = $this->session->flashdata('alert')) { ?>
                            <div class="<?php echo esc($alert['type']) ?> alert-dismissible fade show rounded">
                                <span><?php echo esc($alert['msg']); ?></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="tab-pane fade <?php echo (!isset($tab) ? 'show active' : ($tab == 'account' ? 'show active' : '')) ?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="fullname"><b>Username</b></label>
                                            <input value="<?php echo esc($user['fullName']) ?>" type="text" class="form-control formControlInput" name="fullname" placeholder="Your Full Name">
                                            <?php echo form_error('fullname', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                        <div class="form-group m-b-0">
                                            <label for="exampleInputEmail1"><b>Email</b></label>
                                            <input disabled type="email" value="<?php echo esc($user['email']) ?>" class="form-control formControlInput" placeholder="Enter email">
                                            <small class="form-text text-muted">Email change Disallowed</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <img class="userImage border rounded-circle" width="100px" height="100px" src="<?php 
                                            if(!$user['photoURL'] && !$user['image']){ uploads('user/usericon.svg'); }
                                            if($user['image'] && $user['photoURL']){ uploads('user/' . $user['image']); }
                                            if($user['image'] && !$user['photoURL']){ uploads('user/' . $user['image']); }
                                            if(!$user['image'] && $user['photoURL']) { print_r($user['photoURL']); } 
                                            ?>">
                                        <input type="file" name="avatar" class="form-control mt-2">
                                    </div>
                                </div>
                                <hr class="m-t-20 m-b-20">
                                <input class="btn customFormButton" name="submit-acc" type="submit" value="Update Account">
                            </form>
                        </div>
                        <div class="tab-pane fade <?php echo (!isset($tab) ? '' : ($tab == 'password' ? 'show active' : '')) ?>" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="password"><b>Old Password</b></label>
                                            <input type="password" class="form-control formControlInput" id="password" name="password" placeholder="Your Old Password">
                                            <?php echo form_error('password', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword"><b>New Password</b></label>
                                            <input type="password" class="form-control formControlInput" placeholder="Your New Password" id="newpassword" name="newpassword">
                                            <?php echo form_error('newpassword', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                        <hr class="m-t-5 m-b-20">
                                        <input type="submit" value="Update Password" name="submit-pass" class="btn customFormButton">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



		</div>
	</div>
	<!-- /mainSection -->
	
<?php $theme_view('includes/foot'); ?>

<?php $theme_view('includes/footEnd'); ?>