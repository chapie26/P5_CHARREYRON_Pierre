<?php

namespace model;

require('vendor/autoload.php');
use model\Manager;

class Comment extends Manager {
    public function getComments($type, $movieId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT comments.id , comments.videoType, comments.movie_id, comments.author_id, comments.comment, member.pseudo AS login_mail, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments INNER JOIN member ON author_id = member.id WHERE videoType = ? AND movie_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($type, $movieId));

        return $comments;
    }

    public function getCommentsByPage($type, $movieId, $page) {
        $start = ($page - 1) * 5;
        $db = $this->dbConnect();
        $nbrComments = $db->prepare('SELECT comments.id , comments.videoType, comments.movie_id, comments.author_id, comments.comment, member.pseudo AS login_mail, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments INNER JOIN member ON author_id = member.id WHERE videoType = :type AND movie_id = :movieId ORDER BY comment_date DESC LIMIT 5 OFFSET :offset');
        $nbrComments->bindValue('type', $type, \PDO::PARAM_INT);
        $nbrComments->bindValue('movieId', $movieId, \PDO::PARAM_INT);
        $nbrComments->bindValue('offset', $start, \PDO::PARAM_INT);
        $nbrComments->execute();

        return $nbrComments;
    }

    public function postComment($type, $movieId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments (videoType, movie_id, author_id, comment, comment_date) VALUES (?,?,?,?, NOW())');
        $affectedLines = $comments->execute(array(intval($type), intval($movieId), intval($author), $comment));
        return $affectedLines;
    }

    public function flagComment($id) {
        $db = $this->dbConnect();
        $flag = $db->prepare('UPDATE comments SET flag = 1 WHERE id = ?');
        $flag->execute(array(intval($id)));

        return $flag;
    }

    public function flagedComments() {
        $db = $this->dbConnect();
        $commentsFlag = $db->prepare('SELECT comments.id ,comments.author_id, comments.comment, member.pseudo AS login_mail, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments INNER JOIN member ON author_id = member.id WHERE flag = 1 ORDER BY comment_date DESC');
        $commentsFlag->execute(array());

        return $commentsFlag;
    }

    public function deleteComment($id) {
        $db = $this->dbConnect();
        $commentDeleted = $db->prepare('DELETE FROM comments WHERE id = ?');
        $commentDeleted->execute(array($id));
        $deleteFlag = $commentDeleted->fetch();

        return $deleteFlag;
    }

    public function validComment($id) {
        $db = $this->dbConnect();
        $flagDeleted = $db->prepare('UPDATE comments SET flag = 0 WHERE id = ?');
        $flagDeleted->execute(array(intval($id)));

        return $flagDeleted;
    }

    public function nbrComments($type, $movieId) {
        $db = $this->dbConnect();
        $nbrs = $db->prepare('SELECT COUNT(*) FROM comments WHERE videoType = ? AND movie_id = ?');
        $nbrs->execute(array($type, $movieId));
        $total = $nbrs->fetchColumn();

        return $total;
    }
}