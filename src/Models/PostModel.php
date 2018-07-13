<?php

namespace Blogg\Models;

use Blogg\Domain\Post;
use Blogg\Exceptions\DbException;
use Blogg\Exceptions\NotFoundException;
use PDO;

class PostModel extends AbstractModel {
    const CLASSNAME = '\Blogg\Domain\Post';

	// Hämtar en post i tabellen post med ID
    public function get(int $postId): Post
    {
        $query = <<<SQL
        SELECT 
        p.id, p.title, p.content, p.date, c.cat_name, c.cat_id, u.user_id,
        CONCAT(u.f_name, " ", u.s_name) AS author,
        GROUP_CONCAT(pt.tag_id) AS tag_ids,
        GROUP_CONCAT(t.tag_name) AS tags
        FROM posts p
        LEFT JOIN author a ON p.id = a.id
        LEFT JOIN users u ON u.user_id = a.user_id 
        LEFT JOIN cat_bind cb ON cb.id = p.id 
        LEFT JOIN cathegory c ON c.cat_id = cb.cat_id 
        LEFT JOIN  post_tag pt ON pt.id = p.id
        LEFT JOIN tags t ON t.tag_id = pt.tag_id 
        WHERE p.id = :id
        GROUP BY p.id
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $postId]);

        $posts = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

        if (empty($posts)) {
            throw new NotFoundException();
        }

        return $posts[0];
    }
		//Hämta alla poster paginerat
    public function getAll(int $page, int $pageLength): array
    {
        $start = $pageLength * ($page - 1);

        $query = <<<SQL
        SELECT *
        FROM posts, author, users
        WHERE posts.id = author.id
        AND author.user_id = users.user_id
        LIMIT :page, :length
SQL;
        $sth = $this->db->prepare($query);
        $sth->bindParam('page', $start, PDO::PARAM_INT);
        $sth->bindParam('length', $pageLength, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }


    public function getByUser(int $userId): array {
        $query = <<<SQL
            SELECT *
            FROM posts, author, users
            WHERE author.user_id = :id
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $userId]);

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }

    public function getByUserId(int $user_id): Array
    {
        $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $query = <<<SQL
        SELECT posts. id, posts.title, cathegory.cat_id, cathegory.cat_name,
        posts.date,  users.user_id, users.username,
        CONCAT(users.f_name, " ", users.s_name) AS author, users.email 
        FROM posts
        LEFT JOIN author ON posts.id = author.id
        LEFT JOIN users ON users.user_id = author.user_id
        LEFT JOIN cat_bind ON cat_bind.id = posts.id
        LEFT JOIN cathegory ON cathegory.cat_id = cat_bind.cat_id
        WHERE author.user_id = :user_id
        GROUP BY posts.id
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['user_id' => $user_id]);

        $posts = $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    
        return $posts;
    }

    public function  createPost($user_id, $params) { 

       $inputTitle = $params->getString('rubrik');
       $inputContent = $params->getString('text');
       $inputCat = $params->getString('cat');
       $inputTags = $params->get('taggles');

       $this->db->beginTransaction();
//      Insert the title and the content of the post
       $query = <<<SQL
       INSERT INTO posts (title, content)
       VALUES (:title, :content)
SQL;
       $sth = $this->db->prepare($query);
       $sth->execute(['title' => $inputTitle, 'content' => $inputContent]);
//      Saves the new posts foreign key id       
       $lastId = $this->db->lastInsertId();
//      Creates relation between user and post       
       $query = <<<SQL
           INSERT INTO author (id, user_id)
           VALUES (:last, :user_id)
SQL;
       $sth = $this->db->prepare($query);
       $sth->execute(['last' => $lastId, 'user_id' => $user_id]);
//      Create relation between category and post
       $query = <<<SQL
           INSERT INTO cat_bind (cat_id, id)
           VALUES (:cat_id, :last)
SQL;
       $sth = $this->db->prepare($query);
       $sth->execute(['cat_id' => $inputCat, 'last' => $lastId]);


//      Creates tags, and if the exist relations between post and tags
    foreach($inputTags as $inputTag) {
            
//          Check if the tag exists, if not, creates the tag
            $query = <<<SQL
            INSERT INTO tags (tag_name)
            VALUES (:input_tag)
			ON DUPLICATE KEY UPDATE tag_name=:input_tag;
SQL;
            $sth = $this->db->prepare($query);
            $sth->execute(['input_tag' => $inputTag]);
                  

//          Make the relations happen
            $query = <<<SQL
            INSERT INTO post_tag (tag_id, id)
            VALUES ((SELECT tag_id FROM tags WHERE tag_name=:input_tag), :last)
SQL;
            $sth = $this->db->prepare($query);
            $sth->execute(['input_tag' => $inputTag, 'last' => $lastId]);
        }
            
            $this->db->commit();
        
//      Returns the new posts id to display it
    return $lastId;
}

    public function  editPost($params) { 
//      Structures the params        
       $postId = $params->getString('id');
       $inputTitle = $params->getString('rubrik');
       $inputContent = $params->getString('text');
       $inputCat = $params->getString('cat');
       $inputTags = $params->get('taggles');

       $this->db->beginTransaction();
//      Updates the post        
        $query = <<<SQL
        UPDATE posts 
        SET title = :title, content = :content
        WHERE id = :id;
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['title' => $inputTitle, 'content' => $inputContent, 'id' => $postId]);

//      Updates the category
        $query = <<<SQL
        UPDATE cat_bind
        SET cat_id = :cat
        WHERE id = :id
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['cat' => $inputCat, 'id' => $postId]);

 //      Deletes all associated tags   

        $query = <<<SQL
        DELETE FROM post_tag
        WHERE id = :id
SQL;
//      Reinserts tags
        foreach($inputTags as $inputTag) {
            
//          Check if the tag exists, if not, creates the tag
            $query = <<<SQL
            INSERT INTO tags (tag_name)
            VALUES (:input_tag)
            ON DUPLICATE KEY UPDATE tag_name=:input_tag;
SQL;
            $sth = $this->db->prepare($query);
            $sth->execute(['input_tag' => $inputTag]);
                    

//          Make the relations happen
            $query = <<<SQL
            INSERT INTO post_tag (tag_id, id)
            VALUES ((SELECT tag_id FROM tags WHERE tag_name=:input_tag), :id)
SQL;
            $sth = $this->db->prepare($query);
            $sth->execute(['input_tag' => $inputTag, 'id' => $postId]);
        }
            $this->db->commit();
//      Returns the postID
        return $postId;
    
    
      }

      public function deletePost($params) {
      $postId = $params->getString('id');

      $query = <<<SQL
      DELETE FROM posts
      WHERE id = :id;
SQL;
      $sth = $this->db->prepare($query);
      $sth->execute(['id' => $postId]);
      }

      public function getCatWithPostId($postId)
      {
        $query = <<<SQL
        SELECT cat_name
        FROM cathegory, cat_bind, posts
        WHERE posts.id = cat_bind.id
        AND cat_bind.cat_id = cathegory.cat_id
        AND posts.id = :id
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $postId]);

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
      }

}
