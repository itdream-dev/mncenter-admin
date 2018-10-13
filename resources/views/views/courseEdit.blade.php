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
	@php
		function isSelectedItem($items, $id) {
			foreach ($items as $item) {
				if($item->id == $id)
					return true;
			}

			return false;
		}
	@endphp
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>
				Course management
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($course['id'])
							<h2 class="panel-title">Edit course</h2>
						@else
							<h2 class="panel-title">Add new course</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/course" method="post" encType="multipart/form-data">
							@if($course['id'])
								<input type="hidden" name="id" value="{{$course->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Course Title <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" required value="{{$course['title']}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Description</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="description" name="description">{{$course['description']}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="uploadPhoto">Course image</label>
								<div class="col-md-6">
									@if($course['id'] && $course['photo'])
									<img src="{{$course['photo']}}" style="max-height:200px;margin-bottom: 10px">
									@endif
									<input type="file" id="uploadPhoto" class="form-control" name="uploadPhoto" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isPublic">Public course?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="isPublic" value='1' data-plugin-ios-switch @if($course['is_public']) checked="checked" @endif/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isFree">Free course?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="isFree" value='1' data-plugin-ios-switch @if($course['is_free']) checked="checked" @endif/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isFree">Hide it from dashboard?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="isHide" value='1' data-plugin-ios-switch @if($course['is_hide']) checked="checked" @endif/>
									</div>
								</div>
							</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="levels">Levels</label>
									<div class="col-md-6">
										<select multiple data-plugin-selectTwo class="form-control populate" name="levels[]" id="levels" data-plugin-options='{ "placeholder": "Select levels", "allowClear": true }'>
											@foreach ($levels as $item)
												<option value="{{$item->id}}" @if($course['id'] && isSelectedItem($course->levels, $item->id)) selected @endif>{{$item->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="modules" >Modules</label>
									<div class="col-md-6">
										<select multiple data-plugin-selectTwo class="form-control populate" name="modules[]" id="modules" data-plugin-options='{ "placeholder": "Select modules", "allowClear": true }'>
											@foreach ($modules as $item)
												<option value="{{$item->id}}" @if($course['id'] && isSelectedItem($course->modules, $item->id)) selected @endif>{{$item->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="uploadPhoto">Add course banner</label>
									<div class="col-md-6">
										@if($course['id'] && $course['banner'])
										<img src="{{$course['banner']}}" style="max-height:200px;margin-bottom: 10px">
										@endif
										<input type="file" id="uploadBanner" class="form-control" name="uploadBanner" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="uploadPhoto">Add course banner<br>for mobile</label>
									<div class="col-md-6">
										@if($course['id'] && $course['banner_mobile'])
										<img src="{{$course['banner_mobile']}}" style="max-height:200px;margin-bottom: 10px">
										@endif
										<input type="file" id="uploadBannerMobile" class="form-control" name="uploadBannerMobile" >
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
