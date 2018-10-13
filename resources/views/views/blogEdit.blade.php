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
        @if($blog['id'])
          <h2 class="panel-title">Edit blog</h2>
        @else
          <h2 class="panel-title">Add new blog</h2>
        @endif
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($blog['id'])
							<h2 class="panel-title">Edit blog</h2>
						@else
							<h2 class="panel-title">Add new blog</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="blog-form" name="blog-form", role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/blog" method="post" encType="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" name="blogcats" value="">
							@if($blog['id'])
								<input type="hidden" name="id" value="{{$blog->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Post title</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" required value="{{$blog['title']}}">
								</div>
							</div>

              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="title">Post content</label>
                <div class="col-md-6">
                  <textarea type="text" class="summernote" id="content" name="content" style="height:271px; width:100%" style="height:271px; width:100%" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" }}'>{{$blog['content']}}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="uploadPhoto">Featured image</label>
                <div class="col-md-6">
                  @if($blog['id']&&$blog['featured_image'])
                  <img src="{{$blog['featured_image']}}" style="max-height:200px;margin-bottom: 10px">
                  @endif
                  <input type="file" id="uploadPhoto" class="form-control" name="uploadPhoto" >
                </div>
              </div>
              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="seo_title">SEO title</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$blog['seo_title']}}">
								</div>
							</div>

              <!--<div class="form-group">
                <label class="col-md-3 control-label label-left" for="is_image">Show featured image?</label>
                <div class="col-md-6">
                  <div class="switch switch-primary">
                    <input type="checkbox" id="is_image" name="is_image" value='1' data-plugin-ios-switch @if($blog['is_image']) checked="checked" @endif/>
                  </div>
                </div>
              </div>-->

			  <div class="form-group">
                <label class="col-md-3 control-label label-left" for="is_sidebar">Show sidebar?</label>
                <div class="col-md-6">
                  <div class="switch switch-primary">
                    <input type="checkbox" id="is_sidebar" name="is_sidebar" value='1' data-plugin-ios-switch @if($blog['is_sidebar']) checked="checked" @endif/>
                  </div>
                </div>
              </div>
			  
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="Category">Select Category</label>
                <div class="col-sm-6">
									@foreach ($blogcats as $item)
                  <div class="col-sm-2">
									  <div class="checkbox-custom checkbox-default" style="margin-bottom:10px">
										   <input id="catCheck" value="{{$item->id}}" type="checkbox" name="category">
										   <label for="Category">{{$item->title}}</label>
									  </div>
                  </div>
                	@endforeach
								</div>
              </div>

              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="seo_description">SEO description</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="seo_description" name="seo_description" value="{{$blog['seo_description']}}">
								</div>
							</div>

              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="seo_keywords">SEO keywords</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" value="{{$blog['seo_keywords']}}">
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


	$(function() {
		var ids='';
		@if ($blog['id'])
		@foreach ($blog->blogcats as $itemcat)
			ids = ids + "{{$itemcat['id']}}" + ',';
		@endforeach
		@endif
		$("input#catCheck").each(function(){
			if(ids.indexOf(this.value) != -1) {
				this.checked = true;
			}
		})

		$("#blog-form").submit(function(e){
		  var title = document.getElementById('title').value;
		  var static_url = title.trim().replace(/\s/g, '-').toLowerCase();
//			var content = document.getElementById('content').textContent;
			if ($('.summernote').summernote('codeview.isActivated')) {
					$('.summernote').summernote('codeview.deactivate');
			}
			@foreach ($blogs as $item)
				@if($blog['id'])
					@if($blog['id'] == $item['id'])
						@continue;
					@endif
				@endif
				if ("{{$item['static_url']}}" == static_url)
				{
					new PNotify({
							text: 'Blog Url will be overlap. Please input another blog title.',
							type: 'error',
							icon: false,
							addclass: 'ui-pnotify-no-icon',
					});
					e.preventDefault();
					e.stopPropagation();
					return false;
				}
			@endforeach

			blogcats = "";
			$("input#catCheck").each(function(){
				if(this.checked) {
					blogcats += this.value + ","
				}
			});

			if(blogcats == "") {
				alert("{!! trans('flashcard.pleaseSelectCategory') !!}");
				return false;
			}

			blogcats = blogcats.substr(0, blogcats.length - 1);

			$("input[name=blogcats]").val(blogcats);
		})
	})
	</script>
@endsection
