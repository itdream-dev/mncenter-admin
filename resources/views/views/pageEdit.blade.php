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
        @if($page['id'])
          <h2 class="panel-title">Edit page</h2>
        @else
          <h2 class="panel-title">Add new page</h2>
        @endif
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($page['id'])
							<h2 class="panel-title">Edit page</h2>
						@else
							<h2 class="panel-title">Add new page</h2>
						@endif
					</header>				
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/page" method="post" encType="multipart/form-data">
							@if($page['id'])
								<input type="hidden" name="id" value="{{$page->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Page Title <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" required value="{{$page['title']}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="content">Page Full Width Content</label>
								<div class="col-md-7">
									<textarea type="text" class="form-control" id="full_width_content" name="full_width_content" style="min-height:300px">{{$page['full_width_content']}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="content">Page Content</label>
								<div class="col-md-7">
									<textarea type="text" class="form-control" id="content" name="content" style="min-height:300px">{{$page['content']}}</textarea>
								</div>
							</div>
              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="seo_title">SEO title<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$page['seo_title']}}">
								</div>
							</div>

              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="seo_description">SEO description<span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="seo_description" name="seo_description" value="{{$page['seo_description']}}">
								</div>
							</div>

              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="seo_keywords">SEO keywords<span class="required">*</span></label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" value="{{$page['seo_keywords']}}">
                </div>
              </div>

              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="adwards_code">Adwords code:</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="adwords_code" name="adwords_code" style="min-height:150px">{{$page['adwords_code']}}</textarea>
                  <div class="col-md-12" style="text_align:center;font-size:14px;padding:20px 0 20px 0">
  									<label>Place Google Adwords conversion tracking code here. The code will be inserted above the closing body tag&lt;/body&gt;</label>
  								</div>
								</div>

							</div>

              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="facebook_pixel_code">Facebook_event_code:</label>
                <div class="col-md-6">
                  <textarea type="text" class="form-control" id="facebook_pixel_code" name="facebook_pixel_code" style="min-height:150px">{{$page['facebook_pixel_code']}}</textarea>
                  <div class="col-md-12" style="text_align:center;font-size:14px;padding:20px 0 20px 0">
                    <label>Place Facebook pixel code here. The code will be inserted above the closing head tag&lt;/head&gt;</label>
                  </div>
                </div>
              </div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isShow">Show Header/Footer?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="is_show" value='1' data-plugin-ios-switch @if($page['is_show']) checked="checked" @endif/>
									</div>
								</div>
							</div>

										  <div class="form-group">
                <label class="col-md-3 control-label label-left" for="is_sidebar">Show sidebar?</label>
                <div class="col-md-6">
                  <div class="switch switch-primary">
                    <input type="checkbox" id="is_sidebar" name="is_sidebar" value='1' data-plugin-ios-switch @if($page['is_sidebar']) checked="checked" @endif/>
                  </div>
                </div>
              </div>
			  
							<div>
								<button type="submit" class="btn btn-primary" style="width:120px" onclick="Save(event)">{!! trans('flashcard.save') !!}</button>
							</div>
							

						</form>
					</div>
				</section>
			</div>
		</div>
	</section>
	<script type="text/javascript">
	function Save(e){

		var title = document.getElementById('title').value;
		var static_url = title.trim().replace(/\s/g, '-').toLowerCase();
		//console.log('static_url', static_url);

			@foreach ($pages as $item)
				@if($page['id'])
					@if($page['id'] == $item['id'])
						@continue;
					@endif
				@endif
				//console.log('---------------');
				//console.log("{{$item['static_url']}}");

				if ("{{$item['static_url']}}" == static_url)
				{
					//console.log('---------------');
					//console.log(static_url);
					new PNotify({
							text: 'Page Url will be overlap. Please input another page title.',
							type: 'error',
							icon: false,
							addclass: 'ui-pnotify-no-icon',
					});
					e.preventDefault();
					e.stopPropagation();
					return;
				}
			@endforeach
	}
	</script>
@endsection
