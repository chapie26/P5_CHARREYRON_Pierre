<?php

namespace model;

class Manager {
    protected function dbConnect() {
        $db = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root');
        return $db;
    }
}