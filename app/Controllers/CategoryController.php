<?php

namespace App\Controllers;

use App\Models\Cat;
use App\Models\CatSub;
use App\Models\CatSubSub;

class CategoryController extends BaseController
{
    public $sidebar = 'categories';

    public function index($request, $response)
    {
        $categories = Cat::all();

        return $this->c->view->render($response, 'admin/categories.twig', [
            'user' => $_SESSION['name'],
            'categories' => $categories,
            'sidebar' => $this->sidebar
        ]);
    }

    public function cat($request, $response, $id)
    {
        $categories = Cat::all();
        $content = Cat::where('id', $id)->first();
        $sub_categories = CatSub::where('cat', $id)->get();

        return $this->c->view->render($response, 'admin/cat_category.twig', [
            'user' => $_SESSION['name'],
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'content' => $content,
            'sidebar' => $this->sidebar,
            'cat' => $id['id']
        ]);
    }

    public function sub($request, $response, $var)
    {
        $categories = Cat::all();
        $sub_categories = CatSub::where('cat', $var['cat'])->get();
        $sub_sub_categories = CatSubSub::where('cat_sub', $var['id'])->get();
        $content = CatSub::where('id', $var['id'])->first();

        return $this->c->view->render($response, 'admin/sub_category.twig', [
            'user' => $_SESSION['name'],
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'sub_sub_categories' => $sub_sub_categories,
            'content' => $content,
            'sidebar' => $this->sidebar,
            'cat' => $var['cat'],
            'sub' => $var['id'],
        ]);
    }


    public function subsub($request, $response, $var)
    {
        $categories = Cat::all();
        $sub_categories = CatSub::where('cat', $var['cat'])->get();
        $sub_sub_categories = CatSubSub::where('cat_sub', $var['sub'])->get();
        $content = CatSubSub::where('id', $var['id'])->first();

        return $this->c->view->render($response, 'admin/sub_sub_category.twig', [
            'user' => $_SESSION['name'],
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'sub_sub_categories' => $sub_sub_categories,
            'content' => $content,
            'sidebar' => $this->sidebar,
            'cat' => $var['cat'],
            'sub' => $var['sub'],
            'subsub' => $var['id'],
        ]);
    }
}
