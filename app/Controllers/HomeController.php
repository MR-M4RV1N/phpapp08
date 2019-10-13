<?php

namespace App\Controllers;

use App\Models\Sample;

class HomeController extends BaseController
{
    public function index($request, $response)
    {
        return $this->c->view->render($response, 'index.twig');
    }
}
