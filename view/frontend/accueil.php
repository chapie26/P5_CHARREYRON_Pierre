<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>

<h1>HELLO THE WORLD!!!!!!!!!!!</h1>
<?php
if(isAuthentication()) {
    if($_SESSION['avatar'] !== null) {
        echo '<p class="messagePerso"><img src=" ' . $_SESSION['avatar'] . ' " alt"avatar"><h3>Bonjour ' . $_SESSION['pseudo'] . ' et bienvenu sur mon site de critique communautaire =)</h3></p>';
    }
    else {
        echo '<p class="messagePerso"><img src="public/images/avatar_default.png" alt"avatar"><h3>Bonjour ' . $_SESSION['pseudo'] . ' et bienvenu sur mon site de critique communautaire =)</h3></p>';
    }
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>