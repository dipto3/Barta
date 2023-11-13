<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\PostFormRequest;
class PostService
{
    public function createPost($request)
    {
        // $request->validated();
        $post = DB::table('posts')->insert([
            'user_id' => Auth::user()->id,
            'uuid' => Str::uuid()->toString(),
            'total_views' => 1,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

    }

    public function updatePost($request, $uuid)
    {
        $loggedInUser = Auth::user()->id;
        $post = DB::table('posts')
        ->where('uuid', $uuid)
        ->update([
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);
    }

    public function remove($id){
        $loggedInUser = Auth::user()->id;
        $post = DB::table('posts')->where('user_id', $loggedInUser)->where('id',$id)->delete();
    }
}
