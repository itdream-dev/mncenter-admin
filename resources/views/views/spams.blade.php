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
				Spam Management
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					<h2 class="panel-title">Add Spams</h2>
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/spam" method="post" encType="multipart/form-data">

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Spam Emails</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="spam_emails" name="spam_emails" style="min-height:300px">@if($spam){{$spam['spam_emails']}}@endif</textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Spam Domains</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="spam_domains" name="spam_domains" style="min-height:300px">@if($spam){{$spam['spam_domains']}}@endif</textarea>
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
@endsection
