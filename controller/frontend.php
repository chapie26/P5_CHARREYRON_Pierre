<?php

require('vendor/autoload.php');
use model\Comment;
use model\User;

function newUser() {
    require('view/frontend/registration.php');
}

function addUser() {
    $user = new User();
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        if($_FILES['file']['size'] <= 10240) {
            $info = pathinfo($_FILES['file']['name']);
            $extension = $info['extension'];
            $extension_autoriser = array('bmp', 'png', 'gif', 'jpg', 'jpeg');
            if(in_array($extension, $extension_autoriser)) {
                move_uploaded_file($_FILES['file']['tmp_name'], 'public/upload/image/'.basename("file".time().".".$extension));
            }
            else {
                throw new Exception ('Le fichier n\'a pas l\'extension autoriser');
            }
        }
        else {
            throw new Exception ('Le fichier est trop gros');
        }
    }
    else {
        throw new Exception ('Le formulaire n\'est pas rempli ou une erreur est survenu');
    }
    if (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
        $newMember = $user->register($_POST['pseudo'], $_POST['pass'], $_POST['avatar_name']);
        if ($newMember === null || !$newMember) {
            throw new Exception('Login déjà utilisé');
        }
        else {
            require('view/frontend/connection.php');
        }
    }
    else {
        throw new Exception ('Impossible d\'ajouter le membre!');
    }
}

function connectUser() {
    $user = new User();

    $connectMember = $user->signin($_POST['pseudo'], $_POST['pass']);
    if (!$connectMember){
        throw new Exception('Connexion impossible');
    }
    else {
        $_SESSION['admin'] = $connectMember['admin'];
        $_SESSION['pseudo'] = $connectMember['pseudo'];
        $_SESSION['user_id'] = $connectMember['id'];
        header('Location: index.php');
    }
}

function disconnectUser() {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}

function connect() {
    require('view/frontend/connection.php');
}

function isAdmin() {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
        return true;
    }
    else {
        return false;
    }
}

function isAuthentication() {
    if (isset($_SESSION['pseudo'])) {
        return true;
    }
    else {
        return false;
    }
}

function administration() {
    $commentManager = new CommentManager();
    if (isAdmin()) {
        $flags = $commentManager->flagedComments();

        require('view/frontend/administration.php');
    }
    else {
        throw new Exception('Vous n\'avez pas les droits admin pour accéder à cette page');
    }
}

function isFlag() {
    $commentManager = new CommentManager();
    $flag = $commentManager->flagComment($_GET["post_id"], $_GET["id"]);
    header('Location: index.php');
}

function commentDeleted() {
    $commentManager = new CommentManager();

    if (isAdmin() && isset($_GET['id']) && $_GET['id'] > 0) {
        $deletePost = $commentManager->deleteComment($_GET['id']);

        header('Location: index.php');
    }
    else {
        throw new Exception ('Impossible de supprimer le commentaire');
    }
}

function commentValided() {
    $commentManager = new CommentManager();

    if (isAdmin() && isset($_GET['id']) && $_GET['id'] > 0) {
        $noFlag = $commentManager->validComment($_GET['id']);
        header('Location: index.php');
    }
    else {
        throw new Exception ('Impossible d\'enlever le signalement du commentaire' );
    }
}

function accueil() {
    require('view/frontend/accueil.php');
}

function getMessage($e) {
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}