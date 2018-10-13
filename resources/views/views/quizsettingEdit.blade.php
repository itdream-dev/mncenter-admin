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
				Quiz setting
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($quizsetting['id'])
							<h2 class="panel-title">Edit quizsetting</h2>
						@else
							<h2 class="panel-title">Add new quizsetting</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/quizsetting" method="post" encType="multipart/form-data">
							@if($quizsetting['id'])
								<input type="hidden" name="id" value="{{$quizsetting->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="term">term<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="term" name="term" placeholder="example: I'm|I am|i'm|i am" required value="{{$quizsetting['term']}}">
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
