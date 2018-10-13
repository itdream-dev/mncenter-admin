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
				Top Alert
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					<h2 class="panel-title">Top Alert Setting</h2>
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/postTopalert" method="post" encType="multipart/form-data">
							<div id="save-result-div" class="row" style="display:none;z-index:2;position:absolute; overflow:visible;  left:35%; top:-75px;border-radius:8px; width:35%; height:60px; background-color:#dff0d8">
										<div class="col-md-11" style="padding-top:15px; text-align:center; ">
											<span style="font-weight:bold; font-size:16px; color:#3c763d;">Top Alert has been successfully saved.</span>
										</div>
										<div class="col-md-1" style="padding-top:15px;float:right">
											<i aria-hidden="true" class="fa fa-close" onclick="closeSave(event)" style="float:right;"></i>
									  </div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="alert_text">Top alert text:</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="alert_text" name="alert_text" style="min-height:100px">@if($topalert){{$topalert['alert_text']}}@endif</textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="is_show_count">Show Countdown?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="is_show_count" value='1' data-plugin-ios-switch @if($topalert['is_show_count']) checked="checked" @endif/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left">Countdown</label>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</span>
										<input id="countdown" name="countdown" type="text" data-plugin-datepicker class="form-control" value="<?php if ($topalert['countdown'] != '') echo date('m/d/Y', strtotime($topalert['countdown'])); ?>">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="enable_top_alert">Enable Top Alert?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="enable_top_alert" value='1' data-plugin-ios-switch @if($topalert['enable_top_alert']) checked="checked" @endif/>
									</div>
								</div>
							</div>

							<div class="row" style="padding-left:20px">
								<button type="submit" class="btn btn-primary" style="width:120px">{!! trans('flashcard.save') !!}</button>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
	</section>
	<script>
	@if ($message = Session::get('success'))
		document.getElementById('save-result-div').style.display = 'inline';
	@endif
	function closeSave(e)
	{
		 document.getElementById('save-result-div').style.display = 'none';
	}
	</script>
@endsection
