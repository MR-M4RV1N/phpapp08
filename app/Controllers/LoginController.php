<?php

namespace App\Controllers;

use App\Models\Accounts;

class LoginController extends BaseController
{
    public function login($request, $response)
    {
        return $this->c->view->render($response, 'login.twig');
    }

    public function post($request, $response)
    {
        if ( !isset($_POST['username'], $_POST['password']) ) {
            die ('Please fill both the username and password field!');
        }


        $check = Accounts::where('username', $_POST['username'])->count();
        if($check > 0)
        {
            $query = Accounts::where('username', $_POST['username'])->get();

            if (password_verify($_POST['password'], $query[0]->password)) {
                session_start();
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $query[0]->id;
                return $response->withRedirect('/admin', 301);
            } else {
                echo 'Incorrect password!';
            }
        }
    }

    public function logout($request, $response)
    {
        session_start();
        session_destroy();
        return $response->withRedirect('/', 301);
    }
}
