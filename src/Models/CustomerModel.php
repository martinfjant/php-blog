<?php

namespace Bookstore\Models;

use Bookstore\Domain\Customer;
use Bookstore\Domain\Customer\CustomerFactory;
use Bookstore\Exceptions\NotFoundException;
use PDO;

class CustomerModel extends AbstractModel
{
    const CLASSNAME = '\Bookstore\Domain\Customer\CustomerFactory';

    public function get(int $customerId): Customer
    {
        $query = 'SELECT * FROM customers WHERE id = :id';
        $sth = $this->db->prepare($query);
        $sth->execute(['id' => $customerId]);

        $row = $sth->fetch();
        if (empty($row)) {
            throw new NotFoundException();
        }
        
        return CustomerFactory::factory(
            $row['type'],
            $row['id'],
            $row['firstname'],
            $row['surname'],
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

        return CustomerFactory::factory(
            $row['type'],
            $row['id'],
            $row['firstname'],
            $row['surname'],
            $row['email']
        );
    }

    public function getByEmail(string $email): Customer
    {
        $query = 'SELECT * FROM customers WHERE email = :user';
        $sth = $this->db->prepare($query);
        $sth->execute(['user' => $email]);

        $row = $sth->fetch();

        if (empty($row)) {
            throw new NotFoundException();
        }

        return CustomerFactory::factory(
            $row['type'],
            $row['id'],
            $row['firstname'],
            $row['surname'],
            $row['email']
        );
    }
}
