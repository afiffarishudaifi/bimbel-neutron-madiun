<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopicdetilResource;
use Illuminate\Http\Request;
use App\Models\Post;

class TopicdetilController extends Controller
{
    public function index(Request $request,$id)
    {
        $pagination = 10;
        $post = Post::where('topic_id',$id)->orderBy('id', 'DESC')->paginate($pagination);
        return response()->json(TopicdetilResource::collection($post));
    }
}
