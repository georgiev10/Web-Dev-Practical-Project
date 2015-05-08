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
            LIMIT 0, 50 "
        );
        return $statement->fetch_all();
    }
}

