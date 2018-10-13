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
use App\Referral;
use App\Coin;

class ReferralController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function referrals(Request $request)
  {
    $referrals = Referral::paginate(50);
    foreach ($referrals as $referral){
      $referred_by = User::where('id', $referral->referred_by)->first();
      $referral->referred_by = $referred_by;
    }
    return view('referrals', [
      'referrals' => $referrals
    ]);
  }


  public function destroy($id)
  {
    $u = Referral::findOrNew($id);
    //$this->authorize('destroy', $category);
    //Cat::destroy([$category]);
    $u->delete();
    $ret = array("result"=>"ok");
    return json_encode($ret);
  }
}
