<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return $posts;
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Post::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $arr = ['status' => true, 'message' => 'Post Created Successfully.', 'api' => ''];

        return $arr;
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        Post::find($id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $arr = ['status' => true, 'message' => 'Post Updated Successfully.', 'api' => ''];

        return $arr;
    }

    public function show($id) {
        $post = Post::find($id);

        return $post;
    }

    public function destroy($id) {
        Post::destroy($id);

        $arr = ['status' => true, 'message' => 'Post deleted Successfully.', 'api' => ''];

        return $arr;
    }
}
