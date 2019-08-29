<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $follow = new Follow;
        $follow->follower = $request->follower;
        $follow->follow = $request->follow;
        $follow->save();
        unset($follow['_token']);
        // フォローカウントを更新
        DB::table('users')->where('id', $request->follow)->update(['follow' => $request->followUserCount]);
        // フォロワーカウントを更新
        DB::table('users')->where('id', $request->follower)->update(['follower' => $request->followerCount]);
        return response()->json([]);
    }

    public function unfollow(Request $request)
    {
        $unfollow = DB::table('follows')->where('follow', $request->follow)->where('follower', $request->follower)->delete();
        // フォローカウントを更新
        DB::table('users')->where('id', $request->follow)->update(['follow' => $request->followUserCount]);
        // フォロワーカウントを更新
        DB::table('users')->where('id', $request->follower)->update(['follower' => $request->followerCount]);
        return response()->json([]);
    }
}
