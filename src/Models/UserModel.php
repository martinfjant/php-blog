<?php

namespace Blogg\Models;

use Blogg\Domain\User;
use Blogg\Domain\User\UserFactory;
use Blogg\Exceptions\NotFoundException;
use PDO;

class UserModel extends AbstractModel
{
  public function getUser($username)
  {

    $query = <<<SQL
    SELECT *
        FROM users
        WHERE username = :username
SQL;
    $sth = $this->db->prepare($query);
    $sth->bindParam('username', $username, PDO::PARAM_INT);
    $sth->execute();
    return $sth->fetchAll();
    }
    /*const CLASSNAME = '\Blogg\Domain\User\UserFactory';

    public function get(int $UserId): User
    {
        $query = 'SELECT * FROM Users WHERE user_id = :id';
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $UserId]);

        $row = $sth->fetch();
        if (empty($row)) {
            throw new NotFoundException();
        }
        //Ändra detta i enlighet med databasen
        return UserFactory::factory(
            $row['user_id'],
            $row['username'],
            $row['f_name'],
            $row['s_name'],
            $row['email']
        );
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM users';
        $sth = $this->db->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

        if (empty($row)) {
            throw new NotFoundException();
        }

        return UserFactory::factory(
		        $row['user_id'],
		        $row['username'],
		        $row['f_name'],
		        $row['s_name'],
		        $row['email']
        );
    }

    public function getByEmail(string $email): User
    {
        $query = 'SELECT * FROM users WHERE email = :user';
        $sth = $this->db->prepare($query);
        $sth->execute(['user' => $email]);

        $row = $sth->fetch();

        if (empty($row)) {
            throw new NotFoundException();
        }

        return UserFactory::factory(
		        $row['user_id'],
		        $row['username'],
		        $row['f_name'],
		        $row['s_name'],
		        $row['email']
        );
    }*/
}
