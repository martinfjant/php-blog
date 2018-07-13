<?php

namespace Blogg\Models;

use Blogg\Domain\Tag;
use Blogg\Exceptions\DbException;
use Blogg\Exceptions\NotFoundException;
use PDO;

class TagModel extends AbstractModel {
    const CLASSNAME = '\Blogg\Domain\Tag';

	// Gets all tags
    public function getAll(): Tag
    {
        $query = <<<SQL
        SELECT GROUP_CONCAT(tags.tag_id) AS tag_ids,
        GROUP_CONCAT(tags.tag_name) AS tags FROM tags 
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute();

        $tags = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

        if (empty($tags)) {
            throw new NotFoundException();
        }

        return $tags[0];}

    public function deleteTag(int $id) {
        $inputId = $id;
        $query = <<<SQL
        DELETE FROM tags
        WHERE tag_id = :tag_id 
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['tag_id'=>$inputId]);
        
    }

}
