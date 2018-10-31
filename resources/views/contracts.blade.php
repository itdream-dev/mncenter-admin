@extends('layouts.app')

@section('content')
<style>
.userinfolabel {
  font-size:20px;
}
</style>
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Smart Contract</h2>
    <span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
    <span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
  </header>

  <!-- start: page -->
  <div class="row">
    @foreach ($contracts as $contract)
    <h2>{{$contract->net_type}}</h2>
    <form class="form-horizontal form-bordered" method="get" style="margin-top:10px">
      <div class="form-group">
        <label class="col-md-3 control-label" for="inputDefault" style="font-size:20px">Smart Contract Address:</label>
        @if ($contract->net_type == 'TestNet')
        <a target="_blank" href="https://kovan.etherscan.io/address/{{$contract->contract_address}}" class="col-md-9
         control-label" id="inputDefault" style="text-align:left;font-size:20px">{{$contract->contract_address}} (click it to go by Etherscan)</a>
        @else
        <a target="_blank" href="https://etherscan.io/address/{{$contract->contract_address}}" class="col-md-9
         control-label" id="inputDefault" style="text-align:left;font-size:20px">{{$contract->contract_address}} (click it to go by Etherscan)</a>
        @endif
      </div>
    </form>
    @endforeach
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
