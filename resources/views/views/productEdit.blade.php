<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Config::get('SITE_TITLE') }}</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />




    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/dropzone/basic.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/dropzone/dropzone.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
    <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/codemirror/theme/monokai.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
    <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery/jquery.js"></script>
		<script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/modernizr/modernizr.js"></script>
    <script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
  </head>
  <body>
    <section class="body">
      <!-- start: header -->
      <header class="header">
        <div class="logo-container">
          <a href="{{ Config::get('RELATIVE_URL') }}/" class="logo">
            <img src="/assets/images/admin-log.png" height="35" alt="Imprevo Admin" />
          </a>
          <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
          </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

          <span class="separator"></span>

          <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
              <figure class="profile-picture">
               <img src="@if (Auth::user()->photo == null) {{ Config::get('RELATIVE_URL') }}/assets/images/!logged-user.jpg @else {{ Config::get('RELATIVE_URL') }}/public{{Auth::getUser()->photo}} @endif" class="img-circle" alt="User Image">
              </figure>
              <div class="profile-info" data-lock-name="{{ Auth::user()->name}}" data-lock-email="{{ Auth::user()->email}}">
                <span class="name">{{ Auth::user()->name}}</span>
              </div>

              <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
              <ul class="list-unstyled">
                <li class="divider"></li>
                <li>
                  <a role="menuitem" tabindex="-1" href="{{ Config::get('RELATIVE_URL') }}/profile"><i class="fa fa-user"></i> My profile</a>
                </li>
                <li>
                  <a role="menuitem" tabindex="-1" href="{{ Config::get('RELATIVE_URL') }}/signout"><i class="fa fa-power-off"></i> Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end: search & user box -->
      </header>
      <!-- end: header -->

      <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">

          <div class="sidebar-header">
            <div class="sidebar-title">
              Navigation
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
              <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
          </div>

          <div class="nano">
            <div class="nano-content">
              <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
				   <li>
						<a href="{{ Config::get('RELATIVE_URL') }}/home">
							<i class="fa fa-home"></i> <span>Dashboard</span>
						</a>
				  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                      <span>Course management</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/courses">
                          Course list
                        </a>
                      </li>
                      <li>
                        <a href="/courses/new">
                          Add new course
                        </a>
                      </li>
                      <li>
                        <a href="/levels">
                          Add new level
                        </a>
                      </li>
                      <li>
                        <a href="/modules">
                          Add new module
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-book" aria-hidden="true"></i>
                      <span>Lesson management</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/lessons">
                          Lesson list
                        </a>
                      </li>
                      <li>
                        <a href="/lessons/new">
                          Add new lesson
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                      <span>Quiz management</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/quizzes">
                          Quiz list
                        </a>
                      </li>
                      <li>
                        <a href="/quizzes/new">
                          Add new quiz
                        </a>
                      </li>
					  <li>
                        <a href="/quizsettings">
                          Quiz Settings
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-language" aria-hidden="true"></i>
                      <span>Word database</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/words">
                          Words
                        </a>
                      </li>
                      <li>
                        <a href="/cats">
                          Categories
                        </a>
                      </li>
                    </ul>
                  </li>
				  <li class="nav-parent">
                    <a>
                      <i class="fa fa-tasks" aria-hidden="true"></i>
                      <span>Wordset management</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/wordsets">
                          Wordset list
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-user" aria-hidden="true"></i>
                      <span>User management</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/users">
                          User list
                        </a>
                      </li>
                      <li>
                        <a href="/users/new">
                          Add new user
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-wpforms" aria-hidden="true"></i>
                      <span>Pages</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/pages">
                          Page list
                        </a>
                      </li>
                      <li>
                        <a href="/pages/new">
                          Add new page
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-wpforms" aria-hidden="true"></i>
                      <span>Blog Management</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/blogs">
                          Post list
                        </a>
                      </li>
                      <li>
                        <a href="/blogs/new">
                          Add new post
                        </a>
                      </li>
                      <li>
                        <a href="/blogcats">
                          Categories
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-parent">
                    <a>
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                      <span>Shopping cart</span>
                    </a>
                    <ul class="nav nav-children">
                      <li>
                        <a href="/products">
						   Products
                        </a>
                      </li>
                      <li>
                        <a href="/products/new">
                          Add new products
                        </a>
                      </li>
					  <li>
                        <a href="/orders">
                          Orders
                        </a>
                      </li>
					  <li>
                        <a href="/shoppingcartsettings">
                          Settings
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="{{ Config::get('RELATIVE_URL') }}/setting">
                      <i class="fa fa-gears"></i> <span>Settings</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>

            <script>
              // Maintain Scroll Position
              if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                  var initialPosition = localStorage.getItem('sidebar-left-position'),
                          sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                  sidebarLeft.scrollTop = initialPosition;
                }
              }
            </script>
          </div>
        </aside>
        <!-- end: sidebar -->
        <div class="w100">
	<section role="main" class="content-body">

		<header class="page-header">
			<h2>
				Products
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($product['id'] != null)
							<h2 class="panel-title">Edit product</h2>
						@else
							<h2 class="panel-title">Add new product</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/product" method="post" encType="multipart/form-data">
							@if($product['id'])
								<input type="hidden" name="id" value="{{$product->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Product title <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" required value="{{$product['title']}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Description</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="description" name="description" style="height:100px">{{$product['description']}}</textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="courseId">Assign a course <span class="required">*</span></label>
								<div class="col-md-6">
									<select class="form-control" name="courseId" id="courseId" required onchange="selectCourse(this.value)">
										<option value="">Select a course from the list....</option>
										@foreach ($courses as $item)
											<option value="{{$item->id}}" @if($product['course_id']==$item->id) selected @endif>{{$item->title}}</option>
										@endforeach
									</select>
								</div>
							</div>


							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Regular price</label>
								<div class="col-md-6">
									<input type="number_format" class="form-control" id="regular_price" name="regular_price" required value="{{$product['regular_price']}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Sale price</label>
								<div class="col-md-6">
									<input type="number_format" class="form-control" id="sale_price" name="sale_price" value="{{$product['sale_price']}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left">Sale price end date</label>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</span>
										<input id="sale_price_end_date" name="sale_price_end_date" type="text" data-plugin-datepicker class="form-control" value="<?php if ($product['sale_price_end_date'] != '') echo date('m/d/Y', strtotime($product['sale_price_end_date'])); ?>">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left">Number of orders available<br>during the sale</label>
								<div class="col-md-6">
									<div data-plugin-spinner="">
										<div class="input-group input-small">
												<input id="sale_price_orders_num" name="sale_price_orders_num" class="spinner-input form-control" readonly="readonly" maxlength="3" type="text" value="{{$product['sale_price_orders_num']}}">
												<div class="spinner-buttons input-group-btn btn-group-vertical">
														<button class="btn spinner-up btn-xs btn-default" type="button">
															<i class="fa fa-angle-up"></i>
														</button>
														<button class="btn spinner-down btn-xs btn-default" type="button">
															<i class="fa fa-angle-down"></i>
														</button>
												</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="courseId">Billing cycle</label>
								<div class="col-md-6">
									<select class="form-control" name="billing_cycle" id="billing_cycle" required>
										<option value="">Select a billing cycle from the list....</option>
										<option value="Life time" @if ($product['billing_cycle']=="Life time") selected @endif>Life time</option>
										<option value="Yearly" @if ($product['billing_cycle']=="Yearly") selected @endif>Yearly</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="uploadPhoto">Product image</label>
								<div class="col-md-6">
									@if($product['id'] && $product['product_image'])
										<img src="{{$product['product_image']}}" style="max-height:200px;margin-bottom: 10px">
									@endif
									<input type="file" id="product_image" class="form-control" name="product_image" >
								</div>
							</div>
              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="featured_product" style="color:#000000, font-weight:bold">Featured product?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" id="featured_product" name="featured_product" onchange="enableFeature()" value='1' data-plugin-ios-switch  @if($product['featured_product']) checked="checked" @endif/>
									</div>
								</div>
							</div>
              <div class="form-group">
								<label class="col-md-3 control-label label-left" for="featured_product">Features</label>
                <div class="col-md-6">
                  <div class="row" style="margin-bottom:10px">
									    <input type="text" class="form-control" id="feature1" name="feature1" required value="@if (isset($product['features'][0])) {{$product['features'][0]}} @endif">
                  </div>
                  <div class="row" style="margin-bottom:10px">
                      <input type="text" class="form-control" id="feature2" name="feature2" required value="@if (isset($product['features'][1])) {{$product['features'][1]}} @endif">
                  </div>
                  <div class="row" style="margin-bottom:10px">
									    <input type="text" class="form-control" id="feature3" name="feature3" required value="@if (isset($product['features'][2])) {{$product['features'][2]}} @endif">
                  </div>
                  <div class="row" style="margin-bottom:10px">
									    <input type="text" class="form-control" id="feature4" name="feature4" required value="@if (isset($product['features'][3])) {{$product['features'][3]}} @endif">
                  </div>
                  <div class="row">
									    <input type="text" class="form-control" id="feature5" name="feature5" required value="@if (isset($product['features'][4])) {{$product['features'][4]}} @endif">
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
  function enableFeature(){
    value = document.getElementById('featured_product').checked;
    if (value == true)
    {
      document.getElementById('featured_product').value = 1;
    }
    else
    {
      document.getElementById('featured_product').value = 0;
    }
  }
	</script>
</div>
</div>
</section>
<script src="/assets/vendor/jquery/jquery.js"></script>
<script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="/assets/vendor/jquery-ui/jquery-ui.js"></script>
<script src="/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<script src="/assets/vendor/select2/js/select2.js"></script>
<script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="/assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="/assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<script src="/assets/vendor/fuelux/js/spinner.js"></script>
<script src="/assets/vendor/dropzone/dropzone.js"></script>
<script src="/assets/vendor/bootstrap-markdown/js/markdown.js"></script>
<script src="/assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
<script src="/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="/assets/vendor/codemirror/lib/codemirror.js"></script>
<script src="/assets/vendor/codemirror/addon/selection/active-line.js"></script>
<script src="/assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="/assets/vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="/assets/vendor/codemirror/mode/xml/xml.js"></script>
<script src="/assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="/assets/vendor/codemirror/mode/css/css.js"></script>
<script src="/assets/vendor/summernote/summernote.js"></script>
<script src="/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>
<script src="/assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="/assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/forms/examples.advanced.form.js"></script>


</body>
</html>
