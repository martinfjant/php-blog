<?php

namespace Blogg\Domain;

class User
{
    protected $user_id;
    protected $username;
    protected $f_name;
    protected $s_name;
    protected $email;

    // public function __construct($id, $firstname, $surname, $email)
    // {
    //     $this->firstname = $firstname;
    //     $this->surname = $surname;
    //     $this->email = $email;
    //     $this->setId($id);
    // }

    public function getId()
    {
        return $this->user_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getFullName()
    {
        return $this->f_name . ' ' . $this->s_name;
    }

    public function getFirstname()
    {
        return $this->f_name;
    }

    public function getSurname()
    {
        return $this->s_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // public function setEmail($email)
    // {
    //     $this->email = $email;
    // }

    // public function setId($id)
    // {
    //     if ($id < 0) {
    //         throw new InvalidIdException('Id cannot be a negative number.');
    //     }
    //     if (empty($id)) {
    //         $this->id = ++self::$lastId;
    //     } else {
    //         $this->id = $id;
    //         if ($id > self::$lastId) {
    //             self::$lastId = $id;
    //         }
    //     }
    //     if ($this->id > 50) {
    //         throw new ExceededMaxAllowedException('Max number of users is 50.');
    //     }
    // }

    // public static function getLastId()
    // {
    //     return self::$lastId;
    // }
}
