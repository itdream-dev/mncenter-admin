<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Reward;
use App\Paymentsetting;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('UTC');
        $this->middleware(['auth', '2fa'] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::where('status', 'completed')->get();
        $rewards = Reward::where('status', 'completed')->get();
        $codeList = Paymentsetting::all();
        $payment_settings = [];
        for($i = 0; $i < count($codeList); $i++) {
          $payment_settings[$codeList[$i]["name"]] = $codeList[$i]["value"];
        }

        $date = Carbon::parse('this sunday')->toDateTimeString();
        return view('home', [
          'sales' => $sales,
          'rewards' => $rewards,
          'next_reward_time' => $date
        ]);
    }
}
