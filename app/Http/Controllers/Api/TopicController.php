<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopicResource;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Session;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $pagination = 10;
        $topics = Topic::when($request->keyword, function ($query) use ($request) {
            $query->where('title', 'like', "%{$request->keyword}%");
        })->where('kelas_id',$request->kelas_id)->where('mapel_id',$request->mapel_id)->where('active','1')->orderBy('id', 'ASC')->paginate($pagination);
        return response()->json(TopicResource::collection($topics));
    }
}
