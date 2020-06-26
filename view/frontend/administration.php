<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>

<div clas="flag">
    <h3>Commentaires signalés</h3>
    <?php
    while ($flag = $flags->fetch()) {
    ?>
        <p><strong><?php echo htmlspecialchars($flag['login_mail']); ?></strong> le <?php echo $flag['comment_date_fr']; ?>(<a href="index.php?action=deleteComment&amp;id=<?= $flag['id']; ?>">Supprimer</a> / <a href="index.php?action=validComment&id=<?= $flag['id'] ?>">Valider</a>)</p>
        <p><?php echo htmlspecialchars($flag['comment']); ?></p>
    <?php
    }
    $flags->closeCursor();
    ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>