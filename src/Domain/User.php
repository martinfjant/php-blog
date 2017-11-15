<?php

namespace Blogg\Domain;

class Person
{
    protected $firstname;
    protected $surname;
    protected $email;
    private static $lastId = 0;
    protected $id;

    public function __construct($id, $firstname, $surname, $email)
    {
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->email = $email;
        $this->setId($id);
    }

    public function getFullName()
    {
        return $this->firstname . ' ' . $this->surname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function setId($id)
    {
        if ($id < 0) {
            throw new InvalidIdException('Id cannot be a negative number.');
        }
        if (empty($id)) {
            $this->id = ++self::$lastId;
        } else {
            $this->id = $id;
            if ($id > self::$lastId) {
                self::$lastId = $id;
            }
        }
        if ($this->id > 50) {
            throw new ExceededMaxAllowedException('Max number of users is 50.');
        }
    }

    public static function getLastId()
    {
        return self::$lastId;
    }

    public function getId()
    {
        return $this->id;
    }
}
