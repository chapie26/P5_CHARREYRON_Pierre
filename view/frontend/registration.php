<?php $title = 'INFOCINE'; ?>

<?php ob_start(); ?>
<div class="formulaire">
    <h2>INSCRIPTION</h2>
    <p>Veuillez remplir les champs suivant afin de vous inscrire. Si vous avez déjà un compte vous pouvez vous <a href="index.php?action=connect" >CONNECTER</a></p>

    <form action="index.php?action=addUser" id="myForm" method="post" enctype="multipart/form-data">
        <div>
            <label for="pseudo">Pseudo/Email</label><br />
            <input type="text" id="pseudo" name="pseudo" />
        </div>
        <div>
            <label for="pass">Mot de passe</label><br />
            <input type="password" id="pass" name="pass" />
        </div>
        <div>
            <label for="file">Avatar</label><br />
            <input type="file" id="file" name="file" />
        </div>
        <div>
            <input type="submit" id="valid" />
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<script type="text/javascript" src="/OCP5/public/javascript/registration.js"></script>