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
use App\Http\Controllers\Rpc\jsonRPCClient;

class MasternodeController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', '2fa'] );
  }

  public function masternodes(Request $request)
  {
    $query = $request->input('query');
    if($query == null)
    $query = '';

    $masternodes = Masternode::where('id', 'like', '%'.$query.'%')->paginate(50);
    foreach ($masternodes as $masternode){
      $seat_price = $masternode->coin->seat_price;
      $total_seats = $masternode->coin->masternode_amount / $seat_price;
      $masternode->total_seats = $total_seats;
      $sales = Sale::where('status', 'completed')->where('masternode_id', $masternode->id)->get();
      $sales_seats = 0;
      foreach ($sales as $sale){
        $sales_seats = $sales_seats + $sale->sales_amount;
      }
      $masternode->empty_seats = $total_seats - $sales_seats;
    }
    return view('masternodes', [
      'masternodes' => $masternodes,
      'search' => $query,
    ]);
  }

  public function newMasternode()
  {
    $coins = Coin::all();
    return view('masternodeEdit', [
      'masternode' => array('id'=>null, 'name'=>'', 'email'=>'', 'coin_id'=>'', 'status'=>'', 'total_seats'=>'', 'empty_seats'=>'', 'seat_amount'=>'', 'server_id'=>'', 'active'=>'', 'rpc_user'=>'',
      'rpc_password'=>'', 'rpc_ip' => '', 'rpc_port' => ''),
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
      $coin = Coin::where('id', $request->input('coin_id'))->first();

      $coin = Coin::where('id', $request->input('coin_id'))->first();
      if ($coin){
        $masternode->total_seats = $coin->masternode_amount / $coin->seat_price;

        if ($masternode->empty_seats == NULL){
          $masternode->empty_seats = $masternode->total_seats;
        }

        if ($masternode->seat_amount == NULL){
          $masternode->seat_amount = 0;
        }
        
        $masternode->save();
      }

      $masternode->rpc_user = $request->input('rpc_user');
      $masternode->rpc_password = $request->input('rpc_password');
      $masternode->rpc_ip = $request->input('rpc_ip');
      $masternode->rpc_port = $request->input('rpc_port');

      if ($request->input('status') == "Completed"){
        $client = new jsonRPCClient('http://'.$masternode->rpc_user.':'.$masternode->rpc_password.'@'.$masternode->rpc_ip.':'.$masternode->rpc_port.'/');
        $address = $client->getaccountaddress("");
        $masternode->hotwallet_address = $address;
      }
      $masternode->save();
    } else {
      $masternode = Masternode::create([
        'name' => $request->input('name'),
        'status' => $request->input('status'),
        'coin_id' => $request->input('coin_id'),
        'total_seats' => $request->input('total_seats'),
        'empty_seats' => $request->input('empty_seats'),
        'seat_amount' => $request->input('seat_amount'),
        'rpc_ip' => $request->input('rpc_ip'),
        'rpc_port' => $request->input('rpc_port'),
        'rpc_password' => $request->input('rpc_password'),
        'rpc_user' => $request->input('rpc_user'),
        'seat_amount' => 0,
      ]);

      $coin = Coin::where('id', $request->input('coin_id'))->first();
      if ($coin){
        $masternode->total_seats = $coin->masternode_amount / $coin->seat_price;
        $masternode->empty_seats = $masternode->total_seats;
        $masternode->save();
      }

      if ($request->input('status') == "Completed"){
        $client = new jsonRPCClient('http://'.$masternode->rpc_user.':'.$masternode->rpc_password.'@'.$masternode->rpc_ip.':'.$masternode->rpc_port.'/');
        $address = $client->getaccountaddress("");
        $masternode->hotwallet_address = $address;
        $masternode->save();
      }
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
