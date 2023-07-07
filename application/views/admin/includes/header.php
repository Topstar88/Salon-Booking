<div class="logo-header position-fixed" data-background-color="white">
	<a href="<?php anchor_to(GENERAL_CONTROLLER . '/settings') ?>" class="logo">
		<img src="<?php uploads('img/' . $page_data['general']['logo']) ?>" alt="navbar brand" class="navbar-brand">
	</a>
	<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon">
			<i class="icon-menu"></i>
		</span>
	</button>
	<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
		<div class="nav-toggle">
			<button class="btn btn-toggle toggle-sidebar">
				<i class="icon-menu"></i>
			</button>
		</div>
	</button>
</div>