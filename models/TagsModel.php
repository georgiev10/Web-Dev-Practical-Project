<?php
/**
 * Created by PhpStorm.
 * User: Dimitar Georgiev
 * Date: 8.5.2015 г.
 * Time: 17:54 ч.
 */

class TagsModel extends BaseModel{

    public function getPopularTags()
    {
        $statement = self::$db->query("
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

}