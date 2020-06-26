<?php
session_start();
require('controller/frontend.php');

try {
    switch($_GET['action']) {
        case 'accueil':
            accueil();
            break;
        case 'newUser':
            newUser();
            break;
        case 'addUser':
            addUser();
            break;
        case 'connectUser':
            connectUser();
            break;
        case 'disconnectUser':
            disconnectUser();
            break;
        case 'connect':
            connect();
            break;
        case 'admin':
            administration();
            break;
        case 'movies':
            movies();
            break;
        case 'tvShows':
            tvShows();
            break;
        case 'tvShowDetail':
            tvShowDetail();
            break;
        case 'movieDetail':
            movieDetail();
            break;
        case 'addComment':
            addComment();
            break;
        case 'flag':
            isFlag();
            break;
        case 'deleteComment':
            commentDeleted();
            break;
        case 'validComment':
            commentValided();
            break;
        default:
            accueil();
            break;
    }
}
catch(Exception $e) {
    getMessage($e);
}