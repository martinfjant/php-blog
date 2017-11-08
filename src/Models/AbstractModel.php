<?php

namespace Bookstore\Models;

use Bookstore\Core\Connection;

abstract class AbstractModel {
    protected $db;

    public function __construct() {
        $this->db = Connection::getInstance()->handler;
    }
}