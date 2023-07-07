<?php $uri = strtolower($this->uri->segment(1)); ?>
<header class="headerMain">
	<div class="headerMainInner <?php echo_if($uri == 'enduser' || $uri == 'userbooking', 'headerMainSticky fadeInDown animated'); ?>">
		<nav class="navbar">
			<div class="container">
				<a href="<?php echo base_url()?>" class="brandLogo"><img src="<?php $assets('images/logo.png'); ?>" alt=""></a>
				<a href="<?php echo base_url()?>" class="stickyLogo"><img src="<?php $assets('images/logo.png'); ?>" alt=""></a>
				<div class="ml-auto d-flex align-items-center">
					<div class="mainMenu">
						<ul id="myDIV">
							<li class="bdtn active"><a href="<?php echo base_url('#home'); ?>">Home</a></li>
							<li class="bdtn"><a href="<?php echo base_url('#ourServices'); ?>">Our Services</a></li>
							<li class="bdtn"><a href="<?php echo base_url('#gallery'); ?>">Gallery</a></li>
							<?php foreach($pages as $page) { if($page['status'] && ($page['position'] == 1 || $page['position'] == 3)) { ?>
								<li class="bdtn"><a href="<?php anchor_to('page/' . $page['permalink']) ?>"><?php echo esc($page['title'], true) ?></a></li>
							<?php } } ?>
							<li class="bdtn"><a href="<?php echo base_url('#contactUs'); ?>">Contact Us</a></li>
							<?php if($blogStatus['bstatus'] == 1){ ?>
								<li class="bdtn"><a href="<?php echo base_url(BLOG_CONTROLLER); ?>">Blog</a></li>
							<?php } ?>
						</ul>
						<div class="mobile-menu">
							<div class="menu-click">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>
					</div>
					<?php if($this->session->userdata('id')){ ?>
						<div class="btn-group">
							<button type="button" class="btn loginBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="<?php echo base_url('userbooking'); ?>" class="dropdown-item" type="button">Your Bookings</a>
								<a href="<?php echo base_url('enduser'); ?>" class="dropdown-item" type="button">Profile Settings</a>
								<a href="<?php echo base_url('enduser/logout'); ?>" class="dropdown-item" type="button">Logout</a>
							</div>
						</div>
					<?php }  else{ ?>
							<a href="<?php echo base_url('login'); ?>" class="loginBtn">Login</a>
					<?php } ?>
				</div>
			</div>
		</nav>
	</div>

</header>