<?php
/*
 * HomeController only for controller sample
 * @hilmanrdn 18-01-2017
 */

namespace App\Controllers\Editor;

use App\Controllers\BaseController;
use App\Models\CatSub;

class SubController extends BaseController
{
    public $sidebar = 'editor';

    public function index($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/sub/index.twig', [
            'user' => $_SESSION['name'],
            'item' => CatSub::where('cat', $id)->get(),
            'id' => $id['id'],
            'sidebar' => $this->sidebar
        ]);
    }

    public function show($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/sub/show.twig', [
            'user' => $_SESSION['name'],
            'item' => CatSub::where('id', $id)->first(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function edit($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/sub/edit.twig', [
            'user' => $_SESSION['name'],
            'item' => CatSub::where('id', $id)->first(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function update($request, $response, $id)
    {
        $sub = CatSub::find($id)->first();
        $sub->title = $request->getParsedBody()['title'];
        $sub->description = $request->getParsedBody()['description'];
        $sub->save();

        return $response->withRedirect('/admin/editor/sub/'.$sub->cat);
    }

    public function create($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/sub/create.twig', [
            'user' => $_SESSION['name'],
            'id' => $id['id'],
            'sidebar' => $this->sidebar
        ]);
    }

    public function store($request, $response, $id)
    {
        $sub = new CatSub;
        $sub->title = $request->getParsedBody()['title'];
        $sub->description = $request->getParsedBody()['description'];
        $sub->cat = $id['id'];
        $sub->save();

        return $response->withRedirect('/admin/editor/sub/'.$id['id']);
    }

    public function delete($request, $response, $id)
    {
        $sub = CatSub::find($id)->first();
        $sub->delete();

        return $response->withRedirect('/admin/editor/sub/'.$sub['cat']);
    }
}
