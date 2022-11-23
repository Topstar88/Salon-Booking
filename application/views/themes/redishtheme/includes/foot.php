<script src="<?php $assets("js/jquery.min.js"); ?>"></script>
<script src="<?php $assets("js/popper.min.js"); ?>"></script>
<script src="<?php $assets("js/bootstrap.min.js"); ?>"></script>
<script src="<?php $assets("js/bootstrap-input-spinner.js"); ?>"></script>
<script src="<?php $assets("js/isotope.pkgd.min.js"); ?>"></script>
<script src="<?php $assets("js/app.js"); ?>"></script>
<?php if(isset($load_scripts)) { foreach($load_scripts as $src) { ?>
        <script type="text/javascript" src="<?php echo esc($src) ?>"></script>
<?php } } 
?>