<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>

<h1><?= $data->name ?></h1>
<div id='tvshowDetail'>
    <img id="img" src="<?= $imageUrl . $data->poster_path ?>">
    <div id='info'>
        <p><?php for ($index = 0; $index < count($data->genres); $index++) { ?>
            <b><?= $data->genres[$index]->name ?></b>
            <?= $index === count($data->genres) - 1 ? '' : ',' ?>
            <?php } ?>
        </p>
        <p><?= $data->vote_average ?>/10 sur <?= $data->vote_count ?> notes.</p>
        <p><span>De</span>
            <?php for ($index = 0; $index < count($data->created_by); $index++) { ?>
            <?= $data->created_by[$index]->name ?><?=$index === count($data->created_by) - 1 ? '' : ',' ?>
            <?php } ?>
        </p>
        <p><span>Avec</span>
            <?php for ($index = 0; $index < 3 && $index < count($credits->cast); $index++) { ?>
            <?= $credits->cast[$index]->name ?><?= $index === '3' - 1 ? '' : ',' ?>
            <?php } ?>
        </p>
        <p><span>Nationalité</span>
            <?php for ($index = 0; $index < count($data->origin_country); $index++) { ?>
            <?= $data->origin_country[$index]?>
            <?= $index === count($data->origin_country) - 1 ? '' : ',' ?>
            <?php } ?>
        </p>
    </div>
</div>
<p id="synopsis"><?= $data->overview ?></p>
<div id="seasons-episode">
    <div id="seasons">
        <?php for ($index = 0; $index < count($data->seasons); $index++) { ?>
        <a class="button" season="<?= $data->seasons[$index]->season_number ?>"> <?= $data->seasons[$index]->name ?> </a>
        <?php } ?>
    </div>
    <div id="episodes"></div>
</div>
    <div>
    <h2>ACTEURS ET ACTRICES</h2>
    <div id="portrait">
      <?php for ($index = 0; $index < 8 && $index < count($credits->cast); $index++) { ?>
          <div id="imgName">
            <?php if ($credits->cast[$index]->profile_path != null) { ?>
            <img id="imgPortrait" src="<?= $imageUrl . $credits->cast[$index]->profile_path ?>">
            <?php } else { ?>
                <img id="notFoundActeur" src="public/images/avatar_default.png">
            <?php } ?>
            <h3><?= $credits->cast[$index]->name ?></h3>
            <h4><?= $credits->cast[$index]->character ?></h4>
          </div>
      <?php } ?>
          </div>
    </div>

<?php require('commentView.php'); ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<script type="text/javascript" src="/OCP5/public/javascript/tv_showDetail.js" async></script>