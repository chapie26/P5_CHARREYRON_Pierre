<?php

require_once('model/Comment.php');
require_once('model/User.php');

function newUser() {
    require('view/frontend/registration.php');
}

function addUser() {
    $user = new Chapie\Blog\model\User();
    if (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
        $newMember = $user->register($_POST['pseudo'], $_POST['pass']);
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
    $member = new Chapie\Blog\model\User();

    $connectMember = $member->signin($_POST['pseudo'], $_POST['pass']);
    if (!$connectMember){
        throw new Exception('Connexion impossible');
    }
    else {
        $_SESSION['admin'] = $connectMember['admin'];
        $_SESSION['pseudo'] = $connectMember['login_mail'];
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
    $commentManager = new Chapie\Blog\model\CommentManager();
    if (isAdmin()) {
        $flags = $commentManager->flagedComments();

        require('view/frontend/administration.php');
    }
    else {
        throw new Exception('Vous n\'avez pas les droits admin pour accéder à cette page');
    }
}

function isFlag() {
    $commentManager = new Chapie\Blog\model\CommentManager();
    $flag = $commentManager->flagComment($_GET["post_id"], $_GET["id"]);
    header('Location: index.php');
}

function commentDeleted() {
    $commentManager = new Chapie\Blog\model\CommentManager();

    if (isAdmin() && isset($_GET['id']) && $_GET['id'] > 0) {
        $deletePost = $commentManager->deleteComment($_GET['id']);

        header('Location: index.php');
    }
    else {
        throw new Exception ('Impossible de supprimer le commentaire');
    }
}

function commentValided() {
    $commentManager = new Chapie\Blog\model\CommentManager();

    if (isAdmin() && isset($_GET['id']) && $_GET['id'] > 0) {
        $noFlag = $commentManager->validComment($_GET['id']);
        header('Location: index.php');
    }
    else {
        throw new Exception ('Impossible d\'enlever le signalement du commentaire' );
    }
}

function getMessage($e) {
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}