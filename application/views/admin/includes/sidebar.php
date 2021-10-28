<?php $uri = strtolower($this->uri->segment(1).'/'.$this->uri->segment(2)); ?>
<div class="sidebar sidebar-style-2" data-background-color="white">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item <?php echo_if($uri == GENERAL_CONTROLLER . '/dashboard', 'active'); ?>">
							<a href="<?php anchor_to(GENERAL_CONTROLLER . '/dashboard') ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item <?php echo_if($uri == GENERAL_CONTROLLER . '/settings', 'active'); ?>">
							<a href="<?php anchor_to(GENERAL_CONTROLLER . '/settings') ?>">
								<i class="fas fa-cog"></i>
								<p>General Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == GENERAL_CONTROLLER . '/themes' || $uri == GENERAL_CONTROLLER . '/upload_theme', 'active'); ?>">
							<a href="<?php anchor_to(GENERAL_CONTROLLER . '/themes') ?>">
								<i class="fas fa-brush"></i>
								<p>Themes</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Bookings</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == BOOKINGS_CONTROLLER . '/', 'active'); ?>">
							<a href="<?php anchor_to(BOOKINGS_CONTROLLER) ?>">
								<i class="far fa-credit-card"></i>
								<p>All Bookings</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Services</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == SERVICE_CONTROLLER . '/services' || $uri == SERVICE_CONTROLLER . '/addservice' || $uri == SERVICE_CONTROLLER . '/editservice', 'active'); ?>">
							<a href="<?php anchor_to(SERVICE_CONTROLLER) ?>">
								<i class="fas fa-shopping-basket"></i>
								<p>All Services</p>
							</a>
						</li>
						<li class="nav-item <?php echo_if($uri == AGENTS_CONTROLLER . '/' || $uri == AGENTS_CONTROLLER . '/addagent' || $uri == AGENTS_CONTROLLER . '/editagent', 'active'); ?>">
							<a href="<?php anchor_to(AGENTS_CONTROLLER) ?>">
								<i class="fas fa-users"></i>
								<p>All Agents</p>
							</a>
						</li>
						<li class="nav-item <?php echo_if($uri == CONTACT_CONTROLLER . '/contactdetails', 'active'); ?>">
							<a href="<?php anchor_to(CONTACT_CONTROLLER) ?>">
								<i class="fas fa-address-card"></i>
								<p>Contact Settings</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Gallery</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == GALLERY_CONTROLLER . '/categories', 'active'); ?>">
							<a href="<?php anchor_to(GALLERY_CONTROLLER. '/categories') ?>">
								<i class="fas fa-image"></i>
								<p>Gallery Category</p>
							</a>
						</li>
						<li class="nav-item <?php echo_if($uri == GALLERY_CONTROLLER . '/listgallery' || $uri == GALLERY_CONTROLLER . '/addimg' || $uri == GALLERY_CONTROLLER . '/editimg', 'active'); ?>">
							<a href="<?php anchor_to(GALLERY_CONTROLLER) ?>">
								<i class="fas fa-image"></i>
								<p>Gallery Images</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Blog</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == ADMINBLOG_CONTROLLER, 'active'); ?>">
							<a href="<?php anchor_to(ADMINBLOG_CONTROLLER) ?>">
								<i class="fas fa-th-large"></i>
								<p>Blog Posts</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Layout Settings</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/social_keys', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/social_keys') ?>">
								<i class="fas fa-key"></i>
								<p>Social Login Keys</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/pages', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/pages') ?>">
								<i class="fas fa-layer-group"></i>
								<p>Page Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/analytics', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/analytics') ?>">
								<i class="fas fa-chart-bar"></i>
								<p>Analytics Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/meta_tags', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/meta_tags') ?>">
								<i class="fas fa-code"></i>
								<p>Meta Tags Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/email', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/email') ?>">
								<i class="fas fa-at"></i>
								<p>E-Mail Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/comment_settings', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/comment_settings') ?>">
								<i class="fas fa-comments"></i>
								<p>Comment Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/recaptcha', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/recaptcha') ?>">
								<i class="fas fa-unlock"></i>
								<p>Recaptcha Settings</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == LAYOUT_CONTROLLER . '/ads', 'active'); ?>">
							<a href="<?php anchor_to(LAYOUT_CONTROLLER . '/ads') ?>">
								<i class="fas fa-expand"></i>
								<p>Ad Settings</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Admin</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == ACCOUNT_CONTROLLER . '/me', 'active'); ?>">
							<a href="<?php anchor_to(ACCOUNT_CONTROLLER . '/me') ?>">
								<i class="fas fa-user"></i>
								<p>My Account</p>
							</a>
						</li>
						<li class="nav-item <?php echo_if($uri == CLIENTS_CONTROLLER . '/index', 'active'); ?>">
							<a href="<?php anchor_to(CLIENTS_CONTROLLER) ?>">
								<i class="fas fa-users"></i>
								<p>Clients</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Orders/Payments</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == PAYMENTS_CONTROLLER . '/', 'active'); ?>">
							<a href="<?php anchor_to(PAYMENTS_CONTROLLER) ?>">
								<i class="far fa-credit-card"></i>
								<p>All Payments</p>
							</a>
						</li>
						<li class="nav-item <?php echo_if($uri == PAYMENTS_CONTROLLER . '/stripe', 'active'); ?>">
							<a href="<?php anchor_to(PAYMENTS_CONTROLLER . '/stripe') ?>">
								<i class="fab fa-stripe"></i>
								<p>Stripe Settings</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Other</h4>
                        </li>
						<li class="nav-item <?php echo_if($uri == UPDATES_CONTROLLER . '/main', 'active'); ?>">
							<a href="<?php anchor_to(UPDATES_CONTROLLER . '/main') ?>">
								<i class="fas fa-wrench"></i>
								<p>Script Updates</p>
							</a>
                        </li>
						<li class="nav-item <?php echo_if($uri == GENERAL_CONTROLLER . '/purge_cache', 'active'); ?>">
							<a href="<?php anchor_to(GENERAL_CONTROLLER . '/purge_cache') ?>">
								<i class="fas fa-trash-alt"></i>
								<p>Purge Cache</p>
							</a>
                        </li>
                        
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->