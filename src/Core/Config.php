<?php

    namespace Bookstore\Core;

    use Bookstore\Utils\Singleton;
    use Bookstore\Exceptions\NotFoundException;

    /**
     * Singleton
     */
    class Config extends Singleton
    {
        private $data;

        protected function __construct()
        {
            $json = file_get_contents(__DIR__ . '/../../config/app.json');
            $this->data = json_decode($json, true);
        }

        public function get($key)
        {
            if (!isset($this->data[$key])) {
                throw new NotFoundException("Key $key not in config.");
            }
            return $this->data[$key];
        }
    }
