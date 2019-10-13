<?php
/*
 * HomeController only for controller sample
 * @hilmanrdn 18-01-2017
 */

namespace App\Controllers\Editor;

use App\Controllers\BaseController;
use App\Models\CatSubSub;

class SubSubController extends BaseController
{
    public $sidebar = 'editor';

    public function index($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/subsub/index.twig', [
            'user' => $_SESSION['name'],
            'item' => CatSubSub::where('cat_sub', $id)->get(),
            'id' => $id['id'],
            'sidebar' => $this->sidebar
        ]);
    }

    public function show($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/subsub/show.twig', [
            'user' => $_SESSION['name'],
            'item' => CatSubSub::where('id', $id)->first(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function edit($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/subsub/edit.twig', [
            'user' => $_SESSION['name'],
            'item' => CatSubSub::where('id', $id)->first(),
            'sidebar' => $this->sidebar
        ]);
    }

    public function update($request, $response, $id)
    {
        $sub = CatSubSub::find($id)->first();
        $sub->title = $request->getParsedBody()['title'];
        $sub->description = $request->getParsedBody()['description'];
        $sub->save();

        return $response->withRedirect('/admin/editor/subsub/'.$sub->cat_sub);
    }

    public function create($request, $response, $id)
    {
        return $this->c->view->render($response, 'editor/subsub/create.twig', [
            'user' => $_SESSION['name'],
            'id' => $id['id'],
            'sidebar' => $this->sidebar
        ]);
    }

    public function store($request, $response, $id)
    {
        $sub = new CatSubSub;
        $sub->title = $request->getParsedBody()['title'];
        $sub->description = $request->getParsedBody()['description'];
        $sub->cat_sub = $id['id'];
        $sub->save();

        return $response->withRedirect('/admin/editor/subsub/'.$id['id']);
    }

    public function delete($request, $response, $id)
    {
        $sub = CatSubSub::find($id)->first();
        $sub->delete();

        return $response->withRedirect('/admin/editor/subsub/'.$sub['cat_sub']);
    }
}
