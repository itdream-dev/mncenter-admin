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
				Masternode management
			</h2>
			<span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
			<span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($masternode['id'])
							<h2 class="panel-title">Edit masternode</h2>
						@else
							<h2 class="panel-title">Add new masternode</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="/masternode" method="post" encType="multipart/form-data">
							@if($masternode['id'])
								<input type="hidden" name="id" value="{{$masternode->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="name">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="name" name="name" value="{{$masternode['name']}}"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="coin_id">Coin Type <span class="required">*</span></label>
								<div class="col-md-6">
									<select name="coin_id" id="coin_id" class="form-control mb-md">
										@foreach ($coins as $coin)
											<option value="{{$coin->id}}" @if($coin['id']==$masternode['coin_id']) selected @endif>{{$coin->coin_name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="status">Status</label>
								<div class="col-md-6">
									<select name="status" id="status" class="form-control mb-md">
											<option value="Preparing" @if($masternode['status']=='Preparing') selected @endif>Preparing</option>
											<option value="Completed" @if($masternode['status']=='Completed') selected @endif>Completed</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="total_seats">Total Seats Count</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="total_seats" name="total_seats" value="{{$masternode['total_seats']}}"/>
								</div>
							</div>


							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="empty_seats">Empty Seats</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="empty_seats" name="empty_seats" value="{{$masternode['empty_seats']}}"/>
								</div>
							</div>

							<div class="form-group" style="display:none">
								<label class="col-md-3 control-label label-left" for="seat_amount">Seat Amount</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="seat_amount" name="seat_amount" value="{{$masternode['seat_amount']}}"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="seat_amount">Rpc IP</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="rpc_ip" name="rpc_ip" value="{{$masternode['rpc_ip']}}"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="rpc_port">Rpc Port</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="rpc_port" name="rpc_port" value="{{$masternode['rpc_port']}}"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="rpc_username">Rpc UserName</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="rpc_username" name="rpc_username" value="{{$masternode['rpc_username']}}"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="rpc_password">Rpc Password</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="rpc_password" name="rpc_password" value="{{$masternode['rpc_password']}}"/>
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
