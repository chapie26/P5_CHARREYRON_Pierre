<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>
<div id="movie"></div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<script type="text/javascript" src="/OCP5/public/javascript/movie.js" async></script>