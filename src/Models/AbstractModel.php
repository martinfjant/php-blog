<?php

namespace Blogg\Models;

use Blogg\Core\Connection;

abstract class AbstractModel {
    protected $db;

    public function __construct() {
        $this->db = Connection::getInstance()->handler;
    }
}