<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index($request, $response)
    {
        return $this->c->view->render($response, 'admin/index.twig', [
            'user' => $_SESSION['name'],
            'sidebar' => 'home'
        ]);
    }
}
