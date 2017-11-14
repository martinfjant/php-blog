<?php

namespace Blogg\Models;

use Blogg\Domain\Post;
use Blogg\Exceptions\DbException;
use Blogg\Exceptions\NotFoundException;
use PDO;

class PostModel extends AbstractModel
{
    const CLASSNAME = '\Blogg\Domain\Post';

		// Hämtar en post i tabellen post med ID
    public function get(int $postId): Post
    {
        $query = 'SELECT * FROM posts WHERE id = :id';
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

        $query = 'SELECT * FROM posts LIMIT :page, :length';
        $sth = $this->db->prepare($query);
        $sth->bindParam('page', $start, PDO::PARAM_INT);
        $sth->bindParam('length', $pageLength, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }

    public function search(string $searchString): array
    {
        $query = <<<SQL
SELECT * FROM posts
WHERE title LIKE :searchString OR author LIKE :searchString
SQL;
        $sth = $this->db->prepare($query);
        $sth->bindValue('searchString', "%$searchString%");
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }

    public function getByUser(int $userId): array {
        $query = <<<SQL
SELECT b.*
FROM borrowed_books bb LEFT JOIN books b ON bb.book_id = b.id
WHERE bb.customer_id = :id
AND bb.end IS NULL
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $userId]);

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }

    public function getReturnedByUser(int $userId): array {
        $query = <<<SQL
SELECT b.*, bb.*
   FROM borrowed_books bb
       LEFT JOIN customers c ON bb.customer_id = c.id
       LEFT JOIN books b ON b.id = bb.book_id
    WHERE bb.customer_id = :id
    AND bb.end IS NOT NULL
SQL;
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $userId]);

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
    }

    public function borrow(Book $book, int $userId)
    {
        $query = <<<SQL
INSERT INTO borrowed_books (book_id, customer_id, start)
VALUES(:book, :user, NOW())
SQL;
        $sth = $this->db->prepare($query);
        $sth->bindValue('book', $book->getId());
        $sth->bindValue('user', $userId);
        if (!$sth->execute()) {
            throw new DbException($sth->errorInfo()[2]);
        }

        $this->updateBookStock($book);
    }

    public function returnBook(Book $book, int $userId)
    {
        $query = <<<SQL
UPDATE borrowed_books SET end = NOW()
WHERE book_id = :book AND customer_id = :user AND end IS NULL
SQL;
        $sth = $this->db->prepare($query);
        $sth->bindValue('book', $book->getId());
        $sth->bindValue('user', $userId);

        if (!$sth->execute()) {
            throw new DbException($sth->errorInfo()[2]);
        }

        $this->updateBookStock($book);
    }

    private function updateBookStock(Book $book)
    {
        $query = 'UPDATE books SET stock = :stock WHERE id = :id';
        $sth = $this->db->prepare($query);
        $sth->bindValue('id', $book->getId());
        $sth->bindValue('stock', $book->getStock());

        if (!$sth->execute()) {
            throw new DbException($sth->errorInfo()[2]);
        }
    }

}
