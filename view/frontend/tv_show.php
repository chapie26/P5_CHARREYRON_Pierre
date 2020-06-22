<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>
<div id="tv_show"></div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script type="text/javascript" src="/OCP5/public/javascript/tv_show.js" async></script>