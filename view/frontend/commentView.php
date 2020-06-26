<h2>Commentaires</h2>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <p><strong><?php echo htmlspecialchars($comment['login_mail']); ?></strong> le <?php echo $comment['comment_date_fr']; ?>
        <?php
        if(isAuthentication() === true){
        ?>
        <a href="index.php?action=flag&post_id=<?= $_GET['id']?>&id=<?= $comment['id'] ?>">(Signaler)</a></p>
        <?php
        }
        ?>
        <p><?php echo htmlspecialchars($comment['comment']); ?></p>
    <?php
    }
    $comments->closeCursor();
    ?>

    <?php
    for ($i=0; $i < $nbrs / 5; $i++) { 
        if($i == $page - 1) {
            echo '<span>' . ($i + 1) . '</span>';
        }
        else {
            echo '<a href="/OCP5/index.php?action=' . $_GET['action'] . '&id=' . $_GET['id'] . '&page=' . ($i + 1) . '">' . ($i + 1) . '</a>';
        }
    }
    ?>

    <?php
    if(isAuthentication() === true) {
    ?>
        <form action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" method="post" class="formulaire">
            <div>
                <input type="hidden" name="videoType" value="<?= $_GET['action'] == "movieDetail" ? "1" : "2" ?>"/>
                <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="author_id" />
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
    <?php
    }
    ?>