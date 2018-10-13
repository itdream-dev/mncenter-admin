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
						<h2 class="panel-title">General Settings</h2>
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="settingForm" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/setting" method="post">
							<div id="save-result-div" class="row" style="display:none;z-index:2;position:absolute; overflow:visible;  left:35%; top:-75px;border-radius:8px; width:35%; height:60px; background-color:#dff0d8">
										<div class="col-md-11" style="padding-top:15px; text-align:center; ">
											<span style="font-weight:bold; font-size:16px; color:#3c763d;">Settings has been successfully saved.</span>
										</div>
										<div class="col-md-1" style="padding-top:15px;float:right">
											<i aria-hidden="true" class="fa fa-close" onclick="closeSave(event)" style="float:right;"></i>
									  </div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="siteTitle">Site Title<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="siteTitle" name="siteTitle" value="{{isset($settings['siteTitle'])? $settings["siteTitle"]:''}}" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="siteDesc">Site Description</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="siteDesc" name="siteDesc" value="{{isset($settings['siteDesc'])? $settings["siteDesc"]:''}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="keywords">Site Keywords</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="keywords" name="keywords" value="{{isset($settings['keywords'])? $settings["keywords"]:''}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="siteEmail">Site Email<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="email" class="form-control" id="siteEmail" name="siteEmail" value="{{isset($settings['siteEmail'])? $settings["siteEmail"]:''}}" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="lang">Site Language<span class="required">*</span></label>
								<div class="col-md-6">
									<select name="lang" id="lang" class="form-control bfh-languages mb-md" data-language="{{App::getLocale()}}" data-available="{{$langStr}}" data-blank=false requried></select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="gaCode">GTM Head Code</label>
								<div class="col-md-6">
									<textarea class="form-control" rows="5" data-plugin-textarea-autosize id="gaCode" name="gaCode">{{isset($settings['gaCode'])? $settings["gaCode"]:''}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="gaCode">GTM Body Code</label>
								<div class="col-md-6">
									<textarea class="form-control" rows="5" data-plugin-textarea-autosize id="gaBodyCode" name="gaBodyCode">{{isset($settings['gaBodyCode'])? $settings["gaBodyCode"]:''}}</textarea>
								</div>
							</div>
							<!--<div class="form-group">
								<label class="col-md-3 control-label label-left" for="gaCode">Facebook Pixel Code</label>
								<div class="col-md-6">
									<textarea class="form-control" rows="5" data-plugin-textarea-autosize id="facebook_pixel_code" name="facebook_pixel_code">{{isset($settings['facebook_pixel_code'])? $settings["facebook_pixel_code"]:''}}</textarea>
								</div>
							</div>-->

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="cookie">EU cookie law URL</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="cookieUrl" name="cookieUrl" value="{{isset($settings['cookieUrl'])? $settings["cookieUrl"]:''}}">
								</div>
							</div>
							<div class="form-group">
								<h3 class="panel-title" style="padding-left:15px">Save new users to Sendy</h3>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="enable_sendy">Enable?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" id="enable_sendy" name="enable_sendy" onchange="EnableSendy()" value='0' data-plugin-ios-switch @if($settings['enable_sendy']) checked="checked" @endif/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="cookie">Sendy list ID</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="sendy_list_id" name="sendy_list_id" value="{{isset($settings['sendy_list_id'])? $settings["sendy_list_id"]:''}}">
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

		function EnableSendy(){
			value = document.getElementById('enable_sendy').checked;
			if (value == true)
			{
				document.getElementById('enable_sendy').value = 1;
			}
			else
			{
				document.getElementById('enable_sendy').value = 0;
			}
		}
	</script>
@endsection
