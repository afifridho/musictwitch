<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Followings;
use App\Followers;
use Auth;
use Uuid;
use Redirect;
use GuzzleHttp\Client;

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
        $client = new Client();
        $response = $client->request('GET','http://10.151.36.35/nclients?app=afifridho&name=test');
        $viewers = $response->getBody();
        return view('users.index', compact('user', 'viewers'));
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
      $user = User::where('id', $id)->get()->first();
      return view('users.edit', compact('user'));
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
      $user = User::find($id);
      // dd($user);
      if(!$user)
          return abort(404);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      if ($request->hasFile('file')) {
        $data = $request->file('file');
        $destinationPath = public_path('profpict');
        $fileName = $user->id.'-'.$data->getClientOriginalName();
        $data->move($destinationPath, $fileName);
        $path = $destinationPath.'/'.$fileName;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imgData = file_get_contents($path);
        $base64images = 'data:image/' . $type . ';base64,' . base64_encode($imgData);
        $user->profile_pictures = $base64images;
      }

      if($user->save())
      {
          return Redirect::to($request->url());
      }
      else
      {
          return Redirect::to($request->url());
      }
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
        $unfollow1 = Followings::where('followings_id', $id)->where('users_id', Auth::user()->id);
        $unfollow2 = Followers::where('users_id', $id)->where('followers_id', Auth::user()->id);
        // dd($unfollow2);
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
