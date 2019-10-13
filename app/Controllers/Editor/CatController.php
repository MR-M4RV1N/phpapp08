<?php
/*
 * HomeController only for controller sample
 * @hilmanrdn 18-01-2017
 */

namespace App\Controllers\Editor;

use App\Controllers\BaseController;
use App\Models\Cat;

class CatController extends BaseController
{
    public $sidebar = 'editor';

    public function index($request, $response)
    {
        return $this->c->view->render($response, 'editor/cat/index.twig', [
            'user' => $_SESSION['name'],
            'item' => Cat::all(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function show($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/cat/show.twig', [
            'user' => $_SESSION['name'],
            'item' => Cat::where('id', $id)->first(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function edit($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/cat/edit.twig', [
            'user' => $_SESSION['name'],
            'item' => Cat::where('id', $id)->first(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function update($request, $response, $id)
    {
        $cat = Cat::find($id)->first();
        $cat->title = $request->getParsedBody()['title'];
        $cat->description = $request->getParsedBody()['description'];
        $cat->save();

        return $response->withRedirect('/admin/editor/cat');
    }

    public function create($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/cat/create.twig', [
            'user' => $_SESSION['name'],
            'sidebar' => $this->sidebar
        ]);
    }

    public function store($request, $response)
    {
        $cat = new Cat;
        $cat->title = $request->getParsedBody()['title'];
        $cat->description = $request->getParsedBody()['description'];
        $cat->save();

        return $response->withRedirect('/admin/editor/cat');
    }

    public function delete($request, $response, $id)
    {
        $cat = Cat::find($id)->first();
        $cat->delete();

        return $response->withRedirect('/admin/editor/cat');
    }
}
