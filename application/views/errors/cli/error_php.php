<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

A PHP Error was encountered

Severity:    <?php echo esc($severity, true), "\n"; ?>
Message:     <?php echo esc($message, true), "\n"; ?>
Filename:    <?php echo esc($filepath, true), "\n"; ?>
Line Number: <?php echo esc($line, true); ?>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

Backtrace:
<?php	foreach (debug_backtrace() as $error): ?>
<?php		if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
	File: <?php echo esc($error['file'], true), "\n"; ?>
	Line: <?php echo esc($error['line'], true), "\n"; ?>
	Function: <?php echo esc($error['function'], true), "\n\n"; ?>
<?php		endif ?>
<?php	endforeach ?>

<?php endif ?>
