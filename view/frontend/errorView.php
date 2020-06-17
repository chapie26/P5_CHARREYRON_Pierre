<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>
<h1>
    <?php
        echo 'Erreur : ' . $errorMessage
    ?>
</h1>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>