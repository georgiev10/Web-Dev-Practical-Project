<?php

class PostModel extends BaseModel{

    public function getPostById($id) {
        $statement = self::$db->prepare("SELECT * FROM posts WHERE id=?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

}