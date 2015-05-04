<?php

class HomeModel extends BaseModel{

    public function getPosts($from, $size) {
        $statement = self::$db->prepare("
            SELECT p.id, p.title, p.date, u.username
            FROM posts p
            INNER JOIN users u ON p.user_id = u.id
            ORDER BY p.date DESC LIMIT ?, ?"
        );
        $statement->bind_param('ii', $from, $size);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }
}



