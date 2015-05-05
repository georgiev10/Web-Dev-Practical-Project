<?php

class CommentsModel extends BaseModel{
    public function getAll($post_id){
        $statement = self::$db->prepare('SELECT * FROM comments WHERE post_id=?');
        $statement->bind_param("i", $post_id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

}