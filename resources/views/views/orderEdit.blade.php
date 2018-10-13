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
		@php
			function getCourseName($id, $courses) {
				foreach($courses as $course) {
					if($course->id == $id) {
						return $course->title;
					}
				}
		
				return "-";
			}
		@endphp
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
							<h2 class="panel-title">Edit order #{{$order['id']}}</h2>
						@else
							<h2 class="panel-title">Add new order</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/order" method="post" encType="multipart/form-data">
							@if($order['id'])
								<input type="hidden" name="id" value="{{$order->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="payment_method">Payment method</label>
								<div class="col-md-6">
									<label class="control-label label-left" id="payment_method" name="payment_method" style="font-weight:bold" required>{{$order['payment_method']}}</label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left">Order date</label>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</span>
										<input name="order_date" type="text" data-date-format="yyyy-mm-dd" data-plugin-datepicker class="form-control" value="{{$order['order_date']}}">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="courseId">Order state</label>
								<div class="col-md-6">
									<select class="form-control" name="order_state" id="order_state">
										<option value="Pending" @if ($order['order_state']=="Pending") selected @endif>Pending</option>
										<option value="Completed" @if ($order['order_state']=="Completed") selected @endif>Completed</option>
										<option value="Invoiced" @if ($order['order_state']=="Invoiced") selected @endif>Invoiced</option>
										<option value="Failed" @if ($order['order_state']=="Failed") selected @endif>Failed</option>
									</select>
								</div>
							</div>	
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="customer">Customer</label>
								<div class="col-md-6">
									<label class="control-label label-left" id="customer" name="customer" style="font-weight:bold">{{$order['customer']}}</label>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="customer_email">Customer Emai</label>
								<div class="col-md-6">
									<label class="control-label label-left" id="customer_email" name="customer_email" style="font-weight:bold">{{$order['customer_email']}}</label>
								</div>
							</div>							
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="billing_address">Billing address</label>
								<div class="col-md-6" style="padding:0">
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" style="font-weight:bold;" required>Country:</label>
										<div class="col-md-3">									
											<label class="control-label label-left" style="font-weight:bold;" required>{{$user['country']}}</label>
										</div>
									</div>	
											
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" style="font-weight:bold;" required>City:</label>
										<div class="col-md-3">									
											<label class="control-label label-left" style="font-weight:bold;" required>{{$user['city']}}</label>
										</div>
									</div>
									
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" style="font-weight:bold;" required>Postcode:</label>
										<div class="col-md-3">									
											<label class="control-label label-left" style="font-weight:bold;" required>{{$user['zipcode']}}</label>
										</div>
									</div>
									
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" style="font-weight:bold;" required>Street:</label>
										<div class="col-md-3">									
											<label class="control-label label-left" style="font-weight:bold;" required>{{$user['street_address']}}</label>
										</div>
									</div>	
									@if ($user['company'])
										@if ($user['eu_vat_num'])
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" style="font-weight:bold;" required>Eu vat:</label>
										<div class="col-md-3">									
											<label class="control-label label-left" style="font-weight:bold;" required>{{$user['eu_vat_num']}}</label>
										</div>
									</div>												
										@else
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" style="font-weight:bold;" required>Vat:</label>
										<div class="col-md-3">									
											<label class="control-label label-left" style="font-weight:bold;" required>{{$user['tax_num']}}</label>
										</div>
									</div>																					
										@endif
									@endif																
								</div>
							</div>
							

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="purchased_product">Purchased product</label>
								<div class="col-md-6">
									<label class="control-label label-left" id="purchased_product" name="purchased_product" style="font-weight:bold;" required>{{$purchased_product}}</label>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="purchased_product">Price</label>
								<div class="col-md-6" style="padding:0">		
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" id="price_vat" name="price_vat" style="font-weight:bold;" required>VAT</label>
										<div class="col-md-3">									
											<label class="control-label label-left" id="price_vat" name="price_vat" style="font-weight:bold;" required>{{number_format($order['price_vat'],2)}} HUF</label>
										</div>
									</div>	
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" id="price_net_amount" name="price_net_amount" style="font-weight:bold;" required>Net Amount</label>
										<div class="col-md-3">									
											<label class="control-label label-left" id="price_net_amount" name="price_net_amount" style="font-weight:bold;" required>{{number_format($order['price_net_amount'],2)}} HUF</label>
										</div>
									</div>	
									<div class="col-md-12" style="padding:0">									
										<label class="col-md-2 control-label label-left" id="price_total" name="price_total" style="font-weight:bold;" required>Total</label>
										<div class="col-md-3">									
											<label class="control-label label-left" id="price_total" name="price_total" style="font-weight:bold;" required>{{number_format($order['price_total'],2)}} HUF</label>
										</div>
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

</script>
@endsection
