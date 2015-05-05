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

}