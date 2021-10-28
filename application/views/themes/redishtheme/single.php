<?php $theme_view('includes/head'); ?>
<?php
if($comment_settings['active_plugin'] == 1) {
	?>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=<?php echo esc($comment_settings['facebook_app_id'], true); ?>&autoLogAppEvents=1" nonce="yOkzzrGk"></script>
	<?php
}
?>
<?php $theme_view('includes/headEnd'); ?>
<?php $theme_view('includes/header'); ?>
	
	<div class="mainSection loginPages" id="home">
        <div class="<?php echo_if($ads['top']['status'], 'p-b-40') ?>">
			<?php $theme_view('includes/top-ad') ?>
		</div>
		<div class="container">
            <div class="selectionBoxMain">
                <div class="singlePost">
                    <div class="singlePostImageMain"><div class="singlePostImage" style="background-image:url(<?php uploads('img/blog/'.$post['image']); ?>);"></div></div>
                    <h3><a href="#pablo"><?php echo esc($post['title'], true) ?></a></h3>
                    <div class="singlePostDate"><i class="icon-calendar"></i> <?php if($post['datetime_updated'] != $post['datetime_added']){echo esc('Updated on: '.$post['datetime_updated'], true);}else{echo esc($post['datetime_added'], true);} ?></div>
                    <div class="singlePostDesc"><?php echo esc($post['description'], true) ?></div>
                    <hr>
                    <div class="singleImageSocial">
                        <button id="fb-share" class="singleImgShareIcon iconFb border-0">
                            <i class="icon-facebook"></i>
                        </button>
                        <button id="tw-share" class="singleImgShareIcon iconTwt border-0">
                            <i class="icon-twitter"></i>
                        </button>
                        <button id="ld-share" class="singleImgShareIcon btn-linkedin border-0">
                            <i class="icon-linkedin2"></i>
                        </button>
                        <button id="vk-share" class="singleImgShareIcon btn-vk border-0">
                            <i class="icon-vk"></i>
                        </button>
                        <button id="rd-share" class="singleImgShareIcon iconRdt border-0">
                            <i class="icon-reddit"></i>
                        </button>
                        <button id="wp-share" class="singleImgShareIcon btn-success border-0">
                            <i class="icon-whatsapp"></i>
                        </button>
                    </div>
                    <hr />
                    <h4>Leave Comment</h4>
                    <div>
						<?php
						if($comment_settings['active_plugin'] == 1) {
							?>
							<div class="fb-comments" data-href="<?php echo currentURL(); ?>" data-numposts="5" data-width="100%"></div>
							<?php
						}
						else {
							?>
							<div id="disqus_thread"></div>
							<script>
								var disqus_config = function () {
									this.page.url = '<?php echo currentURL(); ?>';
									this.page.identifier = '<?php echo esc($permalink, true); ?>';
								};
								(function() {
									var d = document, s = d.createElement('script');
									s.src = 'https://<?php echo esc($comment_settings["disqus_short_name"], true); ?>.disqus.com/embed.js';
									s.setAttribute('data-timestamp', +new Date());
									(d.head || d.body).appendChild(s);
								})();
							</script>
							<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
							<?php
						}
						?>
					</div>
                </div><!-- .singlePost -->
                
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