<?php

class PostsModel extends BaseModel{

    public function getAll() {
        $statement = self::$db->query("
          SELECT p.title, u.username, p.date, p.id
          FROM posts p
          INNER JOIN users u ON p.user_id = u.id
          ORDER BY p.date DESC
        ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}