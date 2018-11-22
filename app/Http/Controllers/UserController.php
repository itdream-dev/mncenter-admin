<?php

namespace App\Http\Controllers;

/******************************************************
* IM - Vocabulary Builder
* Version : 1.0.2
* Copyright© 2016 Imprevo Ltd. All Rights Reversed.
* This file may not be redistributed.
* Author URL:http://imprevo.net
******************************************************/

use App\User;
use App\Sale;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\DB;
use Log;
class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', '2fa'] );
  }

  public function users(Request $request)
  {
    $query = $request->input('query');
    if($query == null)
    $query = '';

    $users = User::where('email', 'like', '%'.$query.'%')->paginate(50);

    return view('users', [
      'users' => $users,
      'search' => $query,
    ]);
  }

  public function newUser()
  {
    return view('userEdit', [
      'user' => array('id'=>null, 'name'=>'', 'email'=>'', 'permission'=>0)
    ]);
  }

  public function editUser(Request $request, $id)
  {
    return view('userEdit', [
      'user' => User::findOrNew($id)
    ]);
  }

  public function postEdit(Request $request)
  {
    $user=[];
    if($request->input('id') != '') {
      $user = User::findOrNew($request->input('id'));
      if(!$request->input('name')) {
        $pos = stripos($request->input('email'),"@");
        $userName =  substr($request->input('email'), 0, $pos);
      } else {
        $userName = $request->input('name');
      }

      $user->name = $userName;
      $user->permission = intval($request->input('permission'));
      Log::info($request->input('isResetPassword'));
      if ($request->input('isResetPassword'))
      {
        Log::info($request->input('reset_password'));
        $user->password = bcrypt($request->input('reset_password'));
      }
      $user->save();


    } else {
      $exists = User::where('email', $request->input('email'))->get();
      if(sizeof($exists) > 0) {
        return Redirect::back()->withErrors("This email already used.");
      }
      $userName = "";

      if(!$request->input('name')) {
        $pos = stripos($request->input('email'),"@");
        $userName =  substr($request->input('email'), 0, $pos);
      } else {
        $userName = $request->input('name');
      }

      $user = User::create([
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'name' => $userName,
        'permission' => 1
      ]);
    }
    return redirect()->to('users');
  }

  public function destroy($id)
  {
    $u = User::findOrNew($id);
    //$this->authorize('destroy', $category);
    //Cat::destroy([$category]);
    $u->delete();
    $ret = array("result"=>"ok");
    return json_encode($ret);
  }

  public function reset2FA(Request $request, $id){
    $user = User::findOrNew($id);
    if (isset($user->passwordSecurity->backup_code)){
        $user->passwordSecurity->delete();
    }
    $ret = array("result"=>"ok");
    return json_encode($ret);
  }
}
