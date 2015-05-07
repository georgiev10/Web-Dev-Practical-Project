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

    public function deleteCommentsById($comment_id){
        $statement = self::$db->prepare("DELETE FROM comments WHERE id=?");
        $statement->bind_param("i", $comment_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

}