<?php

namespace Blogg\Controllers;

use Exception;
use Blogg\Exceptions\NotFoundException;
use Blogg\Models\UserModel;

class UserController extends AbstractController
{
      public function login() {
        echo "<pre>";
        //  print_r($this->request->getParams());
          $params = $this->request->getParams();
          $inputUsername = $params->getString('username');
          var_dump($inputUsername);
          $inputPassword = $params->getString('password');
          $UserModel = new UserModel();
          $User = $UserModel->getUser($inputUsername);
          $User = $User[0];
          print_r($User);
          echo $User["password"];
          echo "</pre>";
          if (password_verify($inputPassword, $User["password"])){
            //Tack Alve för hjälp med Sessions <3<3
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $User['username'];
            echo $_SESSION['username'];
            //return $this->render('views/my_posts.php', $params);
            // REDIRECT SKICKAR VIDARE TILL EN PATH (URL).
            $this->redirect("posts/user/" . $User['username']);
          }
          else {
            $params = ['errorMessage' => 'Fel användarnamn eller lösenord'];
          //  return $this->render('views/layout.php', $params);
          $this->render('views/layout.php', $params);
          }
        }
        public function logout() {
          $_SESSION = [];
	        session_destroy();
        }
//$this->render('views/login.php');

      }
/*    public function login(): string {
      // Om requesten inte kommer med POST kasta felmeddelanden
        if (!$this->request->isPost()) {
            $params = ['errorMessage' => 'You need to login to do that!'];
            return $this->render('views/layout.php', $params);
        }
        // Sätt params till params från getParams() (från request.php)
        $params = $this->request->getParams();
        //Kontrollerar om params faktiskt innehåller något, annars kasta fel
        if (!$params->has('email')) {
            $params = ['errorMessage' => 'No info provided.'];
            return $this->render('views/login.php', $params);
        }
        // Sätter $email till eposten som kom med _POST och skapar en USER
        $email = $params->getString('email');
        $UserModel = new UserModel();
        //Söker efter User i databasen med e-post för att välja rätt användare
        //Annars kastar fel
        try {
            $User = $UserModel->getByEmail($email);
        } catch (NotFoundException $e) {
            $this->log->warn('User email not found: ' . $email);
            $params = ['errorMessage' => 'Email not found.'];
            return $this->render('views/login.php', $params);
        }
        //Sätter kaka (skall bli session)
        setcookie('user', $User->getId());
        // VAD GÖR DETTA?
        $newController = new BookController($this->request);
        $this->redirect('/my-books');
        return $newController->getAll();
    }

    public function getAll(): string
    {
        $UserModel = new UserModel();

        $Users = $UserModel->getAll();

        $properties = [
            'Users' => $Users
        ];

        return $this->render('views/Users.php', $properties);
    }

    public function get(int $UserId): int
    {
        $UserModel = new UserModel();

        try {
            $User = $UserModel->get($UserId);
        } catch (\Exception $e) {
            $properties = ['errorMessage' => 'User not found!'];
            return $this->render('views/User.php', $properties);
        }

        $properties = ['User' => $User];
        return $this->render('views/User.php', $properties);
    }*/
