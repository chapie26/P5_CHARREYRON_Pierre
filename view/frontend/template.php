<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./public/stylesheet/style.css" rel="stylesheet" />
    </head>

    <body>
        <nav class="navbar">
            <ul>
                <li class="align"><a href="index.php">ACCUEIL</a></li>
                <li class="align"><a href="index.php?action=movies">FILMS</a></li>
                <li class="align"><a href="index.php?action=tvShows">SÉRIES</a></li>
                <?php if(isAuthentication()): ?>
                    <?php if(isAdmin()): ?>
                        <li class="align"><a href="index.php?action=admin">Administration</a></li>
                    <?php endif; ?>
                    <li class="align"><a href="index.php?action=disconnectUser">Déconnexion</a></li>
                <?php else: ?>
                    <li class="align"><a href="index.php?action=newUser">Inscription</a></li>
                    <li class="align"><a href="index.php?action=connect">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <main class="contenu">
            <?= $content ?>
        </main>
        <script type="text/javascript" src="/OCP5/public/javascript/imdb_api.js" async></script>
    </body>
</html>