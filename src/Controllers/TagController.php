<?php

namespace Blogg\Controllers;

use Blogg\Exceptions\DbException;
use Blogg\Exceptions\NotFoundException;
use Blogg\Models\TagModel;
use Blogg\Models\UserModel;

class TagController extends AbstractController
{
    public function getAll(): string
    {
        if ($_SESSION['loggedin'] == true){
            $tagModel = new TagModel();
            try {
                $tag = $tagModel->getAll();
            } catch (\Exception $e) {
                $properties = ['errorMessage' => 'Post not found!'];
                return $this->render('views/error.php', $properties);
            }

            $properties = ['tag' => $tag];
            return $this->render('views/tags.php', $properties);
        }else {
            $properties = ['errorMessage' => 'Du måste vara inloggad för att visa denna sida'];
            return $this->render('views/error.php', $properties);
        }
    }

    public function deleteTag(int $tagId)
    {
        if ($_SESSION['loggedin'] == true){
            $tag = new TagModel();
            $tag->deleteTag($tagId);
            return $this->redirect("/tags");
        }else {
            $properties = ['errorMessage' => 'Du måste vara inloggad för att visa denna sida'];
            return $this->render('views/error.php', $properties);
        }

    }
}
