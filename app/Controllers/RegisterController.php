<?php

namespace App\Controllers;

use App\Models\Accounts;

class RegisterController extends BaseController
{
    public function register($request, $response)
    {
        return $this->c->view->render($response, 'register.twig');
    }

    public function post($request, $response)
    {
        if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
            die ('Please complete the registration form!');
        }
        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
            die ('Please complete the registration form');
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die ('Email is not valid!');
        }
        if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
            die ('Username is not valid!');
        }
        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            die ('Password must be between 5 and 20 characters long!');
        }

        $check = Accounts::where('username', $_POST['username'])->count();
        if($check > 0)
        {
            echo 'Username exists, please choose another!';
        }
        else
        {
            $account = new Accounts;
            $account->username = $_POST['username'];
            $account->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $account->email = $_POST['email'];
            $account->save();
            echo 'You have successfully registered, you can now login!';
        }
    }
}
