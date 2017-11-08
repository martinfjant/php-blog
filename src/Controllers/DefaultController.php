<?php

namespace Blogg\Controllers;

use Blogg\Exceptions\NotFoundException;

class DefaultController extends AbstractController
{
    public function start(): string
    {
        $properties = [
            'title' => 'This is the title of the blog'
        ];

        return $this->render('views/layout.php', $properties);
    }
}
