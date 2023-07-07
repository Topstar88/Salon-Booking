<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="copyrightText">Copyright © <?php echo date('Y') ?>. All Rights Reserved By <a href="<?php echo base_url() ?>"><?php echo esc($general['title']) ?></a></div>
			</div>
			<div class="col-lg-6">
				<div class="footerNav">
					<?php foreach($pages as $page) { if($page['status'] && $page['position'] >= 1) { ?>
						<a href="<?php anchor_to('page/' . $page['permalink']) ?>"><?php echo esc($page['title'], true) ?></a>
					<?php } } ?>
					<a href="<?php echo base_url('#contactUs'); ?>">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</footer>