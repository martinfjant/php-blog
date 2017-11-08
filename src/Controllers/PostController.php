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

    public function getAll(): string
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

    public function getByUser(): string
    {
        $postModel = new PostModel();
        $userModel = new CustomerModel();

        $user = $userModel->get($this->Id);
       $posts = $postModel->getByUser($this->customerId);
        /$returnedPosts = $postModel->getReturnedByUser($this->customerId);

        $properties = [
            'customer' => $customer,
            'posts' => $posts,
            'returnedPosts' => $returnedPosts,
            'currentPage' => 1,
            'lastPage' => true,
            'isMyPosts' => true
        ];
        
        return $this->render('views/my-posts.php', $properties);
    }

}
