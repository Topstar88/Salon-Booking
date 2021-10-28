<?php $this->load->view('admin/includes/head'); ?>
<div class="wrapper wrapper-login wrapper-login-full p-0">
		
		<div class="login-aside w-100 d-flex align-items-center justify-content-center bg-redish-gradient">
			<div class="container container-login container-transparent animated fadeIn bg-white">
				<h3 class="text-center text-dark">
                    Desclix
                </h3>
				<div class="alert alert-danger" id="somethngwrng" style="display:none">Script tag in fields not allowed.</div>
				<form method="POST" class="login-form">
                    <?php if($error) { ?>
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <span><?php echo esc($error); ?></span>
                            </div>
                        </div>
                    <?php } else if($alert = $this->session->flashdata('alert')) { ?>
						<div class="<?php echo esc($alert['type']) ?> alert-dismissible fade show">
							<span><?php echo esc($alert['msg']); ?></span>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<div class="form-group">
						<label for="username" class="placeholder"><b>Username / E-Mail</b></label>
						<input placeholder="Your Username or E-Mail" name="identifier" id="username" type="text" class="form-control" required>
                        <?php echo form_error('identifier', '<div class="text-danger">', '</div>') ?>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<div class="position-relative">
                            <input placeholder="Your Password" id="password" name="password" type="password" class="form-control" required>
                            <?php echo form_error('password', '<div class="text-danger">', '</div>') ?>
						</div>
					</div>
					<div class="form-group form-action-d-flex mb-3">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="remember-me" class="custom-control-input" id="rememberme">
							<label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                        </div>
                        <?php if($redirect_to) { ?><input type="hidden" name="redirect" value="<?php echo esc($redirect_to) ?>"><?php } ?>
						<input type="submit" name="submit" value="Sign In" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">
					</div>
                </form>
			</div>
		</div>
	</div>
<?php $this->load->view('admin/includes/foot'); ?>
<?php $this->load->view('admin/includes/footEnd'); ?>