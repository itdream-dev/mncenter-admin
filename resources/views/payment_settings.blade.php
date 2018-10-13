@extends('layouts.app')

@section('content')
<style>
.userinfolabel {
  font-size:20px;
}
</style>
<section role="main" class="content-body">
  <header class="page-header">
    <h2>General Settings</h2>
    <span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
    <span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
  </header>

  <!-- start: page -->
  <div class="row">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Payment Settings</h2>
      </header>
      <div class="panel-body">
        @include('common.errors')
						<form id="settingForm" role="form" class="form-horizontal form-bordered" action="/payment_settings" method="post">
							<div id="save-result-div" class="row" style="display:none;z-index:2;position:absolute; overflow:visible;  left:35%; top:-75px;border-radius:8px; width:35%; height:60px; background-color:#dff0d8">
										<div class="col-md-11" style="padding-top:15px; text-align:center; ">
											<span style="font-weight:bold; font-size:16px; color:#3c763d;">Settings has been successfully saved.</span>
										</div>
										<div class="col-md-1" style="padding-top:15px;float:right">
											<i aria-hidden="true" class="fa fa-close" onclick="closeSave(event)" style="float:right;"></i>
									  </div>
							</div>

              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="enable_auto_reward">Enable Auto Reward?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" id="enable_auto_reward" name="enable_auto_reward" onchange="Enable()" value='0' data-plugin-ios-switch @if (isset($settings['enable_auto_reward'])) @if($settings['enable_auto_reward']) checked="checked" @endif @endif/>
									</div>
								</div>
							</div>

              @foreach ($coins as $coin)
                <div class="form-group">
                  <label class="col-md-3 control-label label-left" for="wallet">{{$coin->coin_name}} Wallet</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="{{$coin->coin_name}}" name="{{$coin->coin_name}}" value="{{isset($settings[$coin->coin_name])? $settings[$coin->coin_name]:''}}">
                  </div>
                </div>
              @endforeach

              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="save">Save</label>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary" style="width:120px">Save</button>
                </div>
              </div>
            </form>
      </div>
    </section>
  </div>
  <!-- end: page -->
</section>
<script>
@if ($message = Session::get('success'))
  document.getElementById('save-result-div').style.display = 'inline';
@endif
function closeSave(e)
{
   document.getElementById('save-result-div').style.display = 'none';
}
$(document).ready(function(){
  jQuery.get('https://api.coinmarketcap.com/v1/ticker/ethereum/', function(data, status){
    $('.ether_unit').html('1ETH = $' + data[0].price_usd);
  });
});

function Enable(){
  value = document.getElementById('enable_auto_reward').checked;
  if (value == true)
  {
    document.getElementById('enable_auto_reward').value = 1;
  }
  else
  {
    document.getElementById('enable_auto_reward').value = 0;
  }
}
</script>
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
