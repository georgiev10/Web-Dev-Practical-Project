<?php

class TagsModel extends BaseModel{

    public function getPopularTags()
    {
        $statement = self::$db->query("
            SELECT t.tag
            FROM posts_tags pt
            JOIN tags t
            ON t.id = pt.tag_id
            GROUP BY tag_id
            ORDER BY count(tag_id) DESC, tag_id DESC
            LIMIT 0, 20 "
        );
        return $statement->fetch_all();
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

    public function getIdExistingTag($tag){
        $statement = self::$db->prepare("SELECT id FROM tags WHERE tag=?");
        $statement->bind_param("s", $tag);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQL_ASSOC);
        if(isset($result[0]['id'])){
            return $result[0]['id'];
        }
            return false;
    }

    public function createTag($tag) {
        $statement = self::$db->prepare("INSERT INTO tags VALUES(NULL, ?)");
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

}

