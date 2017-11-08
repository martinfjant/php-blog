<?php

namespace Blogg\Models;

use Blogg\Domain\User;
use Blogg\Domain\User\UserFactory;
use Blogg\Exceptions\NotFoundException;
use PDO;

class UserModel extends AbstractModel
{
    const CLASSNAME = '\Blogg\Domain\User\UserFactory';

    public function get(int $customerId): User
    {
        $query = 'SELECT * FROM customers WHERE id = :id';
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $customerId]);

        $row = $sth->fetch();
        if (empty($row)) {
            throw new NotFoundException();
        }
        //Ändra detta i enlighet med databasen
        return UserFactory::factory(
            $row['id'],
            $row['username'],
            $row['f_name'],
            $row['s_name'],
            $row['email']
        );
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM customers';
        $sth = $this->db->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

        if (empty($row)) {
            throw new NotFoundException();
        }

        return UserFactory::factory(
		        $row['id'],
		        $row['username'],
		        $row['f_name'],
		        $row['s_name'],
		        $row['email']
        );
    }

    public function getByEmail(string $email): User
    {
        $query = 'SELECT * FROM customers WHERE email = :user';
        $sth = $this->db->prepare($query);
        $sth->execute(['user' => $email]);

        $row = $sth->fetch();

        if (empty($row)) {
            throw new NotFoundException();
        }

        return UserFactory::factory(
		        $row['id'],
		        $row['username'],
		        $row['f_name'],
		        $row['s_name'],
		        $row['email']
        );
    }
}
