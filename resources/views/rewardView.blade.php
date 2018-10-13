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
				Reward management
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
							<h2 class="panel-title">View Reward</h2>
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="/reward" method="post" encType="multipart/form-data">
							@if($reward['id'])
								<input type="hidden" name="id" value="{{$reward->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="status">User</label>
								<div class="col-md-6">
									<select name="status" id="status" class="form-control mb-md">
										@foreach ($users as $user)
											<option value="{{$user->id}}" @if($user['id']==$reward->user_id) selected @endif>{{$user->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="coin_symbol">Symbol</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="coin_symbol" name="coin_symbol">{{$coin['coin_symbol']}}</input>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="masternode_amount">Required MN Amount</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="masternode_amount" name="masternode_amount">{{$coin['masternode_amount']}}</input>
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
@endsection
