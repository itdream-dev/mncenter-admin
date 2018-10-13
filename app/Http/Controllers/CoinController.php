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

class CoinController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function coins(Request $request)
  {
    $query = $request->input('query');
    if($query == null)
    $query = '';

    $coins = Coin::where('coin_name', 'like', '%'.$query.'%')->paginate(50);

    return view('coins', [
      'coins' => $coins,
      'search' => $query,
    ]);
  }

  public function newCoin()
  {
    return view('coinEdit', [
      'coin' => array('id'=>null, 'coin_name'=>'', 'coin_symbol'=>'',  'seat_price'=>0, 'masternode_amount'=>'', 'status'=>''),
    ]);
  }

  public function editCoin(Request $request, $id)
  {
    $coins = Coin::all();
    return view('coinEdit', [
      'coin' => Coin::findOrNew($id),
    ]);
  }

  public function postEdit(Request $request)
  {
    $coin=[];
    if($request->input('id') != '') {
      $coin = Coin::findOrNew($request->input('id'));
      $coin->coin_name = $request->input('coin_name');
      $coin->coin_symbol = $request->input('coin_symbol');
      $coin->seat_price = $request->input('seat_price');
      $coin->masternode_amount = $request->input('masternode_amount');
      $coin->status = $request->input('status');

      $coin->save();
    } else {
      $coin = Coin::create([
        'coin_name' => $request->input('coin_name'),
        'coin_symbol' => $request->input('coin_symbol'),
        'masternode_amount' => $request->input('masternode_amount'),
        'seat_price' => $request->input('seat_price'),
        'status' => $request->input('status'),
      ]);
    }
    return redirect()->to('coins');
  }

  public function destroy($id)
  {
    $u = Coin::findOrNew($id);
    //$this->authorize('destroy', $category);
    //Cat::destroy([$category]);
    $u->delete();
    $ret = array("result"=>"ok");
    return json_encode($ret);
  }
}
