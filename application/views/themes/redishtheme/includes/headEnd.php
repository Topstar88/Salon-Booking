
</head>
<?php $uri = strtolower($this->uri->segment(1)); ?>
<body class="<?php echo_if($uri == 'enduser' || $uri == 'userbooking', 'endUserBody')?>">