<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>

<h1>HELLO THE WORLD!!!!!!!!!!!</h1>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>