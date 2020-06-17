<?php
session_strart();
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
            admin();
            break;
        default:
            accueil();
            break;
    }
}
catch(Exception $e) {
    getMessage($e);
}