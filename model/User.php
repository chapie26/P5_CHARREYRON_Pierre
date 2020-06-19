<?php

namespace model;

require('vendor/autoload.php');
use model\Manager;

class User extends Manager {
    public function register($pseudo, $pass, $avatar_name) {
        // Ajouter controle pas de doublon
        $db = $this->dbConnect();
        $verif = $db->prepare('SELECT * FROM member WHERE pseudo = ?');
        $verif->execute(array($pseudo));
        $member = $verif->fetch();

        if ($member) {
            return null;
        }
        else {
            $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $regist = $db->prepare('INSERT INTO member (pseudo, pass, admin, avatar_name) VALUES (?,?,0,?)');
            $newMember = $regist->execute(array($pseudo, $pass_hash, $avatar_name));
            return $newMember;
        }
    }
    public function signin($pseudo, $pass) {
        $db = $this->dbConnect();
        $login = $db->prepare('SELECT * FROM member WHERE pseudo = ?');
        $login->execute(array($pseudo));
        $member = $login->fetch();
        if (password_verify($_POST['pass'], $member['pass'])){
            return $member;
        }
        return false;
    }
}