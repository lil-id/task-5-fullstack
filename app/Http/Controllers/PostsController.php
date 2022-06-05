<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // get all posts
    public function index() {
        $pagination = Posts::paginate(10);

        // dd($pagination->all());
        return response([ 'posts' => $pagination->all(), 'message' => 'Retrieved successfully'], 200);
    }

    // create articles
    public function create(Request $request) {

        $data = $request->all();

        $posts = Posts::create($data);

        if ($request->file('image') == null) {
            $posts->image = "";
        }else{
            $posts->image = $request->file('image')->store('img');  
        }

        // dd($posts);
        return response([ 'posts' => $posts, 'message' => 'Created successfully'], 201);
    }

    // display article details
    public function detail($id) {
        $posts = Posts::find($id);
        // dd($posts);
        return response([ 'posts' => $posts, 'message' => 'Retrieved successfully'], 200);
    }

    // update article
    public function update(Request $request, $id) {
        $title = $request->title;
        $content = $request->content;

        $posts = Posts::find($id);
        $posts->title = $title;
        $posts->content = $content;
        
        if ($request->file('image') == null) {
            $request->image = "";
        }else{
            $request->image = $request->file('image')->store('img');  
        }

        return response([ 'posts' => $posts, 'message' => 'Updated successfully'], 200);
    }

    // delete article
    public function delete($id) {
        $posts = Posts::find($id);
        $posts->delete();

        return response(['message' => 'Deleted'], 204);
    }
}
