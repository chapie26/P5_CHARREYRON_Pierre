<?php
session_start();
require('controller/frontend.php');

try {
    switch($_GET['action']) {
        case 'newUser';
            newUser();
            break;
        case 'addUser';
            addUser();
            break;
        case 'connectUser';
            connectUser();
            break;
        case 'disconnectUser';
            disconnectUser();
            break;
        case 'connect';
            connect();
            break;
        case 'admin';
            isAdmin();
            break;
        default:
            accueil();
            break;
    }
}
catch(Exception $e) {
    getMessage($e);
}