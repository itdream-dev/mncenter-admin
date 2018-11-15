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
              <h2 class="panel-title" style="color:#fff">Latest Transactions</h2>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table mb-none">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Type</th>
                      <th>Coin Type</th>
                      <th>User</th>
                      <th>Seats</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td>15125125</td>
                      <td>Sales</td>
                      <td>ALQO (XLQ)</td>
                      <td>AN7v8PqrmGncpkzYnpdfxwpFvXPKsrcUso</td>
                      <td>5</td>
                      <td>500</td>
                      <td>2018-08-31</td>
                    </tr>
                    <tr>
                      <td>15125124</td>
                      <td>Reward</td>
                      <td>Bitcoin Green (BITG)</td>
                      <td>AN7v8PqrmGncpkzYnpdfxwpFvXPKsrcUso</td>
                      <td>4</td>
                      <td>400</td>
                      <td>2018-08-28</td>
                    </tr>
                    <tr>
                      <td>15125123</td>
                      <td>Sales</td>
                      <td>Digiwage (WAGE)</td>
                      <td>AN7v8PqrmGncpkzYnpdfxwpFvXPKsrcUso</td>
                      <td>3</td>
                      <td>300</td>
                      <td>2018-08-25</td>
                    </tr>
                    <tr>
                      <td>15125122</td>
                      <td>Reward</td>
                      <td>Denarius (DNR)</td>
                      <td>AN7v8PqrmGncpkzYnpdfxwpFvXPKsrcUso</td>
                      <td>5</td>
                      <td>500</td>
                      <td>2018-08-18</td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-6">
          <section class="panel">
            <header class="panel-heading" style="background-color:#5355a9">
              <h2 class="panel-title" style="color:#fff">Top Seat Owners</h2>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table mb-none">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Own Seat count</th>
                      <th>Rewarded Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td>1</td>
                      <td>Mark</td>
                      <td>105</td>
                      <td>15,125$</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Jacob</td>
                      <td>88</td>
                      <td>12,125$</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Larry</td>
                      <td>70</td>
                      <td>9,125$</td>
                    </tr> -->
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
