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
        return self::$db->insert_id;
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
        return true;// $statement->affected_rows > 0;
    }

    public function getIdExistingTag($tag){
        $statement = self::$db->prepare("
          SELECT id FROM tags WHERE tag=?"
        );
        $statement->bind_param("s", $tag);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result[0][0];
    }

    public function insertTags($tag) {
        $statement = self::$db->prepare(
            "INSERT INTO tags VALUES(NULL, ?)");
        $statement->bind_param("s", $tag);
        $statement->execute();
        return self::$db->insert_id;
    }

    public function insertTagsByPost($tag_id, $post_id ){
        $statement = self::$db->prepare(
            "INSERT INTO posts_tags VALUES(?, ?)");
        $statement->bind_param("ii",$post_id, $tag_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function getTagsByPostId($post_id)
    {
        $statement = self::$db->prepare("
            SELECT t.tag
            FROM posts_tags pt
            JOIN tags t
            ON t.id = pt.tag_id
            WHERE pt.post_id = ? "
        );
        $statement->bind_param("i", $post_id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

    public function deleteTagsFromPost($post_id){
        $statement = self::$db->prepare("DELETE FROM posts_tags WHERE post_id = ?");
        $statement->bind_param("i", $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deletePost($post_id){
        $statement = self::$db->prepare("DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deleteCommentsByPostId($post_id){
        $statement = self::$db->prepare("DELETE FROM comments WHERE post_id = ?");
        $statement->bind_param("i", $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }



}