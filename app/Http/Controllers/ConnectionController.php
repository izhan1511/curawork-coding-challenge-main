<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Connection;
use Illuminate\Contracts\View\View;

class ConnectionController extends Controller
{
    public function getSuggestions($user_id)
    {
        $checkFirstConnection = Connection::where('first_user_id', $user_id)->select('sec_user_id')->get();
        $checkSecConnection = Connection::where('sec_user_id', $user_id)->select('first_user_id')->get();
        $data = User::where('id', '!=', $user_id)
            ->whereNotIn('id', $checkFirstConnection)
            ->whereNotIn('id', $checkSecConnection)
            ->select('name', 'email', 'id')->get();
        return view('components/suggestion', compact('data'));
    }

    public function connect($user_id, $sec_user)
    {
        $con = Connection::create([
            'first_user_id' => $user_id,
            'sec_user_id' => $sec_user,
        ]);
        return response([
            'data' => $con,
            'msg' => 'Success',
        ], 200);
    }
    public function sendRequest($user_id)
    {
        $data = Connection::where('first_user_id', $user_id)->with('user')->where('status', '0')->get();
        return view('components/request', compact('data'));
    }
    public function withdraw($user_id, $sec_user)
    {
        $con = Connection::where('first_user_id', $user_id)->where('sec_user_id', $sec_user)->first();
        $con->delete();
        return response([
            'data' => [],
            'msg' => 'Success',
        ], 200);
    }

    public function receivedRequest($user_id)
    {
        $data = Connection::where('sec_user_id', $user_id)->with('firstUser')->where('status', '0')->get();
        return view('components/received', compact('data'));
    }
    public function accept($user_id, $sec_user)
    {
        $con = Connection::where('sec_user_id', $user_id)->where('first_user_id', $sec_user)->first();
        $con->status = 1;
        $con->save();
        return response([
            'data' => $con,
            'msg' => 'Success',
        ], 200);
    }

    public function connections($user_id)
    {
        $data = Connection::where(function ($query) use ($user_id) {
            $query->where('first_user_id', '=', $user_id)
                ->orWhere('sec_user_id', '=', $user_id);
        })
            ->where('status', 1)
            ->get();
        return view('components/connection', compact('data', 'user_id'));
    }

    public function remove($user_id, $sec_user)
    {
        $checkFirst = Connection::where('first_user_id', $user_id)->where('sec_user_id', $sec_user)->first();
        if ($checkFirst) {
            $checkFirst->delete();
            return response([
                'data' => [],
                'msg' => 'Removed Success',
            ], 200);
        }
        $checkSec = Connection::where('first_user_id', $sec_user)->where('sec_user_id', $user_id)->first();
        $checkSec->delete();
        return response([
            'data' => [],
            'msg' => 'Removed Success',
        ], 200);
    }

    public function commonConnections($user_id, $sec_user)
    {
        $checkLoginFirstConnection = Connection::where('status', '1')->where('first_user_id', $user_id)->where('sec_user_id', '!=', $sec_user)->select('sec_user_id')->get();
        $checkLoginSecConnection = Connection::where('status', '1')->where('sec_user_id', $user_id)->where('first_user_id', '!=', $sec_user)->select('first_user_id')->get();

        $commonFirstConnection = Connection::where('status', '1')->where('first_user_id', $sec_user)->whereIn('sec_user_id',  $checkLoginFirstConnection)->select('sec_user_id')->get();
        $commonFirstConnectionSec = Connection::where('status', '1')->where('first_user_id', $sec_user)->whereIn('sec_user_id',  $checkLoginSecConnection)->select('sec_user_id')->get();

        $commonSecConnection = Connection::where('status', '1')->where('sec_user_id', $sec_user)->whereIn('first_user_id',  $checkLoginFirstConnection)->select('first_user_id')->get();
        $commonSecConnectionSec = Connection::where('status', '1')->where('sec_user_id', $sec_user)->whereIn('first_user_id',  $checkLoginSecConnection)->select('first_user_id')->get();

        $data = User::where('id', '!=', $user_id)
            ->where('id', '!=', $sec_user)
            ->whereIn('id', $commonFirstConnection)
            ->orWhereIn('id', $commonFirstConnectionSec)
            ->orWhereIn('id', $commonSecConnection)
            ->orWhereIn('id', $commonSecConnectionSec)
            ->select('name', 'email','id')
            ->get();

        return view('components/connection_in_common', compact('data'));

       
    }
}
