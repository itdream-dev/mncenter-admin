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
						<h2 class="panel-title">Shopping cart settings</h2>
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="settingForm" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/shoppingcartsettings" method="post">
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
									<label class="col-md-2 control-label label-left" for="siteTitle" style="font-size:20px; padding-left:40px;">Currency</label>
								</div>
								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="siteTitle" style="padding:0; padding-left:80px;">Hungarian Forint</label>
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
									<label class="col-md-2 control-label label-left" for="siteTitle" style="font-size:20px; padding-left:40px;">Payment methods</label>
								</div>
								<!----------  Barion  ------------>
								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-3 control-label label-left" for="siteTitle" style="font-weight:bold; font-size:14px;padding-left:40px;">Barion - Credit card payment</label>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="is_sidebar" style="padding-left:40px;">Enable/Disable</label>
									<div class="col-md-6">
										<div class="switch switch-primary">
											<input type="checkbox" id="barion_enabled" name="barion_enabled" value='1' data-plugin-ios-switch @if($settings['barion_enabled']) checked="checked" @endif/>
										</div>
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="title" style="padding-left:40px;">Title</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="barion_title" name="barion_title" required value="{{$settings['barion_title']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="description" style="padding-left:40px;">Description</label>
									<div class="col-md-6">
										<textarea type="text" class="form-control" id="barion_description" name="barion_description" required>{{$settings['barion_description']}}</textarea>
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="barion_secret_key" style="padding-left:40px;">Secret key (POSKey)</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="barion_secret_key" name="barion_secret_key" required value="{{$settings['barion_secret_key']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="barion_email" style="padding-left:40px;">Barion eamil</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="barion_email" name="barion_email" required value="{{$settings['barion_email']}}">
									</div>
								</div>

								<!----------  Paypal  ------------>
								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-3 control-label label-left" for="siteTitle" style="font-weight:bold; font-size:14px;padding-left:40px;">PayPal payment</label>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="paypal_enabled" style="padding-left:40px;">Enable/Disable</label>
									<div class="col-md-6">
										<div class="switch switch-primary">
											<input type="checkbox" id="paypal_enabled" name="paypal_enabled" value='1' data-plugin-ios-switch @if($settings['paypal_enabled']) checked="checked" @endif/>
										</div>
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="paypal_title" style="padding-left:40px;">Title</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="paypal_title" name="paypal_title" required value="{{$settings['paypal_title']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="paypal_description" style="padding-left:40px;">Description</label>
									<div class="col-md-6">
										<textarea type="text" class="form-control" id="paypal_description" name="paypal_description" required>{{$settings['paypal_description']}}</textarea>
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="paypal_identify_token" style="padding-left:40px;">Paypal identify token</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="paypal_identify_token" name="paypal_identify_token" required value="{{$settings['paypal_identify_token']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="paypal_email" style="padding-left:40px;">Paypal email</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="paypal_email" name="paypal_email" required value="{{$settings['paypal_email']}}">
									</div>
								</div>

								<!------Bank transfer payment ------------->

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-3 control-label label-left" for="siteTitle" style="font-weight:bold; font-size:14px;padding-left:40px;">Bank transfer payment</label>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="is_sidebar" style="padding-left:40px;">Enable/Disable</label>
									<div class="col-md-6">
										<div class="switch switch-primary">
											<input type="checkbox" id="bank_enabled" name="bank_enabled" value='1' data-plugin-ios-switch @if($settings['bank_enabled']) checked="checked" @endif/>
										</div>
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_title" style="padding-left:40px;">Title</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bank_title" name="bank_title" required value="{{$settings['bank_title']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_description" style="padding-left:40px;">Description</label>
									<div class="col-md-6">
										<textarea type="text" class="form-control" id="bank_description" name="bank_description" required>{{$settings['bank_description']}}</textarea>
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_account_name" style="padding-left:40px;">Account name</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bank_account_name" name="bank_account_name" required value="{{$settings['bank_account_name']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_title" style="padding-left:40px;">Account number</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bank_account_number" name="bank_account_number" required value="{{$settings['bank_account_number']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_name" style="padding-left:40px;">Bank name</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bank_name" name="bank_name" required value="{{$settings['bank_name']}}">
									</div>
								</div>


								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_iban_number" style="padding-left:40px;">IBAN number</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bank_iban_number" name="bank_iban_number" required value="{{$settings['bank_iban_number']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_bic_swift" style="padding-left:40px;">BIC / Swift</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="bank_bic_swift" name="bank_bic_swift" required value="{{$settings['bank_bic_swift']}}">
									</div>
								</div>

								<div class="class-md-12 row" style="padding-top:20px">
									<label class="col-md-2 control-label label-left" for="bank_instructions" style="padding-left:40px;">Instruction</label>
									<div class="col-md-6">
										<textarea type="text" class="form-control" id="bank_instructions" name="bank_instructions" required>{{$settings['bank_instructions']}}</textarea>
									</div>
								</div>								
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
