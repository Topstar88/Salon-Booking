<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection loginPages" id="home">
        <div class="<?php echo_if($ads['top']['status'], 'p-b-40') ?>">
			<?php $theme_view('includes/top-ad') ?>
		</div>
		<div class="container">
            <div class="selectionBoxMain">
                <h1 class="loginSignupTitle m-b-40"><?php echo esc($page['title'], true) ?></h1>
                <div class="pagesText">
                    <?php echo esc($page['content'], true); ?>
                </div>
            </div>
        </div>
        <div class="<?php echo_if($ads['bottom']['status'], 'p-t-25') ?>">
			<?php $theme_view('includes/bottom-ad') ?>
		</div>
	</div>
	<!-- /mainSection -->
	
<?php $theme_view('includes/footer'); ?>
<?php $theme_view('includes/foot'); ?>

<?php $theme_view('includes/footEnd'); ?>