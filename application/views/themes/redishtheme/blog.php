<?php $theme_view('includes/head'); ?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection loginPages" id="home">
        <div class="<?php echo_if($ads['top']['status'], 'p-b-40') ?>">
			<?php $theme_view('includes/top-ad') ?>
		</div>
		<div class="container">
            <div class="selectionBoxMain">
                <h1 class="loginSignupTitle m-b-40">Salon Blog</h1>
                <div class="pagesText">
                    <div class="row">
                        <?php foreach($blogList as $blist){ if($blist['status'] == 1){ ?>
                        <div class="col-md-4">
                            <div class="card card-product blogCard" data-count="4">
                                <div class="card-header card-header-image">
                                    <a href="<?php anchor_to(BLOG_CONTROLLER.'/'.$blist['permalink']) ?>" style="background-image:url(<?php uploads('img/blog/'.$blist['image']); ?>);"></a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="<?php anchor_to(BLOG_CONTROLLER.'/'.$blist['permalink']) ?>"><?php echo word_limiter(esc($blist['title'], true), 8) ?></a>
                                    </h4>
                                    <div class="card-description"><?php echo word_limiter(esc($blist['description'], true), 17) ?></div>
                                </div>
                                <div class="card-footer">
                                    <div class="left">
                                        <p class="cardDate">
                                            <i class="icon-calendar"></i> <?php
                                                    if($blist['datetime_updated'] != $blist['datetime_added']){echo esc($blist['datetime_updated'], true);}else{echo esc($blist['datetime_added'], true);}
                                                ?>
                                        </p>
	                                </div>
                                    <div class="left">
                                        <a href="<?php anchor_to(BLOG_CONTROLLER.'/'.$blist['permalink']) ?>" class="moreLink">More <i class="icon-cheveron-right"></i></a>
                                    </div>
                                </div>
                            </div><!-- .blogCard -->
                        </div><!-- .col-md-4 -->
                        <?php } } ?>
                    </div><!-- .row -->
                    
                    <?php echo  $this->pagination->create_links(); ?>
                </div><!-- .pagesText -->
            </div><!-- .selectionBoxMain -->
        </div>
        <div class="<?php echo_if($ads['bottom']['status'], 'p-t-25') ?>">
			<?php $theme_view('includes/bottom-ad') ?>
		</div>
	</div>
	<!-- /mainSection -->
	
<?php $theme_view('includes/footer'); ?>
<?php $theme_view('includes/foot'); ?>

<?php $theme_view('includes/footEnd'); ?>