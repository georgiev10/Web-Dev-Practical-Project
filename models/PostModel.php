<?php

class PostModel extends BaseModel{

    public function getPostById($id) {
        $statement = self::$db->prepare("
          SELECT p.id, p.title, p.content, p.date, p.visit, u.username
          FROM posts p
          INNER JOIN users u ON p.user_id = u.id
          WHERE p.id=?"
        );
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

    public function createPost($title, $content, $user_id) {
        $statement = self::$db->prepare(
            "INSERT INTO posts VALUES(NULL, ?, ?, ?, ?, ? )");
        $visits = 0;
        $statement->bind_param("sssii", $title, date("Y-m-d H:i:s"), $content, $user_id, $visits);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function updateVisits($post_id, $visits) {
        $statement = self::$db->prepare("UPDATE posts SET visit=? WHERE id = ?");
        $statement->bind_param("ii", $visits, $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function editPost($title, $content, $post_id ) {
        $statement = self::$db->prepare(
            "UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $statement->bind_param("ssi", $title, $content, $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

}