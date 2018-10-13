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
				Video management
			</h2>
			<span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
			<span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($video['id'])
							<h2 class="panel-title">Edit video</h2>
						@else
							<h2 class="panel-title">Add new video</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="/video" method="post" encType="multipart/form-data">
							@if($video['id'])
								<input type="hidden" name="id" value="{{$video->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="name">Title</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" value="{{$video['title']}}"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Description</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="description" name="description">{{$video['description']}}</textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="name">Link (youtube,vimeo)</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="link" name="link" value="{{$video['link']}}"/>
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
