<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

    /**
         * @OA\Get(
         *     path="/api/posts",
         *     tags={"Post API"},
         *     @OA\Response(
         *         response="200",
         *         description="Returns some sample category things",
         *         @OA\JsonContent()
         *     ),
         *     @OA\Response(
         *         response="400",
         *         description="Error: Bad request. When required parameters were not supplied.",
         *     )
         * )
    */

class PostController extends Controller
{

    public function index()
    {
        return Post::all();
    }

    /**
         * @OA\Post(
         *     path="api/posts",
         *     operationId="CreatePost",
         *     tags={"Post API"},
         *     @OA\Parameter(
         *         name="title",
         *         in="query",
         *         description="The category parameter in path",
         *         required=true,
         *         @OA\Schema(type="string")
         *     ),
         *     @OA\Parameter(
         *         name="body",
         *         in="query",
         *         description="Some optional other parameter",
         *         required=false,
         *         @OA\Schema(type="string")
         *     ),
         *     @OA\Response(
         *         response="200",
         *         description="Returns some sample category things",
         *         @OA\JsonContent()
         *     ),
         *     @OA\Response(
         *         response="400",
         *         description="Error: Bad request. When required parameters were not supplied.",
         *     ),
         * )
     */

    public function store(Request $request)
    {
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post->save()){
                return response()->json(['status' => 'success', 'message' => 'Post created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post->save()){
                return response()->json(['status' => 'success', 'message' => 'Post updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id){
        try {
            $post = Post::findOrFail($id);

            if ($post->delete()){
                return response()->json(['status' => 'success', 'message' => 'Post deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
