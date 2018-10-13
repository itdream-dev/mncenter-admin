<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>

@extends('layouts.app')
@section('content')

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>
				Coin management
			</h2>
			<span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
			<span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($coin['id'])
							<h2 class="panel-title">Edit coin</h2>
						@else
							<h2 class="panel-title">Add new coin</h2>
						@endif

					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="/coin" method="post" encType="multipart/form-data">
							@if($coin['id'])
								<input type="hidden" name="id" value="{{$coin->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="name">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="coin_name" name="coin_name" value="{{$coin['coin_name']}}" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="coin_symbol">Symbol</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="coin_symbol" name="coin_symbol" value="{{$coin['coin_symbol']}}" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="masternode_amount">Seat Price</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="seat_price" name="seat_price" value="{{$coin['seat_price']}}" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="masternode_amount">Required MN Amount</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="masternode_amount" name="masternode_amount" value="{{$coin['masternode_amount']}}" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="status">Status</label>
								<div class="col-md-6">
									<select name="status" id="status" class="form-control mb-md">
											<option value="Active" @if($coin['status']=='Active') selected @endif>Active</option>
											<option value="Deactive" @if($coin['status']=='Deactive') selected @endif>Deactive</option>
									</select>
								</div>
							</div>


							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="save"></label>
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary" style="width:120px">Save</button>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(function(){
			$("#form").validate({
				highlight: function( label ) {
					$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				success: function( label ) {
					$(label).closest('.form-group').removeClass('has-error');
					label.remove();
				},
				errorPlacement: function( error, element ) {
					var placement = element.closest('.input-group');
					if (!placement.get(0)) {
						placement = element;
					}
					if (error.text() !== '') {
						placement.after(error);
					}
				}
			});
		});
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
