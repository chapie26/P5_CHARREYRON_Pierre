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
            <ol>
                <?php if(isAuthentication()): ?>
                    <?php if(isAdmin()): ?>
                        <li><a href="index.php?action=admin">Administration</a></li>
                    <?php endif; ?>
                    <li><a href="index.php?action=disconnectUser">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="index.php?action=newUser">Inscription</a></li>
                    <li><a href="index.php?action=connect">Connexion</a></li>
                <?php endif; ?>
            </ol>
            <ol>
                <li><a href="index.php?action=movies">FILMS</a></li>
                <li><a href="index.php?action=tvShows">SÉRIES</a></li>
                <li><a href="index.php">ACCUEIL</a></li>
            </ol>
        </nav>
        <main class="contenu">
            <?= $content ?>
        </main>
        <script type="text/javascript" src="/OCP5/public/javascript/imdb_api.js" async></script>
    </body>
</html>