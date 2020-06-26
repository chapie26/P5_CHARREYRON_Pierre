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
                if (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
                    $newMember = $user->register($_POST['pseudo'], $_POST['pass'], 'public/upload/image/'.basename("file".time().".".$extension));
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
            else {
                throw new Exception ('Le fichier n\'a pas l\'extension autoriser');
            }
        }
        else {
            throw new Exception ('Le fichier est trop gros');
        }
    }
    elseif (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
        $newMember = $user->register($_POST['pseudo'], $_POST['pass'], null);
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
        $_SESSION['avatar'] = $connectMember['avatar_name'];
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
    $comment = new Comment();
    if (isAdmin()) {
        $flags = $comment->flagedComments();

        require('view/frontend/administration.php');
    }
    else {
        throw new Exception('Vous n\'avez pas les droits admin pour accéder à cette page');
    }
}

function addComment() {
    $comment = new Comment();
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author_id']) && !empty($_POST['comment'])) {
            $affectedLines = $comment->postComment($_POST['videoType'], $_GET['id'], $_POST['author_id'], $_POST['comment']);

            if (!$affectedLines) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: index.php?action=post&id=' . $_GET['id']);
            }
        }
        else {
            throw new Exception( 'Tous les champs ne sont pas remplis !');
        }
    }
    else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

function isFlag() {
    $comment = new Comment();
    $flag = $comment->flagComment($_GET["id"]);
    header('Location: index.php');
}

function commentDeleted() {
    $comment = new Comment();

    if (isAdmin() && isset($_GET['id']) && $_GET['id'] > 0) {
        $deletePost = $comment->deleteComment($_GET['id']);

        header('Location: index.php');
    }
    else {
        throw new Exception ('Impossible de supprimer le commentaire');
    }
}

function commentValided() {
    $comment = new Comment();

    if (isAdmin() && isset($_GET['id']) && $_GET['id'] > 0) {
        $noFlag = $comment->validComment($_GET['id']);
        header('Location: index.php');
    }
    else {
        throw new Exception ('Impossible d\'enlever le signalement du commentaire' );
    }
}

function accueil() {
    require('view/frontend/accueil.php');
}

function movies() {
    require('view/frontend/movie.php');
}

function tvShows() {
    require('view/frontend/tv_show.php');
}

function tvShowDetail() {
    $comment = new Comment();

    if(!isset($_GET['id']) || $_GET['id'] <= 0) throw new Exception ('Pas d\'id de film' );
    $imageUrl = 'http://image.tmdb.org/t/p/w185';
    $credits = getCredits("tv", $_GET["id"]);
    $data = getDetails("tv", $_GET["id"]);
    $nbrs = $comment->nbrComments(1, intVal($_GET['id']));
    $page = isset($_GET['page']) ? intVal($_GET['page']) : 1;
    $comments = $comment->getCommentsByPage(2, intVal($_GET['id']), $page);
    require('view/frontend/tv_showDetail.php');
}

function movieDetail() {
    $comment = new Comment();

    if(!isset($_GET['id']) || $_GET['id'] <= 0) throw new Exception ('Pas d\'id de film' );
    $imageUrl = 'http://image.tmdb.org/t/p/w185';
    $credits = getCredits("movie", $_GET["id"]);
    $data = getDetails("movie", $_GET["id"]);
    $nbrs = $comment->nbrComments(1, intVal($_GET['id']));
    $page = isset($_GET['page']) ? intVal($_GET['page']) : 1;
    $comments = $comment->getCommentsByPage(1, intVal($_GET['id']), $page);
    require('view/frontend/movieDetail.php');
}

function getMessage($e) {
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}

// ********************************************
// * ------------PRIVATE FUNCTION------------ *
// ********************************************

function getDetails($type, $imdb_id) {
    $burl = "https://api.themoviedb.org/3/";
    $api_key = "76cebbae31140d094e15deb2671b11a6";
    $language = "fr";
    $responseDetail = file_get_contents($burl . $type . "/" . $imdb_id . "?api_key=" . $api_key . "&language=" . $language);
    $data = json_decode($responseDetail);
    return $data;
}

function getCredits($type, $imdb_id) {
    $burl = "https://api.themoviedb.org/3/";
    $api_key = "76cebbae31140d094e15deb2671b11a6";
    $language = "fr";
    $responseCredit = file_get_contents($burl . $type . "/" . $imdb_id . "/credits?api_key=" . $api_key . "&language=" . $language);
    $credits = json_decode($responseCredit);
    return $credits;
}