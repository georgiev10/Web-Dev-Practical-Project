<?php

class CommentsModel extends BaseModel{

    public function getAll($post_id){
        $statement = self::$db->prepare('SELECT * FROM comments WHERE post_id=?');
        $statement->bind_param("i", $post_id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

    public function createCommentFromUser($content, $user_id, $post_id) {
        $statement = self::$db->prepare(
            "INSERT INTO comments VALUES(NULL, ?, ?, NULL, NULL, ?, ?)");
        $statement->bind_param("ssii", $content, date("Y-m-d H:i:s"), $user_id, $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function createCommentFromVisitor($content, $visitor_name, $visitor_email, $post_id){
        $statement = self::$db->prepare(
            "INSERT INTO comments VALUES(NULL, ?, ?, ?, ?, NULL, ?)");
        $statement->bind_param("ssssi", $content, date("Y-m-d H:i:s"),
                                        $visitor_name, $visitor_email , $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function getAllCommentsByPostId($post_id){
        $statement = self::$db->prepare("
          SELECT c.id, c.content, c.date, c.visitor_name, c.visitor_email, u.username
          FROM comments c
          INNER JOIN users u ON c.user_id = u.id
          WHERE c.post_id=?
          UNION
          SELECT c.id, c.content, c.date, c.visitor_name, c.visitor_email, c.user_id
          FROM comments c
          WHERE c.user_id is null and c.post_id=?
          ORDER BY date"
        );
        $statement->bind_param("ii", $post_id, $post_id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

    public function deleteCommentsById($comment_id){
        $statement = self::$db->prepare("DELETE FROM comments WHERE id=?");
        $statement->bind_param("i", $comment_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deleteCommentsByPostId($post_id){
        $statement = self::$db->prepare("DELETE FROM comments WHERE post_id = ?");
        $statement->bind_param("i", $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function editComment($content, $comment_id){
        $statement = self::$db->prepare(
            "UPDATE comments SET content = ? WHERE id = ?");
        $statement->bind_param("si", $content, $comment_id);
        $statement->execute();
        return true;
    }

}