@extends('layouts.app')

@section('content')

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Dashboard </h2>
    <span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
    <span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
  </header>

  <!-- start: page -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-4">
          <section class="panel panel-featured-left panel-featured-secondary">
            <div class="panel-body">
              <div class="widget-summary">
                <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-secondary">
                    <i class="fa fa-usd"></i>
                  </div>
                </div>
                <div class="widget-summary-col">
                  <div class="summary">
                    <h4 class="title">Total Sale Count</h4>
                    <div class="info">
                      <strong class="amount">{{count($sales)}}</strong>
                    </div>
                  </div>
                  <div class="summary-footer">
                    <a class="text-muted text-uppercase"></a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
          <section class="panel panel-featured-left panel-featured-secondary">
            <div class="panel-body">
              <div class="widget-summary">
                <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-secondary">
                    <i class="fa fa-usd"></i>
                  </div>
                </div>
                <div class="widget-summary-col">
                  <div class="summary">
                    <h4 class="title">Total Rewards Count</h4>
                    <div class="info">
                      <strong class="amount">{{count($rewards)}}</strong>
                    </div>
                  </div>
                  <div class="summary-footer">
                    <a class="text-muted text-uppercase"></a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
          <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
              <div class="widget-summary">
                <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-tertiary">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                </div>
                <div class="widget-summary-col">
                  <div class="summary">
                    <h4 class="title">Next Reward Time</h4>
                    <div class="info">
                      <strong class="amount">{{$next_reward_time}}</strong>
                    </div>
                  </div>
                  <div class="summary-footer">
                    <a class="text-muted text-uppercase"></a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xl-12" style="margin-top:50px">
      <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-6">
          <section class="panel">
            <header class="panel-heading" style="background-color:#5355a9">
              <h2 class="panel-title" style="color:#fff">Latest Sales</h2>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table mb-none">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Coin Type</th>
                      <th>Seats</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sales as $sale)
                      <tr>
                        <td>{{$sale->id}}</td>
                        <td>@if (isset($sale->user->name)) {{$sale->user->name}} @endif</td>
                        <td>@if (isset($sale->coin->coin_name)) {{$sale->coin->coin_name}} @endif</td>
                        <td>{{$sale->sales_amount}}</td>
                        <td>{{$sale->total_price}}</td>
                        <td>{{$sale->created_at}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-6">
          <section class="panel">
            <header class="panel-heading" style="background-color:#5355a9">
              <h2 class="panel-title" style="color:#fff">Lastest Rewards</h2>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table mb-none">
                  <thead>
                    <tr>
                      <th>Masternode ID</th>
                      <th>Coin</th>
                      <th>User</th>
                      <th>Rewarded Type</th>
                      <th>Rewarded Amount</th>
                      <th>Rewarded Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rewards as $reward)
                      <tr>
                        <td>@if (isset($reward->masternode_id)) {{$reward->masternode_id}} @endif</td>
                        <td>@if (isset($reward->masternode->coin->coin_name)) {{$reward->masternode->coin->coin_name}} @endif</td>
                        <td>@if (isset($reward->user->name)) {{$reward->user->name}} @endif</td>
                        <td>{{$reward->type}}</td>
                        <td>{{$reward->reward_amount}}</td>
                        <td>{{$reward->created_at}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>


    <!-- end: page -->
  </section>
  <script>
  $(document).ready(function(){
    jQuery.get('https://api.coinmarketcap.com/v1/ticker/ethereum/', function(data, status){
      $('.ether_unit').html('1ETH = $' + parseFloat(data[0].price_usd).toFixed(2));
    });
  });

  $(document).ready(function(){
    jQuery.get('https://api.coinmarketcap.com/v1/ticker/bitcoin/', function(data, status){
      $('.btc_unit').html('1BTC = $' + parseFloat(data[0].price_usd).toFixed(2));
    });
  });


  </script>
  @endsection
