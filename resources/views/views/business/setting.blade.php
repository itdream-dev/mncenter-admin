<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>

@extends('layouts.back')
@section('content')
	<section role="main" class="content-body">

		<header class="page-header">
		<h2>
			{!! trans('flashcard.generalSettings') !!}
		</h2>
		</header>

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Business settings</h2>
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="settingForm" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/business_setting" method="post">
							<div id="save-result-div" class="row" style="display:none;z-index:2;position:absolute; overflow:visible;  left:35%; top:-75px;border-radius:8px; width:35%; height:60px; background-color:#dff0d8">
										<div class="col-md-11" style="padding-top:15px; text-align:center; ">
											<span style="font-weight:bold; font-size:16px; color:#3c763d;">Settings has been successfully saved.</span>
										</div>
										<div class="col-md-1" style="padding-top:15px;float:right">
											<i aria-hidden="true" class="fa fa-close" onclick="closeSave(event)" style="float:right;"></i>
									  </div>
							</div>

							<div class="form-group">
								<div class="class-md-12 row">
									<label class="col-md-2 control-label label-left" for="currency" style="font-size:20px; padding-left:40px;">Currency</label>
								</div>
								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="currency" style="padding:0; padding-left:80px;">Hungarian Forint</label>
									<div class="col-md-6" style="">
										<div class="radio-custom radio-primary">
											<input type="radio" id="radio_currency" name="currency" value="HUF" @if ($settings['currency'] == "HUF") checked @endif>
											<label for="radio_currency">Example: 13,990 Ft</label>
										</div>
									</div>
								</div>
								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="siteTitle" style="padding:0; padding-left:80px;">US dollar</label>
									<div class="col-md-6" style="">
										<div class="radio-custom radio-primary">
											<input type="radio" id="radio_currency" name="currency" value="USD" @if ($settings['currency'] == "USD") checked @endif>
											<label for="radio_currency">Example: $49,99</label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="class-md-12 row">
									<label class="col-md-2 control-label label-left" for="siteTitle" style="font-size:20px; padding-left:40px;">Pricing Options</label>
								</div>
								@foreach ($licenses as $license)
								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="title" style="padding-left:40px;">{{$license->license_name}}</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="{{$license->id}}" name="license_{{$license->id}}" required value="{{$license['price']}}">
									</div>
								</div>
								@endforeach
							</div>
							<div>
								<button type="submit" class="btn btn-primary" style="width:120px">{!! trans('flashcard.save') !!}</button>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
	</section>
	<script type="text/javascript">

		@if ($message = Session::get('success'))
			document.getElementById('save-result-div').style.display = 'inline';
		@endif
		function closeSave(e)
		{
			 document.getElementById('save-result-div').style.display = 'none';
		}
		$(function(){
			$("#settingForm").validate({
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
