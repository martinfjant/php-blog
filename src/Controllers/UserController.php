<?php

namespace Blogg\Controllers;

use Exception;
use Blogg\Exceptions\NotFoundException;
use Blogg\Models\CustomerModel;

class UserController extends AbstractController
{
    public function login(): string {
        if (!$this->request->isPost()) {
            $params = ['errorMessage' => 'You need to login to do that!'];
            return $this->render('views/layout.php', $params);
        }

        $params = $this->request->getParams();

        if (!$params->has('email')) {
            $params = ['errorMessage' => 'No info provided.'];
            return $this->render('views/login.php', $params);
        }

        $email = $params->getString('email');
        $customerModel = new CustomerModel();

        try {
            $customer = $customerModel->getByEmail($email);
        } catch (NotFoundException $e) {
            $this->log->warn('Customer email not found: ' . $email);
            $params = ['errorMessage' => 'Email not found.'];
            return $this->render('views/login.php', $params);
        }

        setcookie('user', $customer->getId());

        $newController = new BookController($this->request);
        $this->redirect('/my-books');
        return $newController->getAll();
    }

    public function getAll(): string
    {
        $customerModel = new CustomerModel();

        $customers = $customerModel->getAll();

        $properties = [
            'customers' => $customers
        ];

        return $this->render('views/customers.php', $properties);
    }

    public function get(int $customerId): string
    {
        $customerModel = new customerModel();

        try {
            $customer = $customerModel->get($customerId);
        } catch (\Exception $e) {
            $properties = ['errorMessage' => 'Customer not found!'];
            return $this->render('views/customer.php', $properties);
        }

        $properties = ['customer' => $customer];
        return $this->render('views/customer.php', $properties);
    }
}
