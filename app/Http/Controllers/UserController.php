<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Followings;
use App\Followers;
use Auth;
use Uuid;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::where('id', $id)->get()->first();
        return view('users.index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchuser(Request $request)
    {
        $found = User::where('username', 'like', '%' . $request->u . '%')
                        ->orWhere('email', 'like', '%' . $request->u . '%')
                        ->orWhere('name', 'like', '%' . $request->u . '%')
                        ->paginate('10');
        return view('search')->with('found', $found);
        dd($search);
    }

    public function follow(Request $request, $id)
    {
        // dd($id);
        $following = new Followings;
        $following->followings_id = $id;
        $following->users_id = Auth::user()->id;

        $followers = new Followers;
        $followers->followers_id = Auth::user()->id;;
        $followers->users_id = $id;

        try {
          $following->save();
          $followers->save();
        } catch (Exception $e) {
          // $user = User::where('id', $id)->get()->first();
          // return view('users.index')->with('user', $user);
          return redirect()->route('users.index', $id);
        }
        // $user = User::where('id', $id)->get()->first();
        // return view('users.index')->with('user', $user);
        return redirect()->route('users.index', $id);

    }

    public function unfollow(Request $request, $id)
    {
        $unfollow1 = Followings::where('followings_id', $id);
        $unfollow2 = Followers::where('users_id', $id);

        try {
          $unfollow1->delete();
          $unfollow2->delete();
        } catch (Exception $e) {
          // $user = User::where('id', $id)->get()->first();
          // return view('users.index')->with('user', $user);
          return redirect()->route('users.index', $id);
        }
        // $user = User::where('id', $id)->get()->first();
        // return view('users.index')->with('user', $user);
        return redirect()->route('users.index', $id);
    }
}
