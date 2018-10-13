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
				Orders
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($order['id'] != null)
							<h2 class="panel-title">Edit company order #{{$order['id']}}</h2>
						@else
							<h2 class="panel-title">Add new company</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/businessorder" method="post" encType="multipart/form-data">
							@if($order['id'])
								<input type="hidden" name="id" value="{{$order->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="payment_method">Company name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="company_name" name="company_name" value="{{$order['company_name']}}" required></input>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="company_address">Company address</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="company_address" name="company_address" value="{{$order['company_address']}}" required></input>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="tax">Tax ID</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="tax" name="tax" value="{{$order['tax']}}" required></input>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="company_email">Email address</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="company_email" name="company_email" value="{{$order['company_email']}}" required></input>
								</div>
							</div>
							@if(!$order['id'])
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="password">Set Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" id="password" name="password" required></input>
								</div>
							</div>
							@endif

							@if($order['id'])
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isResetPassword">Reset password?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" id="isResetPassword" name="isResetPassword" onchange="Resetpassword()" value='0' data-plugin-ios-switch />
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="password">Password<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="password" class="form-control" id="reset_password" name="reset_password" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="passwordConfirm">Confirm password<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="password" class="form-control" id="reset_password_confirm" name="reset_password_confirm" disabled>
								</div>
							</div>
							@endif

							<div class="form-group">
								<label class="col-md-3 control-label label-left"># of license</label>
								<div class="col-md-6">
									<div data-plugin-spinner>
										<div class="input-group input-small">
											<input type="text" class="spinner-input form-control" id="licenses" name="licenses" readonly="readonly" value="{{$order['licenses']}}">
											<div class="spinner-buttons input-group-btn btn-group-vertical">
												<button type="button" class="btn spinner-up btn-xs btn-default">
													<i class="fa fa-angle-up"></i>
												</button>
												<button type="button" class="btn spinner-down btn-xs btn-default">
													<i class="fa fa-angle-down"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="price_licenses">Price/License</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="price_licenses" name="price_licenses" value="{{$order['price_licenses']}}" required></input>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="courseId">Payment Method</label>
								<div class="col-md-6">
									<select class="form-control" name="order_state" id="order_state">
										<option value="paypal" @if ($order['payment_method']=="paypal") selected @endif>Paypal</option>
										<option value="barion" @if ($order['payment_method']=="barion") selected @endif>Barion</option>
										<option value="bank" @if ($order['payment_method']=="bank") selected @endif>Bank</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left">Expriation Date</label>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</span>
										<input name="expiration_date" type="text" data-date-format="yyyy-mm-dd" data-plugin-datepicker class="form-control" value="{{$order['expiration_date']}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="courseId">Status</label>
								<div class="col-md-6">
									<select class="form-control" name="status" id="status">
										<option value="Pending" @if ($order['status']=="Pending") selected @endif>Pending</option>
										<option value="Completed" @if ($order['status']=="Completed") selected @endif>Completed</option>
										<option value="Invoiced" @if ($order['status']=="Invoiced") selected @endif>Invoiced</option>
										<option value="Failed" @if ($order['status']=="Failed") selected @endif>Failed</option>
									</select>
								</div>
							</div>

							<div>
								<button type="submit" class="btn btn-primary" style="width:120px" onclick="Save()">{!! trans('flashcard.save') !!}</button>
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
		rules: {
			password: "required",
			passwordConfirm: {
				equalTo: "#password"
			}
		},
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

function Save(){
	var isReset = document.getElementById('isResetPassword');

	if (isReset && isReset.checked)
	{
		resetpassword = document.getElementById('reset_password').value;
		reset_password_confirm = document.getElementById('reset_password_confirm').value;

		bvalidation = false;
		if (resetpassword.length > 5 && reset_password_confirm.length > 5)
		{
			if (resetpassword == reset_password_confirm)
			{
				bvalidation = true;
			}
		}
		if (!bvalidation)
		{
			new PNotify({
				text: 'please check reset password fields again. (len > 5, equal)',
				type: 'error',
				icon: false,
				addclass: 'ui-pnotify-no-icon',
			});
			return;
		}
	}
	$('#form').submit();
}

function Resetpassword(){
	value = document.getElementById('isResetPassword').checked;
	if (value == true)
	{
		document.getElementById('reset_password').disabled = false;
		document.getElementById('reset_password_confirm').disabled = false;
		document.getElementById('isResetPassword').value = 1;
	}
	else
	{
		document.getElementById('reset_password').disabled = true;
		document.getElementById('reset_password_confirm').disabled = true;
		document.getElementById('isResetPassword').value = 0;
	}
}
</script>
@endsection
