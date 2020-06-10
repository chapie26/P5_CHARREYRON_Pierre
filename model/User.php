<?php

namespace Chapie\Blog\model;

require_once('model/Manager.php');

class User extends Manager {
    public function register($pseudo, $pass) {
        // Ajouter controle pas de doublon
        $db = $this->dbConnect();
        $regist = $db->prepare('SELECT * FROM member WHERE pseudo = ?');
        $regist->execute(array($login_mail));
        $member = $regist->fetch();

        if ($member) {
            return null;
        }
        else {
            $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $regist = $db->prepare('INSERT INTO member (pseudo, pass, admin) VALUES (?,?,0)');
            $newMember = $regist->execute(array($pseudo, $pass_hash));
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