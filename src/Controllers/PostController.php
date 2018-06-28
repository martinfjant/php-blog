<?php

namespace Blogg\Controllers;

use Blogg\Exceptions\DbException;
use Blogg\Exceptions\NotFoundException;
use Blogg\Models\PostModel;
use Blogg\Models\UserModel;

class PostController extends AbstractController
{
    const PAGE_LENGTH = 10;

    public function getAllWithPage($page): string
    {
        $page = (int)$page;
        $postModel = new PostModel();

        $posts = $postModel->getAll($page, self::PAGE_LENGTH);
        $properties = [
            'posts' => $posts,
            'currentPage' => $page,
            'lastPage' => count($posts) < self::PAGE_LENGTH
        ];

        return $this->render('views/posts.php', $properties);
    }

    public function getAll(): string //why dis?
    {
        return $this->getAllWithPage(1);
    }

    public function get(int $postId): string
    {
        $postModel = new PostModel();
        try {
            $post = $postModel->get($postId);
        } catch (\Exception $e) {
            $properties = ['errorMessage' => 'Post not found!'];
            return $this->render('views/error.php', $properties);
        }

        $properties = ['post' => $post];
        return $this->render('views/post.php', $properties);
    }

    public function search(): string
    {
        $searchString = $this->request->getParams()->getString('search');

        $postModel = new PostModel();
        $posts = $postModel->search($searchString);

        $properties = [
            'posts' => $posts,
            'currentPage' => 1,
            'lastPage' => true
        ];

        return $this->render('views/posts.php', $properties);
    }

    public function getByUser(int $user_id): string
    {
        $postModel = new PostModel();
        $posts = $postModel->getByUserId($user_id);

        $properties = ['posts' => $posts];

        return $this->render('views/my-posts.php', $properties);
    }

    public function writePost(): string
    {
        $properties = [
          'title' => 'This is the title of the blog'
      ];
        return $this->render('views/make-post.php', $properties);
    }
    public function  edit(int $postId): string
    {
        $postModel = new PostModel();

        try {
            $post = $postModel->get($postId);
        } catch (\Exception $e) {
            $properties = ['errorMessage' => 'Post not found!'];
            return $this->render('views/error.php', $properties);
        }

        if ($_SESSION['loggedin'] == true) {
            $properties = ['post' => $post];
            return $this->render('views/edit-post.php', $properties);
        } else {
            $properties = ['errorMessage' => 'Du måste vara inloggad för att visa denna sida'];
            return $this->render('views/error.php', $properties);
        }
    }

    public function  create()
    {
        return $this->render('views/make-post.php');
    }
   
    public function  createPost()
    {
        $user_id = $_SESSION['user_id'];    
        $post = new PostModel();
        $params = $this->request->getParams();
        $new_post = $post->createPost($user_id, $params);

        return $this->redirect("/post/$new_post");
    }
    public function   editPost()
    {
        $post = new PostModel();
        $params = $this->request->getParams();
        $updpost = $post->editPost($params);

        return $this->redirect("/post/$updpost");
    }

    public function  deletePost() {
        $user_id = $_SESSION['user_id'];
        $params = $this->request->getParams();
        $post = new PostModel();
        $post->deletePost($params);
        return $this->redirect("/user/$user_id");
    }

}
