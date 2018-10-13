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
use App\Masternode;
use App\Coin;

class MasternodeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function masternodes(Request $request)
  {
    $query = $request->input('query');
    if($query == null)
    $query = '';

    $masternodes = Masternode::where('id', 'like', '%'.$query.'%')->paginate(50);

    return view('masternodes', [
      'masternodes' => $masternodes,
      'search' => $query,
    ]);
  }

  public function newMasternode()
  {
    $coins = Coin::all();
    return view('masternodeEdit', [
      'masternode' => array('id'=>null, 'name'=>'', 'email'=>'', 'coin_id'=>'', 'status'=>'', 'total_seats'=>'', 'empty_seats'=>'', 'seat_amount'=>'', 'server_id'=>'', 'active'=>''),
      'coins' => $coins
    ]);
  }

  public function editMasternode(Request $request, $id)
  {
    $coins = Coin::all();
    return view('masternodeEdit', [
      'masternode' => Masternode::findOrNew($id),
      'coins' => $coins
    ]);
  }

  public function postEdit(Request $request)
  {
    $masternode=[];
    if($request->input('id') != '') {
      $masternode = Masternode::findOrNew($request->input('id'));
      $masternode->name = $request->input('name');
      $masternode->status = $request->input('status');
      $masternode->coin_id = $request->input('coin_id');
      $masternode->total_seats = $request->input('total_seats');
      $masternode->empty_seats = $request->input('empty_seats');
      $masternode->seat_amount = $request->input('seat_amount');
      $masternode->save();
    } else {
      $masternode = Masternode::create([
        'name' => $request->input('name'),
        'status' => $request->input('status'),
        'coin_id' => $request->input('coin_id'),
        'total_seats' => $request->input('total_seats'),
        'empty_seats' => $request->input('empty_seats'),
        'seat_amount' => $request->input('seat_amount'),
      ]);
    }
    return redirect()->to('masternodes');
  }

  public function destroy($id)
  {
    $u = Masternode::findOrNew($id);
    //$this->authorize('destroy', $category);
    //Cat::destroy([$category]);
    $u->delete();
    $ret = array("result"=>"ok");
    return json_encode($ret);
  }
}
